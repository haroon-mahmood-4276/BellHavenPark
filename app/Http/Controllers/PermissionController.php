<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionsDataTable;
use Illuminate\Http\Request;
use App\Services\Permissions\PermissionInterface;
use App\Http\Requests\Permissions\{storeRequest, updateRequest};
use App\Models\{Permission, Role};
use Exception;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('permissions.index');
    }

    public function assignPermissionToRole(Request $request)
    {
        try {
            $permission = Permission::find($request->permission_id)->assignRole(Role::find($request->role_id));

            return response()->json([
                'success' => true,
                'message' => "Permission Assigned Sucessfully",
            ], 200);
        } catch (Exception $ex) {
            return response()->json(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    public function revokePermissionToRole(Request $request)
    {
        try {
            $permission = Permission::find($request->permission_id)->removeRole(Role::find($request->role_id));

            return response()->json([
                'success' => true,
                'message' => "Permission Revoked Sucessfully",
            ], 200);
        } catch (Exception $ex) {
            return response()->json(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    // public function refreshPermissions(Request $request)
    // {
    //     Artisan::call('db:seed', ['--class' => 'DemoPermissionsPermissionsTableSeeder']);
    //     redirect()->back();
    // }

    // public function roleHasPermission(Request $request)
    // {
    //     $input = Request::all();
    //     //dd($input);
    //     $result = $this->permissionRepository->roleHasPermission($input);
    //     return json_encode($result);
    // }
}
