<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{Role, RolesPermission};
use Exception;
use Illuminate\Http\{Request};
use App\Http\Requests\Role\{
    StoreRequest as RoleStoreRequest,
    UpdateRequest as RoleUpdateRequest,
};

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (!request()->ajax()) {
            if (!permission_check('roles')->all) {
                abort(403);
            }

            $data = [
                'roles' => (new Role())->getAllWithPagination(20),
            ];

            return view('roles.index', $data);
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
            if (!permission_check('roles')->all || !permission_check('roles')->store) {
                abort(403);
            }
            return view('roles.create');
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(RoleStoreRequest $request)
    {
        if (!request()->ajax()) {
            if (!permission_check('roles')->all || !permission_check('roles')->store) {
                abort(403);
            }

            $role = (new Role())->storeRole($request);

            if ($role == 'Y') {
                return redirect()->route('roles.index')->withSuccess('Data saved.');
            }

            return redirect()->route('roles.index')->withDanger('Data not saved. Error Code: ' . $role->getCode() . 'Error Message: ' . $role->getMessage());
        } else {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|JsonResponse
     */
    public function edit(Request $request, $id)
    {
        if (!request()->ajax()) {
            if (!permission_check('roles')->all || !permission_check('roles')->update) {
                abort(403);
            }
            $data['role'] = (new Role())->getById($id);

            if ($data['role']) {
                return view('roles.edit', $data);
            }

            return redirect()->route('roles.index')->withDanger('Data not found.');
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        if (!request()->ajax()) {
            if (!permission_check('roles')->all || !permission_check('roles')->update) {
                abort(403);
            }

            $result = (new Role())->updateRole($request, $id);

            if (is_a($result, 'Exception')) {
                return redirect()->route('roles.index')->withDanger('Data not updated. ' . $result->getMessage());
            }
            return redirect()->route('roles.index')->withSuccess('Data updated.');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        if (!request()->ajax()) {
            if (!permission_check('roles')->all || !permission_check('roles')->destroy) {
                abort(403);
            }

            if ($request->has('delete')) {

                $role = (new Role())->destroyRole($request->get('delete'));

                if ($role == 'Y') {
                    return redirect()->route('roles.index')->withSuccess('Data deleted.');
                }

                return redirect()->route('roles.index')->withDanger('Data not deleted.');
            } else
                return redirect()->route('roles.index')->withWarning('Please select atleast one row.');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Application|Factory|View|void
     */
    public function permissions($id)
    {
        if (!request()->ajax()) {

            if (!permission_check('permissions')->all || !permission_check('permissions')->update) {
                abort(403);
            }

            //            $id = decryptParams( $id );

            $data = [
                'role' => (new Role())->getById($id),
                'roles_permissions' => (new RolesPermission())->getPermissions($id),
            ];

            // dd($data);
            return view('roles.permission', $data);
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return Application|Factory|View|void
     * @throws Exception
     */
    public function updatePermissions(Request $request, $id)
    {
        //    dd($request->input());
        if (!request()->ajax()) {

            if (!permission_check('permissions')->all || !permission_check('permissions')->update) {
                abort(403);
            }

            $result = (new RolesPermission())->updatePermissions($request->input('check'));
            if (is_a($result, 'Exception')) {
                return redirect()->route('roles.index')->withDanger('Data not saved. Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
            }
            cache()->flush();
            return redirect()->route('roles.index')->withSuccess('Permissions updated.');
        } else {
            abort(403);
        }
    }
}
