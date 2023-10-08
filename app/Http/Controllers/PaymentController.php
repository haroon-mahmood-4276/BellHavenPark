<?php

namespace App\Http\Controllers;

use App\DataTables\BookingPaymentsDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\Payments\storeRequest;
use App\Services\{
    Payments\PaymentInterface
};
use App\Services\Bookings\BookingInterface;
use App\Services\BookingTaxes\BookingTaxInterface;
use App\Services\PaymentMethods\PaymentMethodInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $bookingInterface, $paymentInterface, $paymentMethodInterface, $bookingTaxInterface;

    public function __construct(
        BookingInterface $bookingInterface,
        PaymentInterface $paymentInterface,
        PaymentMethodInterface $paymentMethodInterface,
        BookingTaxInterface $bookingTaxInterface
    )
    {
        $this->bookingInterface = $bookingInterface;
        $this->paymentInterface = $paymentInterface;
        $this->paymentMethodInterface = $paymentMethodInterface;
        $this->bookingTaxInterface = $bookingTaxInterface;
    }

    public function index(BookingPaymentsDataTable $dataTable, $id)
    {

        $booking = $this->bookingInterface->getById($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->withDanger('Booking not found');
        }

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
            'payment_methods' => $this->paymentMethodInterface->getAll()
        ];
        $modalData['last_payment_date'] = $this->paymentInterface->getLastPaymentDateByBookingId($booking_id) ?? $modalData['booking']?->booking_from;
        $modalData['booking_tax'] = $this->bookingTaxInterface->find($modalData['booking']->booking_tax_id);

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
                    'modal' => view('bookings.payments.modal.index', $modalData)->render(),
                ];
            }

            return response()->json($data);
        } else {
            return $modalData;
            abort(403);
        }
    }


    public function store(Request $request, $booking_id)
    {
        abort_if(request()->ajax(), 403);

        try {

            $inputs = $request->input();
            $record = $this->paymentInterface->store($booking_id, $inputs);
            return redirect()->route('bookings.payments.index', ['id' => $booking_id])->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('bookings.payments.index', ['id' => $booking_id])->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('bookings.payments.index', ['id' => $booking_id])->withDanger('Something went wrong!');
        }
    }
}
