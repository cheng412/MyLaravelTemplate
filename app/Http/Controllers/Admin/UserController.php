<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\ChangePasswordRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $groupRepository;
    protected $userRepository;

    public function __construct(GroupRepository $groupRepository, UserRepository $userRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->list($request, true);

        return view('users.index', ['users' => $users]);
    }

    public function create(Request $request)
    {
        $groups = $this->groupRepository->list($request);

        return view('users.create', ['groups' => $groups]);
    }

    public function store(StoreRequest $request)
    {
        $user = $this->userRepository->create($request);

        return redirect()->route('users')->with('success', 'Successfully created user.');
    }

    public function edit(Request $request, User $user)
    {
        $groups = $this->groupRepository->list($request);

        return view('users.edit', ['groups' => $groups, 'user' => $user]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user = $this->userRepository->update($request, $user);

        return redirect()->route('users')->with('success', 'Successfully updated user.');
    }

    public function delete(User $user)
    {
        $this->userRepository->delete($user);

        return redirect()->route('users')->with('success', 'Successfully deleted user.');
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        $this->userRepository->changePassword($request->password, $user);

        return redirect()->route('users')->with('success', 'Successfully changed password.');
    }
}
