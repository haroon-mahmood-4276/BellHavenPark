<?php

namespace App\Http\Controllers;

use App\DataTables\BookingTaxesDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\BookingTaxes\storeRequest;
use App\Http\Requests\BookingTaxes\updateRequest;
use App\Models\BookingTax;
use App\Services\BookingTaxes\BookingTaxInterface;
use Exception;
use Illuminate\Http\Request;

class BookingTaxController extends Controller
{
    private $taxesInterface;

    public function __construct(BookingTaxInterface $taxesInterface)
    {
        $this->taxesInterface = $taxesInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookingTaxesDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('booking-taxes.index');
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
        return view('booking-taxes.create', $data);
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
            $record = $this->taxesInterface->store($inputs);
            return redirect()->route('booking-taxes.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong!');
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
            $model = $this->taxesInterface->find($id);

            if ($model && !empty($model)) {
                $data = [
                    'booking_tax' => $model,
                ];

                return view('booking-taxes.edit', $data);
            }

            return redirect()->route('booking-taxes.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong!');
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

            $record = $this->taxesInterface->update($id, $inputs);

            return redirect()->route('booking-taxes.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong!');
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

                $record = $this->taxesInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('booking-taxes.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('booking-taxes.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong!');
        }
    }

    public function setDefault(BookingTax $booking_tax)
    {
        abort_if(request()->ajax(), 403);

        try {
            $this->taxesInterface->setDefault($booking_tax->id);
            return redirect()->route('booking-taxes.index')->withSuccess('Default set!');
        } catch (GeneralException|Exception $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-taxes.index')->withDanger('Something went wrong!');
        }
    }
}
