<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        try {
            return view('admin.pages.dashboard.login');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function postLogin(LoginRequest $request)
    {
        try {
            if (Auth::attempt($request->except('_token'))) {
                return redirect()->route('dashboard');
            } else {
                return back()->withErrors(['err' => 'بيانات تسجيل الدخول خاطئة']);
            };
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function logout()
    {
        try {
            Auth::logout();
            return redirect()->route('login');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function profile()
    {
        try {
            $user = User::query()->findOrFail(auth()->user()->id);
            return view('admin.pages.dashboard.profile', compact('user'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function editProfile(ProfileRequest $request)
    {
        try {
            $user = User::query()->findOrFail(auth()->user()->id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            return back()->with('success', 'تم تحديث البيانات بنجاح!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
