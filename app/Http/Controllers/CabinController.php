<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cabin\{
    StoreRequest as CabinStoreRequest,
    UpdateRequest as CabinUpdateRequest,
};
use App\Models\Cabin;
use App\Models\CabinStatus;
use App\Models\CabinType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CabinController extends Controller
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
                'cabins' => (new Cabin())->getAllWithPagination(20),
            ];

            // dd($data);
            return view('cabins.index', $data);
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

            $data = [
                'cabin_types' => (new CabinType())->getAll(),
                'cabin_statuses' => (new CabinStatus())->getAll(),
            ];

            return view('cabins.create', $data);
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
    public function store(CabinStoreRequest $request)
    {
        if (!request()->ajax()) {
            $result = (new Cabin())->storeCabin($request);

            if (is_a($result, 'Exception')) {
                Log::debug('Cabin Store => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('cabins.create')->withDanger('Data not saved. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('cabins.index')->withSuccess('Data saved.');
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
                'cabin_types' => (new CabinType())->getAll(),
                'cabin_statuses' => (new CabinStatus())->getAll(),
                'cabin' => (new Cabin())->getById($id),
            ];

            if (is_a($data['cabin'], 'Exception')) {
                Log::debug('Cabin Edit => Error Code: ' . $data['cabin']->getCode() . 'Error Message: ' . $data['cabin']->getMessage());
                return redirect()->route('cabins.index')->withDanger('Data not found.');
            }
            return view('cabins.edit', $data);
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
    public function update(CabinUpdateRequest $request, $id)
    {
        if (!request()->ajax()) {

            // dd($request->input());
            $result = (new Cabin())->updateCabin($request, $id);

            if (is_a($result, 'Exception')) {
                Log::debug('Cabin Update => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('cabins.edit', ['cabin' => $id])->withDanger('Data not updated. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('cabins.index')->withSuccess('Data updated.');
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
                $result = (new Cabin())->destroyCabin($request->get('delete'));

                if (is_a($result, 'Exception')) {
                    Log::debug('Cabin Destroy => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                    return redirect()->route('cabins.create')->withDanger('Data not deleted. Something went wrong. Please consult with site developer.');
                }
                return redirect()->route('cabins.index')->withSuccess('Data deleted.');
            } else
                return redirect()->route('cabins.index')->withWarning('Please select atleast one row.');
        } else {
            abort(403);
        }
    }
}
