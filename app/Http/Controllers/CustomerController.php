<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\Exceptions\GeneralException;
use App\Http\Requests\Customers\{storeRequest, updateRequest};
use App\Services\Customers\CustomerInterface;
use App\Services\InternationalIds\InternationalIdInterface;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerInterface, $internationalIdInterface;

    public function __construct(CustomerInterface $customerInterface, InternationalIdInterface $internationalIdInterface)
    {
        $this->customerInterface = $customerInterface;
        $this->internationalIdInterface = $internationalIdInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomersDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('customers.index');
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
            'international_ids' => $this->internationalIdInterface->getAll(),
        ];
        return view('customers.create', $data);
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
            $record = $this->customerInterface->store($inputs);
            return redirect()->route('customers.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong!');
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
            $cabin = $this->customerInterface->getById(decryptParams($id));

            if ($cabin && !empty($cabin)) {
                $data = [
                    'cabin_types' => $this->cabinTypeInterface->getAll(),
                    'cabin_statuses' => $this->cabinStatusInterface->getAll(),
                    'cabin' => $cabin,
                ];

                return view('customers.edit', $data);
            }

            return redirect()->route('customers.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong!');
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
            $record = $this->customerInterface->update($id, $inputs);
            return redirect()->route('customers.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong!');
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
                    return redirect()->route('customers.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('customers.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('customers.index')->withDanger('Something went wrong!');
        }
    }
}
