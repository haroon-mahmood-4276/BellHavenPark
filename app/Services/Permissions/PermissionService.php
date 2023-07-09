<?php

namespace App\Services\Admin\Permissions;

use App\Services\Admin\Permissions\PermissionInterface;
use Spatie\Permission\Models\Permission;

class PermissionService implements PermissionInterface
{

    private function model()
    {
        return new Permission();
    }

    // Get
    public function getByAll()
    {
        return $this->model()->all();
    }

    public function getById($id)
    {
        return $this->model()->find($id);
    }

    // Store
    public function store($inputs)
    {
        $data = [
            'name' => $inputs['permission_name'],
            'guard_name' => $inputs['guard_name'],
        ];
        $permission = $this->model()->create($data);
        return $permission;
    }

    public function update($id, $inputs)
    {
        $data = [
            'name' => $inputs['permission_name'],
            'guard_name' => $inputs['guard_name'],
        ];
        $type = $this->model()->where('id', $id)->update($data);
        return $type;
    }

    public function destroySelected($ids)
    {
        if (!empty($ids)) {
            $this->model()->whereIn('id', $ids)->delete();
            return true;
        }
        return false;
    }
}
