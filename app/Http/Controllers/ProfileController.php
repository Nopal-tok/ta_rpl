<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    // Untuk pelamar
    public function seekerProfile()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        return view('profile_seeker', compact('user', 'profile'));
    }

    // Untuk perusahaan
    public function employerProfile()
    {
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();

        return view('profile_employer', compact('user', 'company'));
    }

    // Upload CV
    public function uploadCV(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:10240',
        ]);

        $profile = auth()->user()->profile;

        // Upload file
        $file = $request->file('cv');
        $path = $file->store('cv', 'public');

        // Simpan data
        $profile->cv_path = $path;
        $profile->cv_name = $file->getClientOriginalName();
        $profile->save();

        return back()->with('success', 'CV uploaded successfully!');
    }

    public function showSeeker()
    {
        $user = auth()->user();     // User yang login
        $profile = Profile::where('user_id', $user->id)->first();

        return view('profile_seeker', compact('user', 'profile'));
    }

    //Foto Profil
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = auth()->user();
        $profile = $user->profile;

        // Simpan file
        $path = $request->file('foto')->store('profile_photos', 'public');

        // Update DB
        $profile->foto = $path;
        $profile->save();

        return back()->with('success', 'Foto profil berhasil diupdate!');
    }

    //Foto Logo
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $company = auth()->user()->company;

        $file = $request->file('logo');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/company'), $fileName);

        $company->logo = $fileName;
        $company->save();

        return back()->with('success', 'Logo updated successfully');
    }

    //Ganti Passsword
    public function changePasswordPage()
    {
        return view('change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    /**
     * Public company contact page.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function companyContact($id)
    {
        $company = Company::findOrFail($id);

        return view('company_contact', compact('company'));
    }


}
