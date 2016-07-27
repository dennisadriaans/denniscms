<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('cms.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        return Redirect()->route('home')->with('info', 'Your account has been created. And you can now sign in.');
    }

    public function getSignin()
    {
        if (Auth::user()) {
            return redirect()->to('admin');
        }
        return view('cms.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
            return redirect()->back()->with('info', 'Could not sign you in with those details');
        }
        return redirect()->to('/admin')->with('info', 'You are now signed in.');
    }

    public function getSignout()
    {
        Auth::logout();

        return Redirect()->route('cms.signin');
    }
}