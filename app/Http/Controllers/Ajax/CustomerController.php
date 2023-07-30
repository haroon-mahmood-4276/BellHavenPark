<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\CustomerRatings\CustomerRatingInterface;
use App\Services\Customers\CustomerInterface;
use Illuminate\Http\Request;
use Exception;

class CustomerController extends Controller
{
    private $customerInterface;
    private $customerRatingInterface;

    public function __construct(CustomerInterface $customerInterface, CustomerRatingInterface $customerRatingInterface)
    {
        $this->customerInterface = $customerInterface;
        $this->customerRatingInterface = $customerRatingInterface;
    }

    public function index(Request $request)
    {
        try {
            $customers = [];
            if ($request->type === 'query' && strlen($request->q) > 1) {
                $customers = $this->customerInterface->search($request->q, ($request->has('ignoredCustomerId') ? intval($request->ignoredCustomerId) : 0));
            }
            return apiSuccessResponse($customers);
        } catch (Exception $ex) {
            return apiErrorResponse(message: $ex->getMessage(), code: $ex->getCode());
        }
    }

    public function commentModalIndex(Customer $customer)
    {
        try {
            abort_if(!request()->ajax(), 403);

            $data = [
                'modalPlace' => 'modalPlace',
                'currentModal' => 'basicModal',
                'modal' => view('customers.modal.index', ['customer' => $customer])->render(),
            ];

            return apiSuccessResponse($data);
        } catch (Exception $ex) {
            return apiErrorResponse(data: [
                'line_number' => $ex->getLine(),
            ], message: $ex->getMessage(), code: $ex->getCode() > 0 ? $ex->getCode() : 400);
        }
    }

    public function commentModalStore(Request $request, Customer $customer)
    {
        try {
            abort_if(!request()->ajax(), 403);

            $inputs = $request->input();
            $this->customerRatingInterface->store($customer->id, $inputs);

            return apiSuccessResponse(message: 'Comment added.');
        } catch (Exception $ex) {
            return apiErrorResponse(message: $ex->getMessage(), code: $ex->getCode() > 0 ? $ex->getCode() : 400);
        }
    }
}
