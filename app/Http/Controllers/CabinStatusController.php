<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CabinStatus\{
    StoreRequest as CabinStatusStoreRequest,
    UpdateRequest as CabinStatusUpdateRequest,
};
use App\Models\CabinStatus;
use Illuminate\Support\Facades\Log;

class CabinStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (!request()->ajax()) {

            $data = [
                'cabinStatuses' => (new CabinStatus())->getAllWithPagination(20),
            ];

            // dd($data);
            return view('cabinstatus.index', $data);
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (!request()->ajax()) {
            return view('cabinstatus.create');
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(CabinStatusStoreRequest $request)
    {
        if (!request()->ajax()) {
            $result = (new CabinStatus())->storeCabinStatus($request);

            if (is_a($result, 'Exception')) {
                Log::debug('CabinStatus Store => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('cabin_statuses.create')->withDanger('Data not saved. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('cabin_statuses.index')->withSuccess('Data saved.');
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        if (!request()->ajax()) {
            $data = [
                'cabinStatus' => (new CabinStatus())->getById($id),
            ];

            if (is_a($data['cabinStatus'], 'Exception')) {
                Log::debug('CabinStatus Edit => Error Code: ' . $data['cabinStatus']->getCode() . 'Error Message: ' . $data['cabinStatus']->getMessage());
                return redirect()->route('cabin_statuses.index')->withDanger('Data not found.');
            }
            return view('cabinstatus.edit', $data);

        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CabinStatusUpdateRequest $request, $id)
    {
        if (!request()->ajax()) {

            // dd($request->input());
            $result = (new CabinStatus())->updateCabinStatus($request, $id);

            if (is_a($result, 'Exception')) {
                Log::debug('CabinStatus Update => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('cabin_statuses.update', ['cabin_status' => $id])->withDanger('Data not updated. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('cabin_statuses.index')->withSuccess('Data updated.');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if (!request()->ajax()) {
            if ($request->has('delete')) {
                $result = (new CabinStatus())->destroyCabinStatus($request->get('delete'));

                if (is_a($result, 'Exception')) {
                    Log::debug('CabinStatus Store => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                    return redirect()->route('cabin_statuses.create')->withDanger('Data not deleted. Something went wrong. Please consult with site developer.');
                }
                return redirect()->route('cabin_statuses.index')->withSuccess('Data deleted.');
            } else
                return redirect()->route('cabin_statuses.index')->withWarning('Please select atleast one row.');
        } else {
            abort(403);
        }
    }
}
