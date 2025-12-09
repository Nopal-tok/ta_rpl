<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Menampilkan halaman forgot password
    public function show()
    {
        return view('forgot_password');
    }

    // Mengirim email reset password
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Reset link sent to your email!')
            : back()->withErrors(['email' => __($status)]);
    }
}
