<?php

namespace App\Http\Controllers;

use App\DataTables\{BookingsDataTable, BookingCabinsDataTable};
use App\Exceptions\GeneralException;
use App\Http\Requests\Bookings\storeRequest;
use App\Services\Bookings\BookingInterface;
use App\Services\BookingSources\BookingSourceInterface;
use App\Services\Cabins\CabinInterface;
use App\Services\Customers\CustomerInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $bookingInterface, $bookingSourceInterface, $cabinInterface, $customerInterface;

    public function __construct(BookingInterface $bookingInterface, CabinInterface $cabinInterface, CustomerInterface $customerInterface, BookingSourceInterface $bookingSourceInterface)
    {
        $this->bookingInterface = $bookingInterface;
        $this->cabinInterface = $cabinInterface;
        $this->customerInterface = $customerInterface;
        $this->bookingSourceInterface = $bookingSourceInterface;
    }

    public function index(BookingsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('bookings.index');
    }

    public function create(Request $request, BookingCabinsDataTable $dataTable)
    {
        if ($request->has('booking_date_range') && !is_null($request->booking_date_range) && !empty($request->booking_date_range)) {
            $dates = explode('-', $request->booking_date_range);
            $data = [
                'booking_from' => Carbon::parse(trim($dates[0])),
                'booking_to' => Carbon::parse(trim(isset($dates[1]) ? $dates[1] : $dates[0])),
                'showTable' => true
            ];
        } else {
            $data = [
                'booking_from' => now(),
                'booking_to' => now(),
                'showTable' => false
            ];
        }

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }
        return $dataTable->with($data)->render('bookings.cabins.index', $data);
    }

    public function createModal(Request $request)
    {

        abort_if(!request()->ajax(), 403);

        $inputs = $request->input();

        $differenceInDays = Carbon::parse(intval($inputs['booking_from']))->diffInDays(Carbon::parse(intval($inputs['booking_to'])));

        $modalData = [
            'date_from' => intval($inputs['booking_from']),
            'date_to' => intval($inputs['booking_to']),
            'differenceInDays' => $differenceInDays,
            'cabin' => $this->cabinInterface->getById($inputs['cabin_id']),
            'customers' => $this->customerInterface->getAll(),
            'booking_sources' => $this->bookingSourceInterface->getAll(),
        ];

        $data = [
            'status' => true,
            'modalPlace' => 'modalPlace',
            'currentModal' => 'basicModal',
            'modal' => view('bookings.modal.index', $modalData)->render(),
        ];

        return response()->json($data);
    }

    public function store(storeRequest $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            $inputs = $request->validated();
            $record = $this->bookingInterface->store($inputs);
            return redirect()->route('bookings.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('bookings.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('bookings.index')->withDanger('Something went wrong!');
        }
    }

    public function CheckInIndex(BookingsDataTable $dataTable)
    {
        $data = [
            'filter' => 'checkin',
        ];

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }
        return $dataTable->with($data)->render('bookings.index');
    }

    public function CheckInStore(Request $request, $booking_id)
    {
        abort_if(request()->ajax(), 403);

        try {
            $record = $this->bookingInterface->storeCheckIn($booking_id);
            return redirect()->route('bookings.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('bookings.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('bookings.index')->withDanger('Something went wrong!');
        }
    }

    public function CheckOutIndex(BookingsDataTable $dataTable)
    {
        $data = [
            'filter' => 'checkout',
        ];

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }
        return $dataTable->with($data)->render('bookings.index');
    }

    public function CheckOutStore(Request $request, $booking_id)
    {
        abort_if(request()->ajax(), 403);

        try {
            $record = $this->bookingInterface->storeCheckOut($booking_id);
            return redirect()->route('bookings.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('bookings.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('bookings.index')->withDanger('Something went wrong!');
        }
    }

    public function calenderView(Request $request)
    {
        abort_if(request()->ajax(), 403);

        $data = [
            'bookings' => $this->bookingInterface->get(relationships: ['customer', 'cabin']),
        ];

        return view('bookings.calender.index', $data);
    }
}
