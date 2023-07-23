<?php

namespace App\Http\Controllers;

use App\DataTables\BookingSourcesDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\BookingSources\{storeRequest, updateRequest};
use App\Services\BookingSources\BookingSourceInterface;
use Exception;
use Illuminate\Http\Request;

class BookingSourceController extends Controller
{
    private $bookingSourceInterface;

    public function __construct(BookingSourceInterface $bookingSourceInterface)
    {
        $this->bookingSourceInterface = $bookingSourceInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookingSourcesDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('booking-sources.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(request()->ajax(), 403);

        $data = [];
        return view('booking-sources.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeRequest $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            $inputs = $request->validated();
            $record = $this->bookingSourceInterface->store($inputs);
            return redirect()->route('booking-sources.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong!');
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
        abort_if(request()->ajax(), 403);

        try {
            $booking_source = $this->bookingSourceInterface->find($id);

            if ($booking_source && !empty($booking_source)) {
                $data = [
                    'booking_source' => $booking_source,
                ];

                return view('booking-sources.edit', $data);
            }

            return redirect()->route('booking-sources.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, $id)
    {
        abort_if(request()->ajax(), 403);
        try {
            $inputs = $request->validated();
            $record = $this->bookingSourceInterface->update($id, $inputs);

            return redirect()->route('booking-sources.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong!');
        }
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        abort_if(request()->ajax(), 403);
        try {

            if ($request->has('checkForDelete')) {

                $record = $this->bookingSourceInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('booking-sources.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('booking-sources.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong!');
        }
    }
}
