<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\DataTables\PermissionsDataTable;
use App\Services\Admin\Permissions\PermissionInterface;
use Spatie\Permission\Models\{Role, Permission};
use Illuminate\Http\Request;
use App\Http\Requests\Admin\permissions\{
    storeRequest as permissionStoreRequest,
    updateRequest as permissionUpdateRequest
};
use Exception;

class PermissionController extends Controller
{

    // private $permissionInterface;

    // public function __construct(PermissionInterface $permissionInterface)
    // {
    //     $this->permissionInterface = $permissionInterface;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionsDataTable $dataTable)
    {
        return $dataTable->render('admin.app.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.app.permissions.create');
    }

    public function assignPermissionToRole(Request $request)
    {
        try {
            $role = (new Role())->find($request->role_id);
            $role->givePermissionTo($request->permission_id);

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
            $role = (new Role())->find($request->role_id);
            $role->revokePermissionTo($request->permission_id);

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
