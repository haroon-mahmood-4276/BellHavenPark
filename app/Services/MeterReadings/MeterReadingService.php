<?php

namespace App\Services\MeterReadings;

use App\Models\MeterReading;
use App\Services\Bookings\BookingInterface;
use App\Services\BookingTaxes\BookingTaxInterface;
use App\Services\Payments\PaymentInterface;
use App\Utils\Enums\{CustomerAccounts, MeterTypes, PaymentStatus, PaymentType, TransactionType, UtilityBillsStatus};
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
                'reading_date' => Carbon::parse($inputs['reading_date'] . " " . now()->format('H:i:s'))->timestamp,
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
                    $meterData = $this->calculateReadingCost($model->reading, $model->reading_date, $previousMeterReading->reading, $previousMeterReading->reading_date, $inputs['meter_type']);
                    if ($meterData['amount'] > 0) {
                        $this->paymentInterface->model()->create([
                            'booking_id' => $booking->id,
                            'payment_method_id' => null,
                            'customer_id' => $booking->customer_id,
                            'payment_from' => $previousMeterReading->reading_date,
                            'payment_to' => $model->reading_date,
                            'credit_amount' => 0,
                            'debit_amount' => $meterData['amount'],
                            'account' => CustomerAccounts::ELECTRICITY,
                            'additional_data' => array_merge([
                                'consumed_units' => $meterData['consumed_units'],
                            ], match ($inputs['meter_type']) {
                                MeterTypes::ELECTRICITY->value => [
                                    'electricity_base_rate' => settings('electricity_base_rate'),
                                    'electricity_tax' => settings('electricity_tax'),
                                    'electricity_is_percentage' => settings('electricity_is_percentage'),
                                    'electricity_flat_rate_percentage' => settings('electricity_flat_rate_percentage'),
                                    'electricity_sac_rate' => settings('electricity_sac_rate'),
                                ],
                                MeterTypes::GAS->value => [
                                    'gas_base_rate' => settings('gas_base_rate'),
                                    'gas_tax' => settings('gas_tax'),
                                    'gas_is_percentage' => settings('gas_is_percentage'),
                                    'gas_flat_rate_percentage' => settings('gas_flat_rate_percentage'),
                                    'gas_sac_rate' => settings('gas_sac_rate'),
                                ],
                                MeterTypes::WATER->value => [
                                    'water_base_rate' => settings('water_base_rate'),
                                    'water_tax' => settings('water_tax'),
                                    'water_is_percentage' => settings('water_is_percentage'),
                                    'water_flat_rate_percentage' => settings('water_flat_rate_percentage'),
                                    'water_sac_rate' => settings('water_sac_rate'),
                                ]
                            }),
                            'comments' => "Unit Consumed: " . $meterData['consumed_units'] . " @ $" . settings('electricity_base_rate') . match ($inputs['meter_type']) {
                                MeterTypes::ELECTRICITY->value => '/kWh',
                                MeterTypes::GAS->value => '/M<sup>3</sup>',
                                MeterTypes::WATER->value => '/M<sup>3</sup>',
                                default => ''
                            },
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
            case MeterTypes::ELECTRICITY->value:
                $baseRate = floatval(settings('electricity_base_rate'));
                $sacRate = floatval(settings('electricity_sac_rate'));
                break;

            case MeterTypes::GAS->value:
                $baseRate = floatval(settings('gas_base_rate'));
                $sacRate = floatval(settings('gas_sac_rate'));
                break;

            case MeterTypes::WATER->value:
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
            MeterTypes::ELECTRICITY->value => boolval(settings('electricity_is_percentage')) ? (percentageOf($subTotal, floatval(settings('electricity_flat_rate_percentage')))) : floatval(settings('electricity_flat_rate_percentage')),
            MeterTypes::GAS->value => boolval(settings('gas_is_percentage')) ? (percentageOf($subTotal, floatval(settings('gas_flat_rate_percentage')))) : floatval(settings('gas_flat_rate_percentage')),
            MeterTypes::WATER->value => boolval(settings('water_is_percentage')) ? (percentageOf($subTotal, floatval(settings('water_flat_rate_percentage')))) : floatval(settings('water_flat_rate_percentage')),
        };

        // Tax rate
        $taxRate = match ($meterType) {
            MeterTypes::ELECTRICITY->value => $this->bookingTaxInterface->find(intval(settings('electricity_tax'))),
            MeterTypes::GAS->value => $this->bookingTaxInterface->find(intval(settings('gas_tax'))),
            MeterTypes::WATER->value => $this->bookingTaxInterface->find(intval(settings('water_tax'))),
        };

        $taxRate = $taxRate->is_flat ? $taxRate->amount : (percentageOf($subTotal, floatval($taxRate->amount)));

        // Total = subtotal + sac rate + flat rate/percentage + tax rate
        return [
            'amount' => array_sum([$subTotal, $sacRate, $percentageAmount, $taxRate]),
            'consumed_units' => $noOfUnit
        ];
    }
}
