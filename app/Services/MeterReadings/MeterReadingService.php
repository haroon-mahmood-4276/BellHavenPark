<?php

namespace App\Services\MeterReadings;

use App\Models\MeterReading;
use App\Services\Bookings\BookingInterface;
use App\Services\BookingTaxes\BookingTaxInterface;
use App\Services\Payments\PaymentInterface;
use App\Utils\Enums\{CustomerAccounts, PaymentStatus, PaymentType, TransactionType, UtilityBillsStatus};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MeterReadingService implements MeterReadingInterface
{
    private $bookingInterface, $bookingTaxInterface, $paymentInterface;

    public function __construct(BookingInterface $bookingInterface, BookingTaxInterface $bookingTaxInterface, PaymentInterface $paymentInterface)
    {
        $this->bookingInterface = $bookingInterface;
        $this->bookingTaxInterface = $bookingTaxInterface;
        $this->paymentInterface = $paymentInterface;
    }

    private function model()
    {
        return new MeterReading();
    }

    public function get($ignore = null, $with = [], $where = [], $sort = [])
    {
        return $this->model()
            ->when(
                is_array($ignore),
                fn (QueryBuilder $query) => $query->whereNotIn('id', $ignore),
                fn (QueryBuilder $query) => $query->where('id', '!=', $ignore)
            )
            ->when(
                $with,
                fn (QueryBuilder $query) => $query->with($with)
            )
            ->when(
                $where,
                fn (QueryBuilder $query) => $query->where($where)
            )
            ->when(
                $sort,
                function (QueryBuilder $query, $sort) {
                    foreach ($sort as $key => $order) {
                        $query->orderBy($key, $order);
                    }
                }
            )->get();
    }

    public function find($id, $relationships = [], $where = [])
    {
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs) {
            $model = $this->model()->create([
                'cabin_id' => $inputs['cabin_id'],
                'meter_type' => $inputs['meter_type'],
                'reading' => $inputs['reading'],
                'reading_date' => Carbon::parse($inputs['reading_date'])->timestamp,
                'comments' => $inputs['comments']
            ]);

            // Check if booking is in on going
            $booking = $this->bookingInterface->find($inputs['cabin_id'], where: [
                ['check_in_date', '>', 0],
                ['check_out_date', '<', 1],
            ]);

            if ($booking && ($booking->bill_for_electricity || $booking->bill_for_gas || $booking->bill_for_water)) {
                $previousMeterReading = $this->model()->where([
                    'cabin_id' => $model->cabin_id,
                    'meter_type' => $model->meter_type,
                ])->whereBetween('reading_date', [$booking->check_in_date, Carbon::parse($model->reading_date)->timestamp - 1])->latest()->first();

                if ($previousMeterReading) {
                    $amount = $this->calculateReadingCost($model->reading, $model->reading_date, $previousMeterReading->reading, $previousMeterReading->reading_date, $inputs['meter_type']);
                    if ($amount > 0) {
                        $this->paymentInterface->model()->create([
                            'booking_id' => $booking->id,
                            'payment_method_id' => null,
                            'customer_id' => $booking->customer_id,
                            'payment_from' => 0,
                            'payment_to' => 0,
                            'amount' => '-' . $amount,
                            'account' => match ($inputs['meter_type']) {
                                'electric' => CustomerAccounts::ELECTRICITY,
                                'gas' => CustomerAccounts::GAS,
                                'water' => CustomerAccounts::WATER,
                            },
                            'transaction_type' => TransactionType::CASH,
                            'status' => PaymentStatus::RECEIVABLE,
                            'payment_type' => match ($inputs['meter_type']) {
                                'electric' => PaymentType::ELECTRIC,
                                'gas' => PaymentType::GAS,
                                'water' => PaymentType::WATER,
                            },
                            'additional_data' => [],
                            'comments' => "System Generated Bill",
                        ]);
                    }
                }
            }
        });
    }

    public function update($id, $inputs)
    {
        return DB::transaction(function () use ($id, $inputs) {
            return $this->model()->find($id)->update([
                'meter_type' => $inputs['meter_type'],
                'reading' => $inputs['reading'],
                'reading_date' => Carbon::parse($inputs['reading_date'])->timestamp,
                'comments' => $inputs['comments'],
            ]);
        });
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $model = $this->model()->whereIn('id', $inputs)->get()->each(function ($model) {
                $model->delete();
            });

            return $model;
        });

        return $returnData;
    }

    public function previousReading($cabin_id, $meter_type)
    {
        return $this->model()->where([
            ['cabin_id', '=', $cabin_id],
            ['meter_type', '=', $meter_type],
        ])->latest()->first();
    }

    private function calculateReadingCost($currentReading, $currentReadingDate, $previousReading, $previousReadingDate, $meterType)
    {
        $currentReadingDate = Carbon::parse($currentReadingDate);
        $previousReadingDate = Carbon::parse($previousReadingDate);

        switch ($meterType) {
            case 'electric':
                $baseRate = floatval(settings('electricity_base_rate'));
                $sacRate = floatval(settings('electricity_sac_rate'));
                break;

            case 'gas':
                $baseRate = floatval(settings('gas_base_rate'));
                $sacRate = floatval(settings('gas_sac_rate'));
                break;

            case 'water':
                $baseRate = floatval(settings('water_base_rate'));
                $sacRate = floatval(settings('water_sac_rate'));
                break;
        }


        //No of units = Current reading - previous reading
        $noOfUnit = $currentReading - $previousReading;
        if ($noOfUnit < 1) return 0;

        //sub total = No of unit * base rate kw/h
        $subTotal = floatval($noOfUnit * $baseRate);

        //sac rate = flat rate(per day) (user input) * no of days (checkbox to enable else 0)
        $sacRate = floatval($sacRate * ($previousReadingDate->diffInDays($currentReadingDate)));

        //flat rate/percentage(subtotal) (checkbox to enable else 0)
        $percentageAmount = match ($meterType) {
            'electric' => boolval(settings('electricity_is_percentage')) ? (percentageOf($subTotal, floatval(settings('electricity_flat_rate_percentage')))) : floatval(settings('electricity_flat_rate_percentage')),
            'gas' => boolval(settings('gas_is_percentage')) ? (percentageOf($subTotal, floatval(settings('gas_flat_rate_percentage')))) : floatval(settings('gas_flat_rate_percentage')),
            'water' => boolval(settings('water_is_percentage')) ? (percentageOf($subTotal, floatval(settings('water_flat_rate_percentage')))) : floatval(settings('water_flat_rate_percentage')),
        };

        // Tax rate
        $taxRate = match ($meterType) {
            'electric' => $this->bookingTaxInterface->find(intval(settings('electricity_tax'))),
            'gas' => $this->bookingTaxInterface->find(intval(settings('gas_tax'))),
            'water' => $this->bookingTaxInterface->find(intval(settings('water_tax'))),
        };

        $taxRate = $taxRate->is_flat ? $taxRate->amount : (percentageOf($subTotal, floatval($taxRate->amount)));

        // Total = subtotal + sac rate + flat rate/percentage + tax rate
        return array_sum([$subTotal, $sacRate, $percentageAmount, $taxRate]);
    }
}
