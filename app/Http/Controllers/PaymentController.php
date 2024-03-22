<?php

namespace App\Http\Controllers;

use App\DataTables\BookingPaymentsDataTable;
use App\Models\Booking;
use App\Services\Payments\PaymentInterface;
use App\Services\Bookings\BookingInterface;
use App\Services\BookingTaxes\BookingTaxInterface;
use App\Services\PaymentMethods\PaymentMethodInterface;
use App\Utils\Enums\CustomerAccounts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $bookingTaxInterface, $paymentMethodInterface, $paymentInterface, $bookingInterface;

    public function __construct(
        BookingInterface $bookingInterface,
        PaymentInterface $paymentInterface,
        PaymentMethodInterface $paymentMethodInterface,
        BookingTaxInterface $bookingTaxInterface
    ) {
        $this->bookingInterface = $bookingInterface;
        $this->paymentInterface = $paymentInterface;
        $this->paymentMethodInterface = $paymentMethodInterface;
        $this->bookingTaxInterface = $bookingTaxInterface;
    }

    public function index(BookingPaymentsDataTable $dataTable, Booking $booking)
    {
        if (!$booking) {
            return redirect()->route('bookings.index')->withDanger('Booking not found');
        }

        $data = [
            'booking_id' => $booking->id,
            'booking_cabin_id' => $booking->cabin_id,
            'credit_account' => $this->paymentInterface->accountAmount($booking->customer->id, CustomerAccounts::CREDIT_ACCOUNT),
            'electricity_account' => [
                'enabled' => $booking->cabin->electric_meter,
                'amount' => $this->paymentInterface->accountAmount($booking->customer->id, CustomerAccounts::ELECTRICITY)
            ],
            'gas_account' => [
                'enabled' => $booking->cabin->gas_meter,
                'amount' => $this->paymentInterface->accountAmount($booking->customer->id, CustomerAccounts::GAS)
            ],
            'water_account' => [
                'enabled' => $booking->cabin->water_meter,
                'amount' => $this->paymentInterface->accountAmount($booking->customer->id, CustomerAccounts::WATER)
            ],
        ];

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }

        return $dataTable->with($data)->render('bookings.payments.index', $data);
    }

    public function create(Request $request, $booking_id)
    {
        $modalData = [
            'booking' => $this->bookingInterface->find($booking_id, ['cabin', 'customer', 'booking_source', 'booking_tax', 'payments']),
            'payment_methods' => $this->paymentMethodInterface->get()
        ];

        $modalData['credit_account'] = $this->paymentInterface->creditAccountPayment($modalData['booking']->customer->id);

        $modalData['last_payment_date'] = $this->paymentInterface->lastPaymentDate($booking_id) ?? $modalData['booking']?->booking_from;
        $modalData = array_merge($modalData, match ($request->payment_type) {
            'rent_payment' => [
                'booking_tax' => $this->bookingTaxInterface->find($modalData['booking']->booking_tax_id),
            ],
                // 'electricity_payment' => [
                //     'previous_reading' => ,
                //     'payment_type' => PaymentType::ELECTRIC,
                // ],
            default => []
        });

        if (request()->ajax()) {
            if ($modalData['booking'] == null) {
                $data = [
                    'status' => true,
                    'message' => [
                        'error' => 'Booking not found.'
                    ]
                ];
            } elseif (Carbon::parse($modalData['booking']->booking_to)->diffInDays($modalData['last_payment_date']) == 0) {
                $data = [
                    'status' => false,
                    'message' => [
                        'error' => 'Cannot add more payment'
                    ]
                ];
            } else {
                $data = [
                    'status' => true,
                    'prevModal' => $request->prevModal,
                    'modalPlace' => 'modalPlace',
                    'currentModal' => 'basicModal',
                    'modal' => match ($request->payment_type) {
                        'rent_payment' => view('bookings.payments.modal.rent_payment', $modalData)->render(),
                        'electricity_payment' => view('bookings.payments.modal.electricity_payment', $modalData)->render(),
                        default => ''
                    },
                ];
            }

            return response()->json($data);
        } else {
            abort(403);
        }
    }


    public function store(Request $request, Booking $booking)
    {
        abort_if(request()->ajax(), 403);

        // try {
        $inputs = $request->input();

        match ($inputs['payment_type']) {
            'rent_payment' => $this->paymentInterface->storeRentPayment($booking, $inputs),
            'electricity_payment' => $this->paymentInterface->storeUtilityPayment($booking, $inputs),
        };
        return redirect()->route('bookings.payments.index', ['booking' => $booking])->withSuccess('Data saved!');
        // } catch (GeneralException $ex) {
        //     return redirect()->route('bookings.payments.index', ['booking' => $booking])->withDanger('Something went wrong! ' . $ex->getMessage());
        // } catch (Exception $ex) {
        //     return redirect()->route('bookings.payments.index', ['booking' => $booking])->withDanger('Something went wrong!');
        // }
    }
}
