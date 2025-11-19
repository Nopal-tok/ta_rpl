<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerSeeker(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'email' => $request->email,
            'role' => 'pelamar',
            'password' => Hash::make($request->password),
        ]);

        Profile::create([
            'user_id' => $user->id,
            'nama' => '',
        ]);

        return response()->json([
            'message' => 'Register pelamar berhasil'
        ], 201);
    }

    public function registerCompany(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'email' => $request->email,
            'role' => 'perusahaan',
            'password' => Hash::make($request->password),
        ]);

        Company::create([
            'user_id' => $user->id,
            'nama_perusahaan' => '',
            'alamat_perusahaan' => '',
        ]);

        return response()->json([
            'message' => 'Register perusahaan berhasil'
        ], 201);
    }

    public function loginSeeker(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'pelamar')
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login gagal'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Login pelamar berhasil',
            'token' => $token,
            'role' => $user->role
        ]);
    }

    public function loginCompany(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'perusahaan')
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login gagal'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Login perusahaan berhasil',
            'token' => $token,
            'role' => $user->role
        ]);
    }
}
