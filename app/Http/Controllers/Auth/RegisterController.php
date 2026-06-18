<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|max:255',
        'last_name'  => 'required|max:255',
        'email'      => 'required|email|unique:users,email',
        'password'   => 'required|min:6',
    ]);

    $user = User::create([
        'name' => trim($request->first_name . ' ' . $request->last_name),
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('verification.notice')->with('success', 'Đã gửi email xác thực, vui lòng kiểm tra hộp thư.');
}
}