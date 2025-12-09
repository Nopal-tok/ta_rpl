<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditProfileController extends Controller
{
    // ==== EDIT PROFILE SEEKER ====
    public function editSeeker()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('edit_profile_seeker', compact('profile'));
    }

    public function updateSeeker(Request $request)
    {
        $request->validate([
            'nama' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string',
            'pendidikan_terakhir' => 'nullable|string',
            'pengalaman_kerja' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'cv' => 'nullable|mimes:pdf|max:10000'
        ]);

        $profile = Profile::where('user_id', Auth::id())->first();

        // UPDATE FIELD YANG DIISI SAJA
        if ($request->filled('nama')) $profile->nama = $request->nama;
        if ($request->filled('tanggal_lahir')) $profile->tanggal_lahir = $request->tanggal_lahir;
        if ($request->filled('jenis_kelamin')) $profile->jenis_kelamin = $request->jenis_kelamin;
        if ($request->filled('pendidikan_terakhir')) $profile->pendidikan_terakhir = $request->pendidikan_terakhir;
        if ($request->filled('pengalaman_kerja')) $profile->pengalaman_kerja = $request->pengalaman_kerja;
        if ($request->filled('whatsapp')) $profile->whatsapp = $request->whatsapp;

        // === GANTI CV JIKA ADA FILE BARU ===
        if ($request->hasFile('cv')) {

            // Hapus CV lama
            if ($profile->cv_path && Storage::disk('public')->exists($profile->cv_path)) {
                Storage::disk('public')->delete($profile->cv_path);
            }

            // Upload CV baru
            $file = $request->file('cv');
            $path = $file->store('cv', 'public');

            // Simpan ke DB
            $profile->cv_path = $path;
            $profile->cv_name = $file->getClientOriginalName();
        }

        $profile->save();

        return redirect('/profile_seeker')->with('success', 'Profile updated!');
    }

    // ==== EDIT PROFILE EMPLOYER ====
    public function editEmployer()
    {
        $company = Company::where('user_id', Auth::id())->first();
        return view('edit_profile_employer', compact('company'));
    }

    public function updateEmployer(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'nullable|string',
            'email_perusahaan' => 'nullable|email',
            'negara' => 'nullable|string',
            'alamat_perusahaan' => 'nullable|string',
            'nomor_telepon' => 'nullable|string',
            'about' => 'nullable|string',
        ]);

        $company = Company::where('user_id', Auth::id())->first();

        // UPDATE HANYA FIELD YANG DIISI SAJA
        if ($request->filled('nama_perusahaan')) {
            $company->nama_perusahaan = $request->nama_perusahaan;
        }

        if ($request->filled('email_perusahaan')) {
            $company->email_perusahaan = $request->email_perusahaan;
        }

        if ($request->filled('negara')) {
            $company->negara = $request->negara;
        }

        if ($request->filled('alamat_perusahaan')) {
            $company->alamat_perusahaan = $request->alamat_perusahaan;
        }

        if ($request->filled('nomor_telepon')) {
            $company->nomor_telepon = $request->nomor_telepon;
        }

        if ($request->filled('about')) {
            $company->about = $request->about;
        }

        // SAVE
        $company->save();

        return redirect('/profile_employer')->with('success', 'Company profile updated!');
    }

}
