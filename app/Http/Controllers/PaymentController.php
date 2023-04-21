<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentsDataTable;
use App\Services\{
    Bookings\BookingInterface,
    Payments\PaymentInterface
};
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentInterface;

    public function __construct(PaymentInterface $paymentInterface)
    {
        $this->paymentInterface = $paymentInterface;
    }

    public function index(PaymentsDataTable $dataTable, $id)
    {
        $data = [
            'booking_id' => $id,
        ];

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }

        return $dataTable->with($data)->render('bookings.payments.index');
    }
}
