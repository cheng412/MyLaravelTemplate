<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository
{
    public function listAll()
    {
        return Permission::all();
    }
}