<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function show($token)
    {
        return view('reset_password', [
            'token' => $token,
            'email' => request()->query('email')
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('seeker.login')->with('success', 'Password berhasil direset!')
            : back()->withErrors(['email' => __($status)]);
    }
}
