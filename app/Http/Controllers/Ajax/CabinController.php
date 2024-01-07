<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\Cabins\CabinInterface;
use App\Services\CabinTypes\CabinTypeInterface;
use App\Utils\Enums\CabinStatus;
use Exception;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    private $cabinInterface;

    public function __construct(CabinInterface $cabinInterface)
    {
        $this->cabinInterface = $cabinInterface;
    }

    public function modalAddCabinToMaintenance(Request $request)
    {
        try {
            abort_if(!request()->ajax(), 403);

            $cabins = $this->cabinInterface->getAll(ignore_status: CabinStatus::MAINTENANCE->value)->toArray();

            $data = [
                'modalPlace' => 'modalPlace',
                'currentModal' => 'basicModal',
                'modal' => view('cabins.maintenance.modal.index', ['cabins' => $cabins])->render(),
            ];

            return apiSuccessResponse($data);
        } catch (Exception $ex) {
            return apiErrorResponse(data: ['line_number' => $ex->getLine(),], message: $ex->getMessage(), code: $ex->getCode() > 0 ? $ex->getCode() : 400);
        }
    }
}
