<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function isActive()
    {
        return $this->active === true;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'group_permissions');
    }
}
