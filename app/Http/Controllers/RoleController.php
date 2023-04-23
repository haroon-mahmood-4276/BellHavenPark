<?php

namespace App\Http\Controllers;

use App\DataTables\RolesDataTable;
use App\Exceptions\GeneralException;
use App\Services\Roles\RoleInterface;
use App\Http\Requests\Roles\{
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
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        $roles = (new Role())->withCount('users')->limit(5)->get();
        return $dataTable->render('roles.index', ['roles' => $roles]);
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
            'roles' => $this->roleInterface->getAll(with_tree: true),
        ];
        return view('roles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(roleStoreRequest $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            $inputs = $request->validated();
            $record = $this->roleInterface->store($inputs);
            return redirect()->route('roles.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong!');
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
            $role = (new Role())->find(decryptParams($id));

            if ($role && !empty($role)) {
                $data = [
                    'role' => $role,
                    'roles' => $this->roleInterface->getAll(ignore: $role->id, with_tree: true),
                ];

                return view('roles.edit', $data);
            }

            return redirect()->route('roles.index')->withWarning('Record not found!');
        } catch (GeneralException $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong!');
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
        abort_if(request()->ajax(), 403);
        try {

            $id = decryptParams($id);

            $inputs = $request->validated();

            $record = $this->roleInterface->update($id, $inputs);

            return redirect()->route('roles.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong!');
        }
    }

    public function destroy(Request $request)
    {
        abort_if(request()->ajax(), 403);
        try {

            if ($request->has('checkForDelete')) {

                $record = $this->roleInterface->destroy($request->checkForDelete);

                if (!$record) {
                    return redirect()->route('roles.index')->withDanger('Data not found!');
                }
            }
            return redirect()->route('roles.index')->withSuccess('Data deleted!');
        } catch (GeneralException $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong!');
        }
    }
}
