<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingSource\{
    StoreRequest as BookingSourceStoreRequest,
    UpdateRequest as BookingSourceUpdateRequest,
};
use App\Models\BookingSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) {

            $data = [
                'booking_sources' => (new BookingSource())->getAllWithPagination(20),
            ];

            // dd($data);
            return view('bookingsource.index', $data);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!request()->ajax()) {
            return view('bookingsource.create');
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
    public function store(BookingSourceStoreRequest $request)
    {
        if (!request()->ajax()) {
            // dd($request->post());
            $result = (new BookingSource())->storeBookingSource($request);

            if (is_a($result, 'Exception')) {
                Log::debug('Booking Source Store => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('booking_sources.create')->withDanger('Data not saved. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('booking_sources.index')->withSuccess('Data saved.');
        } else {
            abort(403);
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
        if (!request()->ajax()) {
            $data = [
                'booking_source' => (new BookingSource())->getById($id),
            ];
            // dd($data);
            if (is_a($data['booking_source'], 'Exception')) {
                Log::debug('Booking Source Edit => Error Code: ' . $data['booking_source']->getCode() . 'Error Message: ' . $data['booking_source']->getMessage());
                return redirect()->route('booking_sources.index')->withDanger('Data not found.');
            }
            return view('bookingsource.edit', $data);
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingSourceUpdateRequest $request, $id)
    {
        if (!request()->ajax()) {
            // dd($request->post());
            $result = (new BookingSource())->updateBookingSource($request, $id);

            if (is_a($result, 'Exception')) {
                Log::debug('Booking Source Update => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('booking_sources.edit', ['booking_source' => $id])->withDanger('Data not updated. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('booking_sources.index')->withSuccess('Data updated.');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!request()->ajax()) {
            if ($request->has('delete')) {
                $result = (new BookingSource())->destroyBookingSource($request->get('delete'));

                if (is_a($result, 'Exception')) {
                    Log::debug('Booking Source Destroy => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                    return redirect()->route('booking_sources.create')->withDanger('Data not deleted. Something went wrong. Please consult with site developer.');
                }
                return redirect()->route('booking_sources.index')->withSuccess('Data deleted.');
            } else
                return redirect()->route('booking_sources.index')->withWarning('Please select atleast one row.');
        } else {
            abort(403);
        }
    }
}
