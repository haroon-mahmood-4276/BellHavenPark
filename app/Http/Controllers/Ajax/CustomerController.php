<?php

namespace App\Http\Controllers\Ajax;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Services\Customers\CustomerInterface;
use Illuminate\Http\Request;
use Exception;

class CustomerController extends Controller
{
    private $customerInterface, $internationalIdInterface;

    public function __construct(CustomerInterface $customerInterface)
    {
        $this->customerInterface = $customerInterface;
    }

    public function index(Request $request)
    {
        try {
            $customers = [];
            if ($request->type === 'query' && strlen($request->q) > 1) {
                $customers = $this->customerInterface->search($request->q);
            }
            return apiSuccessResponse($customers);
        } catch (GeneralException $ex) {
        } catch (Exception $ex) {
        }
    }
}
