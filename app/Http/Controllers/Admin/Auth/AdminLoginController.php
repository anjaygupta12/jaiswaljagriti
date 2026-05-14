<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
        'is_admin' => 1,
    ];

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    return back()->with('error', 'Invalid email or password');
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
