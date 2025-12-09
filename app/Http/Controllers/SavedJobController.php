<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedJob;
use App\Models\JobListing;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		$saved = $user ? $user->savedJobs()->with('jobListing')->get() : collect();

		return view('saved_jobs_list', ['saved' => $saved]);
	}

	public function save($id)
	{
		$user = Auth::user();
		if (!$user) return redirect()->route('seeker.login');

		// Check if job already saved
		$exists = SavedJob::where('user_id', $user->id)
			->where('job_id', $id)
			->exists();

		if ($exists) {
			// Remove if already saved (toggle)
			SavedJob::where('user_id', $user->id)
				->where('job_id', $id)
				->delete();
			return redirect()->route('saved.index')->with('success', 'Job removed from saved list');
		} else {
			// Add if not saved
			SavedJob::create([
				'user_id' => $user->id,
				'job_id' => $id,
			]);
			return redirect()->route('saved.index')->with('success', 'Job saved successfully');
		}
	}

	public function remove($id)
	{
		$user = Auth::user();
		if (!$user) return redirect()->route('seeker.login');

		SavedJob::where('user_id', $user->id)
			->where('job_id', $id)
			->delete();

		return back()->with('success', 'Saved job removed');
	}
}
