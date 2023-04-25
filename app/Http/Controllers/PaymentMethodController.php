<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentMethodDataTable;
use App\Http\Requests\PaymentMethods\{
    storeRequest as PaymentMethodStoreRequest,
    updateRequest as PaymentMethodUpdateRequest,
};
use App\Services\PaymentMethods\PaymentMethodInterface;
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
     * @return Application|Factory|View
     */
    public function index(PaymentMethodDataTable $dataTable)
    {
        return $dataTable->render('paymentmethods.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (!request()->ajax()) {
            return view('paymentmethods.create');
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
    public function store(PaymentMethodStoreRequest $request)
    {
        if (!request()->ajax()) {
            $inputs = $request->validated();

            $record = $this->paymentMethodInterface->store($inputs);
            if (!is_a($record, 'Exception')) {
                return redirect()->route('payment_methods.index')->withSuccess(__('Data Saved'));
            } else {
                return redirect()->route('payment_methods.index')->withDanger(__('Something went wrong'));
            }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $paymentMethod = $this->paymentMethodInterface->getById($id);

            if ($paymentMethod && !empty($paymentMethod)) {
                return view('paymentmethods.edit', ['paymentMethod' => $paymentMethod]);
            }

            return redirect()->route('payment_methods.index')->withWarning('Data not found');
        } catch (Exception $ex) {
            return redirect()->route('payment_methods.index')->withDanger('Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethodUpdateRequest $request, $id)
    {
        if (!request()->ajax()) {
            $inputs = $request->validated();

            $record = $this->paymentMethodInterface->update($id, $inputs);
            if (!is_a($record, 'Exception')) {
                return redirect()->route('payment_methods.index')->withSuccess(__('Data Updated'));
            } else {
                return redirect()->route('payment_methods.index')->withDanger(__('Something went wrong'));
            }
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
    public function destroy(Request $request)
    {
        if (!request()->ajax()) {
            if ($request->has('chkTableRow')) {
                $record = $this->paymentMethodInterface->destroy(encryptParams($request->chkTableRow));
                if (!is_a($record, 'Exception')) {
                    return redirect()->route('payment_methods.index')->withSuccess(__('Data Updated'));
                } else {
                    return redirect()->route('payment_methods.index')->withDanger(__('Something went wrong'));
                }
            }
        } else {
            abort(403);
        }
    }
}
