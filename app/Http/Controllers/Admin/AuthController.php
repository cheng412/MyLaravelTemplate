<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\ChangePasswordRequest;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\UpdateProfileRequest;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers, ThrottlesLogins;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginPage(Request $request)
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) 
        {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request, $request->filled('remember_me'))) 
        {
            $this->clearLoginAttempts($request);
            
            return redirect()->route('dashboard');
        }

        $this->incrementLoginAttempts($request);
        
        return back()->with('error', 'Username or password is invalid.')->withInput();
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Successfully logout.');
    }

    public function username()
    {
        return 'email';
    }

    public function profile()
    {
        return view('auth.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->userRepository->update($request, auth()->user());

        return redirect()->route('profile')->with('success', 'Successfully updated profile.');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->userRepository->changePassword($request->password, auth()->user());

        return redirect()->route('profile')->with('success', 'Successfully changed password.');
    }
}
