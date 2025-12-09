<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    // Redirect user ke Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback (setelah pilih akun Google)
    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // CARI USER BERDASARKAN EMAIL
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // BUAT USER JIKA BELUM ADA
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'name'  => $googleUser->getName(),
                'role'  => 'pelamar',
                'password' => Hash::make(uniqid()), // random password
            ]);

            // BUAT PROFILE KOSONG NYA
            Profile::create([
                'user_id' => $user->id,
                'nama'    => $googleUser->getName(),
                'email'   => $googleUser->getEmail(),
            ]);
        } else {
            // JIKA PROFILE BELUM ADA → BUAT BARU
            if (!$user->profile) {
                Profile::create([
                    'user_id' => $user->id,
                    'nama'    => $googleUser->getName(),
                    'email'   => $googleUser->getEmail(),
                ]);
            }
        }

        // LOGIN USER
        Auth::login($user);

        return redirect('/profile_seeker');
    }
}
