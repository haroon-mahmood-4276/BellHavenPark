<?php

namespace App\Http\Controllers;

use App\DataTables\InternationalIdsDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\InternationalIds\{storeRequest, updateRequest};
use App\Services\InternationalIds\InternationalIdInterface;
use Exception;
use Illuminate\Http\Request;

class InternationalIdController extends Controller
{
    private $internationalIdInterface;

    public function __construct(InternationalIdInterface $internationalIdInterface)
    {
        $this->internationalIdInterface = $internationalIdInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InternationalIdsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('international-ids.index');
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
        return view('international-ids.create', $data);
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
            $record = $this->internationalIdInterface->store($inputs);
            return redirect()->route('international-ids.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong!');
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
            $international_id = $this->internationalIdInterface->find($id);

            if ($international_id && !empty($international_id)) {
                $data = [
                    'internationalId' => $international_id,
                ];

                return view('international-ids.edit', $data);
            }

            return redirect()->route('international-ids.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong!');
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

            $record = $this->internationalIdInterface->update($id, $inputs);

            return redirect()->route('international-ids.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong!');
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

                $record = $this->internationalIdInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('international-ids.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('international-ids.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('international-ids.index')->withDanger('Something went wrong!');
        }
    }
}
