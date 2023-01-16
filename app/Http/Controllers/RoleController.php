<?php

namespace App\Http\Controllers;

use App\DataTables\Admin\RolesDataTable;
use App\Services\Admin\Roles\RoleInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\{
    storeRequest as roleStoreRequest,
    updateRequest as roleUpdateRequest
};
use Exception;
use Illuminate\Http\Request;
use App\Models\Role;


class RoleController extends Controller
{

    private $roleInterface;

    public function __construct(RoleInterface $roleInterface)
    {
        $this->roleInterface = $roleInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTable)
    {
        $roles = (new Role())->inRandomOrder()->limit(5)->get();
        return $dataTable->render('admin.app.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(request()->ajax(), 403);

        $data = [
            'roles' => $this->roleInterface->getAllWithTree(),
        ];
        return view('admin.app.roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(roleStoreRequest $request)
    {
        try {

            $record = (new Role())->create([
                'name' => $request->role_name,
                'guard_name' => $request->guard_name,
                'parent_id' => $request->parent_id > 0 ? $request->parent_id : null,
            ]);

            return redirect()->route('admin.roles.index')->withSuccess(__('lang.commons.data_saved'));
        } catch (Exception $ex) {
            return redirect()->route('admin.roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
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
        try {
            $role = (new Role())->find(decryptParams($id));

            if ($role && !empty($role)) {
                $data = [
                    'roles' => $this->roleInterface->getAllWithTree(),
                    'role' => $role,
                ];

                return view('admin.app.roles.edit', $data);
            }

            return redirect()->route('admin.roles.index')->withWarning(__('lang.commons.data_not_found'));
        } catch (Exception $ex) {
            return redirect()->route('admin.roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(roleUpdateRequest $request, $id)
    {
        try {
            $record = (new Role())->where('id', decryptParams($id))->update([
                'name' => $request->role_name,
                'guard_name' => $request->guard_name,
                'parent_id' => $request->parent_id > 0 ? $request->parent_id : null,
            ]);

            return redirect()->route('admin.roles.index')->withSuccess(__('lang.commons.data_saved'));
        } catch (Exception $ex) {
            return redirect()->route('admin.roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            if ($request->has('chkRole')) {

                (new Role())->whereIn('id', $request->chkRole)->delete();

                return redirect()->route('admin.roles.index')->withSuccess(__('lang.commons.data_deleted'));
            } else {
                return redirect()->route('admin.roles.index')->withWarning(__('lang.commons.please_select_at_least_one_item'));
            }
        } catch (Exception $ex) {
            return redirect()->route('admin.roles.index')->withDanger(__('lang.commons.something_went_wrong') . ' ' . $ex->getMessage());
        }
    }
}
