<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;


class JobListingController extends Controller
{
    /**
     * Display a listing of the job listings.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $jobs = JobListing::all();
        // dump($jobs);
        return view('view_posting', compact('jobs'));
    }

    /**
     * Display a single job listing.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $job = JobListing::with('company')->where('id', $id)->firstOrFail();
    
        return view('job_detail', compact('job'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $classification = $request->classification;
        $location = $request->location;

        $jobs = JobListing::with('company')
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_pekerjaan', 'like', "%$keyword%")
                ->orWhere('deskripsi_kualifikasi', 'like', "%$keyword%");
            });
        })
        ->when($classification, function ($query) use ($classification) {
            $query->where('jenis_pekerjaan', 'like', "%$classification%");
        })
        ->when($location, function ($query) use ($location) {
            $query->where('lokasi', 'like', "%$location%");
        })
        ->get();

        return view('landing_page', compact('jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'job_address' => 'required',
            'nama_pekerjaan' => 'required',
            'jobType' => 'required',
            'pengalaman_minimal' => 'required',
            'pendidikan_minimal' => 'required',
            'gaji' => 'required',
            'deskripsi_kualifikasi' => 'required',
        ]);

        $companyId = Auth::user()->company->id;

        JobListing::create([
            'company_id' => $companyId,
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'jenis_pekerjaan' => $request->jobType,
            'pengalaman_minimal' => $request->pengalaman_minimal,
            'pendidikan_minimal' => $request->pendidikan_minimal,
            'lokasi' => $request->job_address,
            'gaji' => $request->gaji,
            'deskripsi_kualifikasi' => $request->deskripsi_kualifikasi,
        ]);

        return redirect()->route('job.list')->with('success', 'Job posted successfully');
    }

    public function create()
    {
        return view('formpostingjob');
    }

}
