<?php

namespace App\Http\Controllers;

use App\DataTables\BookingsDataTable;
use App\Services\Bookings\BookingInterface;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $bookingInterface;

    public function __construct(BookingInterface $bookingInterface)
    {
        $this->bookingInterface = $bookingInterface;
    }

    public function index(BookingsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('bookings.index');
    }
}
