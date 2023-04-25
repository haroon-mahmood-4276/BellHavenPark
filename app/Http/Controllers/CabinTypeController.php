<?php

namespace App\Http\Controllers;

use App\Http\Requests\CabinType\{
    StoreRequest as CabinTypeStoreRequest,
    UpdateRequest as CabinTypeUpdateRequest,
};
use App\Models\CabinType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CabinTypeController extends Controller
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
                'cabinTypes' => (new CabinType())->getAllWithPagination(20),
            ];

            // dd($data);
            return view('cabintypes.index', $data);
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
            return view('cabintypes.create');
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
    public function store(CabinTypeStoreRequest $request)
    {
        if (!request()->ajax()) {
            $result = (new CabinType())->storeCabinType($request);

            if (is_a($result, 'Exception')) {
                Log::debug('CabinType Store => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('cabin_types.create')->withDanger('Data not saved. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('cabin_types.index')->withSuccess('Data saved.');
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
                'cabinType' => (new CabinType())->getById($id),
            ];
// dd($data);
            if (is_a($data['cabinType'], 'Exception')) {
                Log::debug('CabinType Edit => Error Code: ' . $data['cabinType']->getCode() . 'Error Message: ' . $data['cabinType']->getMessage());
                return redirect()->route('cabin_types.index')->withDanger('Data not found.');
            }
            return view('cabintypes.edit', $data);
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
    public function update(CabinTypeUpdateRequest $request, $id)
    {
        if (!request()->ajax()) {

            // dd($request->input());
            $result = (new CabinType())->updateCabinType($request, $id);

            if (is_a($result, 'Exception')) {
                Log::debug('CabinType Update => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('cabin_types.edit', ['cabin_type' => $id])->withDanger('Data not updated. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('cabin_types.index')->withSuccess('Data updated.');
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
                $result = (new CabinType())->destroyCabinType($request->get('delete'));

                if (is_a($result, 'Exception')) {
                    Log::debug('CabinType Destroy => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                    return redirect()->route('cabin_types.index')->withDanger('Data not deleted. Something went wrong. Please consult with site developer.');
                }
                return redirect()->route('cabin_types.index')->withSuccess('Data deleted.');
            } else
                return redirect()->route('cabin_types.index')->withWarning('Please select atleast one row.');
        } else {
            abort(403);
        }
    }
}
