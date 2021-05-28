<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\StoreRequest;
use App\Http\Requests\Admin\Group\UpdateRequest;
use App\Models\Group;
use App\Repositories\GroupRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $permissionRepository;
    protected $userRepository;

    public function __construct(GroupRepository $groupRepository, PermissionRepository $permissionRepository, UserRepository $userRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->permissionRepository = $permissionRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $groups = $this->groupRepository->list($request, true);

        return view('groups.index', ['groups' => $groups]);
    }

    public function create(Request $request)
    {
        $users = $this->userRepository->list($request);
        $permissions = $this->permissionRepository->listAll();

        return view('groups.create', ['users' => $users, 'permissions' => $permissions]);
    }

    public function store(StoreRequest $request)
    {
        $group = $this->groupRepository->create($request);

        return redirect()->route('groups')->with('success', 'Successfully created group.');
    }

    public function edit(Request $request, Group $group)
    {
        $group->load('users', 'permissions');
        $users = $this->userRepository->list($request);
        $permissions = $this->permissionRepository->listAll();

        $checkedPermissionIds = $group->permissions->pluck('id')->toArray();
        $checkedUserIds = $group->users->pluck('id')->toArray();

        return view('groups.edit', [
            'users' => $users,
            'permissions' => $permissions,
            'group' => $group,
            'checkedPermissionIds' => $checkedPermissionIds,
            'checkedUserIds' => $checkedUserIds
        ]);
    }

    public function update(UpdateRequest $request, Group $group)
    {
        $group = $this->groupRepository->update($request, $group);

        return redirect()->route('groups')->with('success', 'Successfully updated group.');
    }

    public function delete(Group $group)
    {
        $this->groupRepository->delete($group);

        return redirect()->route('groups')->with('success', 'Successfully deleted group.');
    }
}
