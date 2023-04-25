<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\{
    StoreRequest as CustomerStoreRequest,
    UpdateRequest as CustomerUpdateRequest,
};
use App\Models\{
    Customer,
    InternationalId
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
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
                'customers' => (new Customer())->getAllWithPagination(20),
            ];

            // dd($data);
            return view('customers.index', $data);
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

            $data = [
                'id_types' => (new InternationalId() )->getAll(),
            ];

            return view('customers.create', $data);
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
    public function store(CustomerStoreRequest $request)
    {
        if (!request()->ajax()) {
            $result = (new Customer())->storeCustomer($request);

            if (is_a($result, 'Exception')) {
                Log::debug('Customer Store => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('customers.create')->withDanger('Data not saved. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('customers.index')->withSuccess('Data saved.');
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
                'id_types' => (new InternationalId() )->getAll(),
                'customer' => (new Customer())->getById($id),
            ];

            // dd(json_decode($data['customer']->tenants));

            if (is_a($data['customer'], 'Exception')) {
                Log::debug('Customer Edit => Error Code: ' . $data['customer']->getCode() . 'Error Message: ' . $data['customer']->getMessage());
                return redirect()->route('customers.index')->withDanger('Data not found.');
            }
            return view('customers.edit', $data);
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
    public function update(CustomerUpdateRequest $request, $id)
    {
        if (!request()->ajax()) {
            $result = (new Customer())->updateCustomer($request, $id);

            if (is_a($result, 'Exception')) {
                Log::debug('Customer Update => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('customers.edit', ['customer' => $id])->withDanger('Data not updated. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('customers.index')->withSuccess('Data updated.');
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
                $result = (new Customer())->destroyCustomer($request->get('delete'));


            if (is_a($result, 'Exception')) {
                Log::debug('Customer Destroy => Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
                return redirect()->route('customers.index')->withDanger('Data not deleted. Something went wrong. Please consult with site developer.');
            }
            return redirect()->route('customers.index')->withSuccess('Data deleted.');
            } else
                return redirect()->route('customers.index')->withWarning('Please select atleast one row.');
        } else {
            abort(403);
        }
    }
}
