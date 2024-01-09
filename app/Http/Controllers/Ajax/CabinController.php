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

    public function modalAddToMaintenance(Request $request)
    {
        try {
            abort_if(!request()->ajax(), 403);

            $cabins = $this->cabinInterface->getAll(ignore_status: [CabinStatus::MAINTENANCE])->toArray();

            $data = [
                'modalPlace' => 'modalPlace',
                'currentModal' => 'basicModal',
                'modal' => view('cabins.maintenance.modal.create', ['cabins' => $cabins])->render(),
            ];

            return apiSuccessResponse($data);
        } catch (Exception $ex) {
            return apiErrorResponse(data: ['line_number' => $ex->getLine(),], message: $ex->getMessage(), code: $ex->getCode() > 0 ? $ex->getCode() : 400);
        }
    }

    public function modalRemoveFromMaintenance(Request $request)
    {
        try {
            abort_if(!request()->ajax(), 403);

                $cabins = $this->cabinInterface->getAll(ignore_status: [
                    CabinStatus::VACANT,
                    CabinStatus::CLOSED_PERMANENTLY,
                    CabinStatus::CLOSED_TEMPORARILY,
                    CabinStatus::NEEDS_CLEANING,
                    CabinStatus::OCCUPIED,
                ])->toArray();
            

            $cabinToRemove = $request->cabins ?? [];

            $data = [
                'modalPlace' => 'modalPlace',
                'currentModal' => 'basicModal',
                'modal' => view('cabins.maintenance.modal.delete', ['cabins' => $cabins, 'cabinToRemove' => $cabinToRemove])->render(),
            ];

            return apiSuccessResponse($data);
        } catch (Exception $ex) {
            return apiErrorResponse(data: ['line_number' => $ex->getLine(),], message: $ex->getMessage(), code: $ex->getCode() > 0 ? $ex->getCode() : 400);
        }
    }

    public function modalAddToNeedsCleaning(Request $request)
    {
        try {
            abort_if(!request()->ajax(), 403);

            $cabins = $this->cabinInterface->getAll(ignore_status: [CabinStatus::NEEDS_CLEANING])->toArray();

            $data = [
                'modalPlace' => 'modalPlace',
                'currentModal' => 'basicModal',
                'modal' => view('cabins.needs-cleaning.modal.create', ['cabins' => $cabins])->render(),
            ];

            return apiSuccessResponse($data);
        } catch (Exception $ex) {
            return apiErrorResponse(data: ['line_number' => $ex->getLine(),], message: $ex->getMessage(), code: $ex->getCode() > 0 ? $ex->getCode() : 400);
        }
    }

    public function modalRemoveFromNeedsCleaning(Request $request)
    {
        try {
            abort_if(!request()->ajax(), 403);

                $cabins = $this->cabinInterface->getAll(ignore_status: [
                    CabinStatus::VACANT,
                    CabinStatus::CLOSED_PERMANENTLY,
                    CabinStatus::CLOSED_TEMPORARILY,
                    CabinStatus::MAINTENANCE,
                    CabinStatus::OCCUPIED,
                ])->toArray();
            

            $cabinToRemove = $request->cabins ?? [];

            $data = [
                'modalPlace' => 'modalPlace',
                'currentModal' => 'basicModal',
                'modal' => view('cabins.needs-cleaning.modal.delete', ['cabins' => $cabins, 'cabinToRemove' => $cabinToRemove])->render(),
            ];

            return apiSuccessResponse($data);
        } catch (Exception $ex) {
            return apiErrorResponse(data: ['line_number' => $ex->getLine(),], message: $ex->getMessage(), code: $ex->getCode() > 0 ? $ex->getCode() : 400);
        }
    }
}
