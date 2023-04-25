<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentDataTable;
use App\Models\{
    Booking,
    Cabin,
    Customer,
    Payment,
    PaymentMethod,
};
use App\Services\Payments\PaymentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    private $paymentInterface;

    public function __construct(PaymentInterface $paymentInterface)
    {
        $this->paymentInterface = $paymentInterface;
    }

    public function index(PaymentDataTable $dataTable, $booking_id)
    {

        $data = [
            'booking' => (new Booking())->getById($booking_id),
            'payments' => $this->paymentInterface->getByBookingId($booking_id),
        ];

        return $dataTable->with($data)->render('bookings.payments.index', $data);
    }

    public function create(Request $request, $booking_id)
    {

        $modalData = [];

        $modalData['booking'] = (new Booking())->getById($booking_id);
        $modalData['cabin'] = (new Cabin())->getById($booking_id);
        $modalData['customer'] = (new Customer())->getById(encryptParams($modalData['booking']->haven_customer_id));
        $modalData['advanced_payment'] = $this->paymentInterface->getAdvancedPaymentBookingId($booking_id);
        $modalData['payment_methods'] = (new PaymentMethod())->getAll();

        // dd($modalData);

        if (request()->ajax()) {

            if($modalData['booking'] == null){
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
