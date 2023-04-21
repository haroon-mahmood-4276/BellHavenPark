<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentsDataTable;
use App\Services\{
    Payments\PaymentInterface
};
use App\Services\Bookings\BookingInterface;
use App\Services\PaymentMethods\PaymentMethodInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $bookingInterface, $paymentInterface, $paymentMethodInterface;

    public function __construct(BookingInterface $bookingInterface, PaymentInterface $paymentInterface, PaymentMethodInterface $paymentMethodInterface)
    {
        $this->bookingInterface = $bookingInterface;
        $this->paymentInterface = $paymentInterface;
        $this->paymentMethodInterface = $paymentMethodInterface;
    }

    public function index(PaymentsDataTable $dataTable, $id)
    {
        $data = [
            'booking_id' => $id,
        ];

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }

        return $dataTable->with($data)->render('bookings.payments.index', $data);
    }

    public function create(Request $request, $booking_id)
    {
        $modalData = [
            'booking' => $this->bookingInterface->getById($booking_id, ['cabin', 'customer', 'booking_source', 'payments']),
            'advanced_payment' => $this->paymentInterface->getAdvancedPaymentBookingId($booking_id),
            'payment_methods' => $this->paymentMethodInterface->getAll(),
        ];

        if (request()->ajax()) {

            if ($modalData['booking'] == null) {
                $data = [
                    'status' => true,
                    'message' => [
                        'error' => 'Booking not found.'
                    ]
                ];
            } else {
                $data = [
                    'status' => true,
                    'prevModal' => $request->prevModal,
                    'modalPlace' => 'modalPlace',
                    'currentModal' => 'default',
                    'modal' => view('bookings.payments.modal.index', $modalData)->render(),
                ];
            }

            return response()->json($data);
        } else {
            return $modalData;
            abort(403);
        }
    }
}
