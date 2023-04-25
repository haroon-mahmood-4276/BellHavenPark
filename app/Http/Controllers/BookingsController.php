<?php

namespace App\Http\Controllers;

use App\Models\{
    Booking,
    BookingSource,
    Cabin,
    Customer,
};
use App\Services\Bookings\BookingInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingsController extends Controller
{
    private $bookingInterface;

    public function __construct(BookingInterface $bookingInterface)
    {
        $this->bookingInterface = $bookingInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {

            $data = [
                'bookings' => (new Booking())->getAllWithPagination(20),
            ];

            // dd($data);
            return view('bookings.index', $data);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!request()->ajax()) {

            if ($request->has('booking_date_range') && !is_null($request->booking_date_range) && !empty($request->booking_date_range)) {
                $dates = explode(' ', $request->booking_date_range);
                $data = [
                    'booking_from' => $dates[0],
                    'booking_to' => (isset($dates[2]) ? $dates[2] : $dates[0]),
                ];
            } else {
                $dates = [now()];
                $data = [
                    'booking_from' => now(),
                    'booking_to' => now(),
                ];
            }
            $data['cabins'] = (new Cabin())->getAllWithPaginationAndDateRange($dates, 20);

            return view('bookings.cabins', $data);
        } else {
            abort(403);
        }
    }

    public function createModal(Request $request, $cabin_id)
    {
        if (request()->ajax()) {

            if ($request->has('date_from') && !is_null($request->date_from) && !empty($request->date_from)) {
                $date_from = $request->date_from;
            }

            if ($request->has('date_to') && !is_null($request->date_to) && !empty($request->date_to)) {
                $date_to = $request->date_to;
            } else {
                $date_to = $request->date_from;
            }

            $differenceInDays = (new Carbon($date_from))->diffInDays((new Carbon($date_to)));

            $modalData = [
                'date_from' => $date_from,
                'date_to' => $date_to,
                'differenceInDays' => $differenceInDays,
                'cabin' => (new Cabin())->getById(encryptParams($cabin_id)),
                'customers' => (new Customer())->getAll(),
                'booking_sources' => (new BookingSource())->getAll(),
            ];

            $data = [
                'status' => true,
                'prevModal' => $request->prevModal,
                'modalPlace' => 'modalPlace',
                'currentModal' => 'default',
                'modal' => view('bookings.modal.index', $modalData)->render(),
            ];

            return response()->json($data);

        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if (!request()->ajax()) {
            $result = $this->bookingInterface->store($request);
            if (is_a($result, 'Exception')) {
                Log::error('Booking Store => Error Code: ' . $result->getCode() . ' Error Message: ' . $result->getMessage());
                return redirect()->route('bookings.create')->withDanger('Something went wrong!');
            }
            return redirect()->route('bookings.create')->withSuccess('Booking Saved!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(403);
    }

    public function CheckInIndex(Request $request)
    {
        if (!request()->ajax()) {

            $data = [
                'checkinList' => (new Booking())->getAllCheckInWithPagination(20),
            ];

            // dd($data);
            return view('bookings.checkin', $data);
        } else {
            abort(403);
        }
    }

    public function CheckInStore(Request $request, $booking_id)
    {
        if (!request()->ajax()) {
            $result = (new Booking())->storeBookingCheckIn($request, $booking_id);
            if (is_a($result, 'Exception')) {
                Log::error('Booking Check In => Error Code: ' . $result->getCode() . ' Error Message: ' . $result->getMessage());
                return redirect()->route('bookings.checkin.index')->withDanger('Something went wrong!');
            }
            return redirect()->route('bookings.checkin.index')->withSuccess('Customer Checked In Successfull');
        } else {
            abort(403);
        }
    }

    public function CheckOutIndex(Request $request)
    {
        if (!request()->ajax()) {

            $data = [
                'checkoutList' => (new Booking())->getAllCheckOutWithPagination(20),
            ];

            // dd($data);
            return view('bookings.checkout', $data);
        } else {
            abort(403);
        }
    }

    public function CheckOutStore(Request $request, $booking_id)
    {
        if (!request()->ajax()) {
            $result = (new Booking())->storeBookingCheckOut($request, $booking_id);
            if (is_a($result, 'Exception')) {
                Log::error('Booking Check In => Error Code: ' . $result->getCode() . ' Error Message: ' . $result->getMessage());
                return redirect()->route('bookings.checkout.index')->withDanger('Something went wrong!');
            }
            return redirect()->route('bookings.checkout.index')->withSuccess('Customer Checked Out Successfull');
        } else {
            abort(403);
        }
    }

    public function calenderView(Request $request)
    {
        if (!request()->ajax()) {

            return view('bookings.calender');
        } else {
            abort(403);
        }
    }
}
