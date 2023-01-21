<?php

namespace App\Http\Controllers;

use App\DataTables\CabinsDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\Cabins\{storeRequest, updateRequest};
use App\Services\Cabins\CabinInterface;
use App\Services\CabinStatuses\CabinStatusInterface;
use App\Services\CabinTypes\CabinTypeInterface;
use Exception;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    private $cabinInterface, $cabinTypeInterface, $cabinStatusInterface;

    public function __construct(CabinInterface $cabinInterface, CabinStatusInterface $cabinStatusInterface, CabinTypeInterface $cabinTypeInterface)
    {
        $this->cabinInterface = $cabinInterface;
        $this->cabinStatusInterface = $cabinStatusInterface;
        $this->cabinTypeInterface = $cabinTypeInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CabinsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('cabins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(request()->ajax(), 403);

        $data = [
            'cabin_types' => $this->cabinTypeInterface->getAll(),
            'cabin_statuses' => $this->cabinStatusInterface->getAll(),
        ];
        return view('cabins.create', $data);
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
            $record = $this->cabinInterface->store($inputs);
            return redirect()->route('cabins.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong!');
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
            $cabin = $this->cabinInterface->getById(decryptParams($id));

            if ($cabin && !empty($cabin)) {
                $data = [
                    'cabin_types' => $this->cabinTypeInterface->getAll(),
                    'cabin_statuses' => $this->cabinStatusInterface->getAll(),
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

            $id = decryptParams($id);

            $inputs = $request->validated();

            $record = $this->cabinInterface->update($id, $inputs);

            return redirect()->route('cabins.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.index')->withDanger('Something went wrong!');
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
}
