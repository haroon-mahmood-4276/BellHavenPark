<?php

namespace App\Services\Roles;

use App\Models\Role;
use App\Services\Roles\RoleInterface;
use Illuminate\Support\Facades\DB;

class RoleService implements RoleInterface
{
    private function model()
    {
        return new Role();
    }

    public function getAll($ignore = null, $with_tree = false)
    {
        $roles = $this->model();
        if (is_array($ignore)) {
            $roles = $roles->whereNotIn('id', $ignore);
        } else if (is_string($ignore)) {
            $roles = $roles->where('id', '!=', $ignore);
        }
        $roles = $roles->get();
        if ($with_tree) {
            return getTreeData(collect($roles), $this->model());
        }
        return $roles;
    }

    public function getById($id)
    {
        return $this->model()->find($id);
    }

    public function store($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {
            $data = [
                'name' => $inputs['name'],
                'guard_name' => $inputs['guard_name'],
                'parent_id' => $inputs['parent_id'],
            ];

            $role = $this->model()->create($data);
            return $role;
        });

        return $returnData;
    }

    public function update($id, $inputs)
    {
        $returnData = DB::transaction(function () use ($id, $inputs) {
            $data = [
                'name' => $inputs['name'],
                'guard_name' => $inputs['guard_name'],
                'parent_id' => $inputs['parent_id'],
            ];

            $role = $this->model()->find($id)->update($data);
            return $role;
        });

        return $returnData;
    }

    public function destroy($inputs)
    {
        $returnData = DB::transaction(function () use ($inputs) {

            $roles = $this->model()->whereIn('id', $inputs)->get()->each(function ($role) {
                $role->delete();
            });

            return $roles;
        });

        return $returnData;
    }
}
