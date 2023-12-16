<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Exceptions\GeneralException;
use App\Services\Users\UserInterface;
use App\Http\Requests\Users\{
    storeRequest,
    updateRequest,
};
use Exception;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    private $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index(UsersDataTable $dataTable)
    {
        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('users.index');
    }
    
    public function create()
    {
        abort_if(request()->ajax(), 403);

        $data = [
            'roles' => $this->userInterface->getAll(with_tree: true),
        ];
        return view('roles.create', $data);
    }
    
    public function store(roleStoreRequest $request)
    {
        abort_if(request()->ajax(), 403);

        try {
            $inputs = $request->validated();
            $record = $this->userInterface->store($inputs);
            return redirect()->route('roles.index')->withSuccess('Data saved!');
        } catch (GeneralException $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('roles.index')->withDanger('Something went wrong!');
        }
    }
    
    public function show($id)
    {
        abort(403);
    }
    
    public function edit($id)
    {
        abort_if(request()->ajax(), 403);

        try {
            $role = (new Role())->find($id);

            if ($role && !empty($role)) {
                $data = [
                    'role' => $role,
                    'roles' => $this->userInterface->getAll(ignore: $role->id, with_tree: true),
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
    
    public function update(roleUpdateRequest $request, $id)
    {
        abort_if(request()->ajax(), 403);
        try {

            $id = $id;

            $inputs = $request->validated();

            $record = $this->userInterface->update($id, $inputs);

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

                $record = $this->userInterface->destroy($request->checkForDelete);

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
