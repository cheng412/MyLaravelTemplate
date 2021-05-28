<?php

namespace App\Repositories;

use App\Models\Group;
use Illuminate\Support\Facades\Request;

class GroupRepository
{
    public function list($request, $paginate = false)
    {
        $query = Group::query()
            ->withCount('users')
            ->orderBy('name');

        if ($request->search)
            $query->where('name', 'like', '%'.$request->search.'%');

        if ($request->has('active'))
            $query->where('active', $request->active);

        if ($paginate)
            return $query->paginate(10)->appends(Request::except('page'));

        return $query->get();
    }

    public function create($request)
    {
        $group = Group::create($request->validated());

        $this->syncPermissionAndUser($request, $group);

        return $group;
    }

    public function update($request, Group $group)
    {
        $group->update($request->validated());

        $this->syncPermissionAndUser($request, $group);

        return $group;
    }

    public function delete(Group $group)
    {
        $group->permissions()->detach();
        $group->users()->detach();

        $group->delete();
    }

    private function syncPermissionAndUser($request, Group $group)
    {
        if ($request->permission_ids && count($request->permission_ids))
            $group->permissions()->sync($request->permission_ids);

        if ($request->user_ids && count($request->user_ids))
            $group->users()->sync($request->user_ids);
    }
}