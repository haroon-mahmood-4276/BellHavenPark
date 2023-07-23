<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentMethodsDataTable;
use App\Exceptions\GeneralException;
use App\Services\PaymentMethods\PaymentMethodInterface;
use App\Http\Requests\PaymentMethods\{
    storeRequest,
    updateRequest
};
use Exception;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    private $paymentMethodInterface;

    public function __construct(PaymentMethodInterface $paymentMethodInterface)
    {
        $this->paymentMethodInterface = $paymentMethodInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaymentMethodsDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('payment-methods.index');
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
        return view('payment-methods.create', $data);
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
            $record = $this->paymentMethodInterface->store($inputs);
            return redirect()->route('payment-methods.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong!');
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
            $payment_method = $this->paymentMethodInterface->find($id);

            if ($payment_method && !empty($payment_method)) {
                $data = [
                    'paymentMethod' => $payment_method,
                ];

                return view('payment-methods.edit', $data);
            }

            return redirect()->route('payment-methods.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong!');
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

            $record = $this->paymentMethodInterface->update($id, $inputs);

            return redirect()->route('payment-methods.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong!');
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

                $record = $this->paymentMethodInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('payment-methods.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('payment-methods.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('payment-methods.index')->withDanger('Something went wrong!');
        }
    }
}
