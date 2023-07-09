<?php

namespace App\Http\Controllers;

use App\DataTables\CabinTypesDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\CabinTypes\{storeRequest, updateRequest};
use App\Services\CabinTypes\CabinTypeInterface;
use Exception;
use Illuminate\Http\Request;

class CabinTypeController extends Controller
{
    private $cabinTypesInterface;

    public function __construct(CabinTypeInterface $cabinTypesInterface)
    {
        $this->cabinTypesInterface = $cabinTypesInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CabinTypesDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('cabin-types.index');
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
        return view('cabin-types.create', $data);
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
            $record = $this->cabinTypesInterface->store($inputs);
            return redirect()->route('cabin-types.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong!');
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
            $cabin_type = $this->cabinTypesInterface->getById($id);

            if ($cabin_type && !empty($cabin_type)) {
                $data = [
                    'cabin_type' => $cabin_type,
                ];

                return view('cabin-types.edit', $data);
            }

            return redirect()->route('cabin-types.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong!');
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

            $record = $this->cabinTypesInterface->update($id, $inputs);

            return redirect()->route('cabin-types.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong!');
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

                $record = $this->cabinTypesInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('cabin-types.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('cabin-types.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabin-types.index')->withDanger('Something went wrong!');
        }
    }
}
