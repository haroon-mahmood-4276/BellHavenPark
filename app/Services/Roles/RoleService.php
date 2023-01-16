<?php

namespace App\Services\Admin\Roles;

use App\Models\Role;
use App\Services\Admin\Roles\RoleInterface;

class RoleService implements RoleInterface
{
    private function model()
    {
        return new Role();
    }

    public function getAllWithTree()
    {
        $roles = $this->model()->all();
        return getTreeData(collect($roles), $this->model());
    }
}
