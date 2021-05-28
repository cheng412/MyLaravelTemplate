<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'email_verified_at', 'password',
        'avatar', 'device_os', 'device_token', 'status'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'fullname', 'avatar_url'
    ];

    const FILE_DISK = 'public';

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_UNVERIFY = 'unverified';

    const STATUSES = [
        self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_UNVERIFY
    ];

    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getFullnameAttribute()
    {
        return ucfirst($this->first_name.' '.$this->last_name);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? Storage::disk(self::FILE_DISK)->url($this->avatar) : 'http://127.0.0.1:8000/assets/images/users/1.jpg';
    }

    public function hasGroup($groupIds)
    {
        return $this->groups()->whereIn('group_id', $groupIds)->count();
    }

    public function isOldPassword($oldPassword)
    {
        return Hash::check($oldPassword, $this->password);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_users');
    }

    public function facebookAccessTokens()
    {
        return $this->hasMany(FacebookAccessToken::class);
    }
}
