<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = \App\Models\JobApplication::with(['user', 'jobListing'])->latest()->paginate(10);
        return view('admin.jobs.applications.index', compact('applications'));
    }

    public function show(\App\Models\JobApplication $jobApplication)
    {
        $jobApplication->load(['user', 'jobListing']);
        return view('admin.jobs.applications.show', compact('jobApplication'));
    }

    public function destroy(\App\Models\JobApplication $jobApplication)
    {
        if ($jobApplication->resume_path && file_exists(public_path($jobApplication->resume_path))) {
            unlink(public_path($jobApplication->resume_path));
        }
        $jobApplication->delete();
        return redirect()->route('admin.job-applications.index')->with('success', 'Application deleted successfully.');
    }

    public function updateStatus(Request $request, \App\Models\JobApplication $jobApplication)
    {
        $request->validate(['status' => 'required|in:pending,reviewed,accepted,rejected']);
        $jobApplication->update(['status' => $request->status]);
        return back()->with('success', 'Application status updated.');
    }
}
