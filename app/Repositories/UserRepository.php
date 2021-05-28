<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\FileUpload\UserAvatar;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    const FILE_DISK = 'public';

    public function list($request, $paginate = false)
    {
        $query = User::query()
            ->orderByDesc('id');

        if ($request->search)
        {
            $search = '%'.$request->search.'%';
            $query->where('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search)
                ->orWhere('email', 'like', $search);
        }

        if ($request->status)
            $query->where('status', $request->status);

        if ($paginate)
            return $query->paginate(10)->appends(Request::except('page'));

        return $query->get();
    }

    public function create($request)
    {
        $user = User::create($request->validated());
        
        if ($request->hasGroupIds())
            $user->groups()->sync($request->group_ids);

        if ($request->file('avatar'))
            $this->uploadAvatar($request->file('avatar'), $user);

        return $user;
    }

    public function update($request, User $user)
    {
        $user->update(array_filter($request->validated()));

        if ($request->hasGroupIds())
            $user->groups()->sync($request->group_ids);
        
        if ($request->file('avatar'))
            $this->uploadAvatar($request->file('avatar'), $user);

        return $user;
    }

    public function uploadAvatar($file, User $user)
    {
        return (new UserAvatar($file, $user))->upload();
    }

    public function changePassword($password, User $user)
    {
        $user->update(['password' => bcrypt($password)]);

        return $user;
    }

    public function delete(User $user)
    {
        if ($user->avatar)
            Storage::disk(self::FILE_DISK)->delete($user->avatar);
            
        $user->groups()->detach();
        $user->delete();
    }
}