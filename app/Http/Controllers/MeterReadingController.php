<?php

namespace App\Http\Controllers;

use App\DataTables\MeterReadingsDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\MeterReadings\storeRequest;
use App\Models\MeterReading;
use App\Services\Cabins\CabinInterface;
use App\Services\MeterReadings\MeterReadingInterface;
use App\Utils\Enums\MeterTypes;
use Illuminate\Http\Request;
use Exception;

class MeterReadingController extends Controller
{
    private $meterReadingInterface, $cabinInterface;

    public function __construct(MeterReadingInterface $meterReadingInterface, CabinInterface $cabinInterface)
    {
        $this->meterReadingInterface = $meterReadingInterface;
        $this->cabinInterface = $cabinInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MeterReadingsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('meter-readings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        abort_if(request()->ajax(), 403);

        $data = [
            'meter_types' => MeterTypes::array(),
        ];

        return view('meter-readings.create', $data);
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
            $this->meterReadingInterface->store($inputs);

            if ($request->add_another_reading)
                return redirect()->route('meter-readings.create')->withSuccess('Data saved!');

            return redirect()->route('meter-readings.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong!');
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
    public function edit(MeterReading $meterReading)
    {
        abort_if(request()->ajax(), 403);

        try {
            $data = [
                'meter_types' => MeterTypes::array(),
                'meterReading' => $meterReading,
                'cabin' => $this->cabinInterface->getById($meterReading->cabin_id),
            ];

            return view('meter-readings.edit', $data);
        } catch (GeneralException $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong!');
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
            $record = $this->customerInterface->update($id, $inputs);
            return redirect()->route('meter-readings.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        abort_if(request()->ajax(), 403);
        try {

            if ($request->has('checkForDelete')) {

                $record = $this->customerInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('meter-readings.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('meter-readings.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('meter-readings.index')->withDanger('Something went wrong!');
        }
    }
}
