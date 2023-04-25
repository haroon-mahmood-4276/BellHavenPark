<?php

namespace App\Http\Controllers;

use App\Models\InternationalId;
use Illuminate\Http\Request;
use Log;

class InternationalIdController extends Controller
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
                'international_ids' => (new InternationalId())->getAllWithPagination(20),
            ];

            // dd($data);
            return view('internationalids.index', $data);
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
            return view('internationalids.create');
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
    public function store(Request $request)
    {
        if (!request()->ajax()) {
            $request->validate([
                'name' => 'required|string|between:3,50',
            ]);

            $result = (new InternationalId())->storeInternationalId($request);

            if (is_a($result, 'Exception')) {
                return redirect()->route('internationalids.index')->withDanger('Data not saved. Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
            }
            return redirect()->route('internationalids.index')->withSuccess('Data saved.');
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
                'internationalId' => (new InternationalId())->getById($id),
            ];

            if (is_a($data['internationalId'], 'Exception')) {
                Log::debug('International Id Edit => Error Code: ' . $data['internationalId']->getCode() . 'Error Message: ' . $data['internationalId']->getMessage());
                return redirect()->route('internationalids.index')->withDanger('Data not found.');
            }
            return view('internationalids.edit', $data);
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
    public function update(Request $request, $id)
    {
        if (!request()->ajax()) {

            $request->validate([
                'name' => 'required|string|between:3,50',
            ]);

            $result = (new InternationalId())->updateInternationalId($request, $id);

            if (is_a($result, 'Exception')) {
                Log::debug('International Id Update => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('internationalids.index')->withDanger('Data not updated. Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
            }
            return redirect()->route('internationalids.index')->withSuccess('Data update.');
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

                $result = (new InternationalId())->destroyInternationalId($request->get('delete'));

                if (is_a($result, 'Exception')) {
                    return redirect()->route('internationalids.index')->withDanger('Data not deleted. Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                }

                return redirect()->route('internationalids.index')->withSuccess('Data deleted.');
            } else
                return redirect()->route('internationalids.index')->withWarning('Please select atleast one row.');
        } else {
            abort(403);
        }
    }
}
