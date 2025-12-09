<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ============================
    // REGISTER PELAMAR
    // ============================
    public function registerSeeker(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'email' => $request->email,
            'role' => 'pelamar',
            'password' => Hash::make($request->password),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'email' => $request->email,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('seeker.login');
    }

    // ============================
    // REGISTER PERUSAHAAN
    // ============================
    public function registerCompany(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'email' => $request->email,
            'role' => 'perusahaan',
            'password' => Hash::make($request->password),
        ]);

        Company::create([
            'user_id' => $user->id,
            'email_perusahaan' => $request->email,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('employer.login');
    }

    // ============================
    // LOGIN PELAMAR
    // ============================
    public function loginSeeker(Request $request)
    {
        $request->validate([
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $request->email)
                    ->where('role', 'pelamar')
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah atau bukan akun pelamar.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('seeker.profile');
    }

    // ============================
    // LOGIN PERUSAHAAN
    // ============================
    public function loginCompany(Request $request)
    {
        $request->validate([
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', $request->email)
                    ->where('role', 'perusahaan')
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah atau bukan akun perusahaan.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('employer.profile');
    }
}

