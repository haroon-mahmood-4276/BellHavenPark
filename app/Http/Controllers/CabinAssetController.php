<?php

namespace App\Http\Controllers;

use App\DataTables\CabinAssetsDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\CabinAssets\{storeRequest, updateRequest};
use App\Services\CabinAssets\CabinAssetInterface;
use Exception;
use Illuminate\Http\Request;

class CabinAssetController extends Controller
{
    private $cabinAssetInterface;

    public function __construct(CabinAssetInterface $cabinAssetInterface)
    {
        $this->cabinAssetInterface = $cabinAssetInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CabinAssetsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('cabins.assets.index');
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
        return view('cabins.assets.create', $data);
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
            $record = $this->cabinAssetInterface->store($inputs);
            return redirect()->route('cabins.assets.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong!');
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
            $cabin_asset = $this->cabinAssetInterface->getById($id);

            if ($cabin_asset && !empty($cabin_asset)) {
                $data = [
                    'cabin_asset' => $cabin_asset,
                ];

                return view('cabins.assets.edit', $data);
            }

            return redirect()->route('cabins.assets.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong!');
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

            $record = $this->cabinAssetInterface->update($id, $inputs);

            return redirect()->route('cabins.assets.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong!');
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

                $record = $this->cabinAssetInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('cabins.assets.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('cabins.assets.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('cabins.assets.index')->withDanger('Something went wrong!');
        }
    }
}
