<?php

namespace App\Http\Controllers;

use App\DataTables\{CabinMaintenanceDataTable, CabinNeedCleaningDataTable, CabinsDataTable};
use App\Exceptions\GeneralException;
use App\Http\Requests\Cabins\{storeRequest, updateRequest};
use App\Services\{Cabins\CabinInterface, CabinTypes\CabinTypeInterface};
use App\Utils\Enums\CabinStatus;
use Illuminate\Http\Request;
use Exception;

class CabinController extends Controller
{
    private $cabinInterface, $cabinTypeInterface;

    public function __construct(CabinInterface $cabinInterface, CabinTypeInterface $cabinTypeInterface)
    {
        $this->cabinInterface = $cabinInterface;
        $this->cabinTypeInterface = $cabinTypeInterface;
    }

    public function index(Request $request, CabinsDataTable $dataTable)
    {

        $data = ['cabin_statuses' => CabinStatus::array(withText: true), 'filters' => $request->filters ?: []];
        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }

        return $dataTable->with($data)->render('cabins.index', $data);
    }

    public function create()
    {
        abort_if(request()->ajax(), 403);

        $data = [
            'cabin_types' => $this->cabinTypeInterface->get(),
            'cabin_statuses' => CabinStatus::array(withText: true),
        ];
        return view('cabins.create', $data);
    }

    public function store(storeRequest $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            $inputs = $request->validated();
            $record = $this->cabinInterface->store($inputs);
            return redirect()->route('cabins.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong!');
        }
    }

    public function show($id)
    {
        abort(403);
    }

    public function edit($id)
    {
        abort_if(request()->ajax(), 403);

        try {
            $cabin = $this->cabinInterface->getById($id);

            if ($cabin && !empty($cabin)) {
                $data = [
                    'cabin_types' => $this->cabinTypeInterface->get(),
                    'cabin_statuses' => CabinStatus::array(withText: true),
                    'cabin' => $cabin,
                ];

                return view('cabins.edit', $data);
            }

            return redirect()->route('cabins.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong!');
        }
    }

    public function update(updateRequest $request, $id)
    {
        abort_if(request()->ajax(), 403);
        try {
            $inputs = $request->validated();

            $record = $this->cabinInterface->update($id, $inputs);

            return redirect()->route('cabins.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong!');
        }
    }

    public function destroy(Request $request)
    {
        abort_if(request()->ajax(), 403);
        try {

            if ($request->has('checkForDelete')) {

                $record = $this->cabinInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('cabins.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('cabins.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong!');
        }
    }

    public function addCabinToNeedsCleaningIndex(Request $request, CabinNeedCleaningDataTable $dataTable)
    {
        $data = [];

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }

        return $dataTable->with($data)->render('cabins.needs-cleaning.index', $data);
    }

    public function addCabinToMaintenanceIndex(Request $request, CabinMaintenanceDataTable $dataTable)
    {
        $data = [];

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }

        return $dataTable->with($data)->render('cabins.maintenance.index', $data);
    }

    public function addToMaintenance(Request $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            if ($request->has('cabins')) {

                $record = $this->cabinInterface->setStatus($request->cabins, CabinStatus::MAINTENANCE->value, $request->reason);

                if (!$record) {
                    return redirect()->route('cabins.maintenance.index')->withDanger('Data not found!');
                }
                return redirect()->route('cabins.maintenance.index')->withSuccess('Cabin Updated!');
            }
            return redirect()->route('cabins.maintenance.index')->withWarning('Atleast select one cabin!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.maintenance.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.maintenance.index')->withDanger('Something went wrong!');
        }
    }
    
    public function removeFromMaintenance(Request $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            if ($request->has('cabins')) {

                $record = $this->cabinInterface->setStatus($request->cabins, CabinStatus::VACANT->value, $request->reason);

                if (!$record) {
                    return redirect()->route('cabins.maintenance.index')->withDanger('Data not found!');
                }
                return redirect()->route('cabins.maintenance.index')->withSuccess('Cabin Updated!');
            }
            return redirect()->route('cabins.maintenance.index')->withWarning('Atleast select one cabin!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.maintenance.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.maintenance.index')->withDanger('Something went wrong!');
        }
    }

    public function addToNeedsCleaning(Request $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            if ($request->has('cabins')) {

                $record = $this->cabinInterface->setStatus($request->cabins, CabinStatus::NEEDS_CLEANING->value, $request->reason);

                if (!$record) {
                    return redirect()->route('cabins.needs-cleaning.index')->withDanger('Data not found!');
                }
                return redirect()->route('cabins.needs-cleaning.index')->withSuccess('Cabin Updated!');
            }
            return redirect()->route('cabins.needs-cleaning.index')->withWarning('Atleast select one cabin!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.needs-cleaning.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.needs-cleaning.index')->withDanger('Something went wrong!');
        }
    }
    
    public function removeFromNeedsCleaning(Request $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            if ($request->has('cabins')) {

                $record = $this->cabinInterface->setStatus($request->cabins, CabinStatus::VACANT->value, $request->reason);

                if (!$record) {
                    return redirect()->route('cabins.needs-cleaning.index')->withDanger('Data not found!');
                }
                return redirect()->route('cabins.needs-cleaning.index')->withSuccess('Cabin Updated!');
            }
            return redirect()->route('cabins.needs-cleaning.index')->withWarning('Atleast select one cabin!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.needs-cleaning.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.needs-cleaning.index')->withDanger('Something went wrong!');
        }
    }
}
