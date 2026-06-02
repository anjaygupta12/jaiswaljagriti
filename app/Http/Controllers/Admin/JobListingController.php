<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = JobListing::with('category')->latest()->get();
        return view('admin.jobs.listings.index', compact('jobs'));
    }

    public function create()
    {
        $categories = JobCategory::where('status', true)->get();
        return view('admin.jobs.listings.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_category_id' => 'required|exists:job_categories,id',
            'title' => 'required|string|max:255',
            'link_type' => 'required|in:external,internal',
            'link' => 'nullable|required_if:link_type,external|url|max:255',
            'description' => 'nullable|required_if:link_type,internal|string',
        ]);

        JobListing::create([
            'job_category_id' => $request->job_category_id,
            'title' => $request->title,
            'link_type' => $request->link_type,
            'link' => $request->link_type === 'external' ? $request->link : null,
            'description' => $request->link_type === 'internal' ? $request->description : null,
            'show_apply' => $request->link_type === 'internal' && $request->has('show_apply'),
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.job-listings.index')->with('success', 'Job listing created successfully.');
    }

    public function edit(JobListing $jobListing)
    {
        $categories = JobCategory::where('status', true)->get();
        return view('admin.jobs.listings.edit', compact('jobListing', 'categories'));
    }

    public function update(Request $request, JobListing $jobListing)
    {
        $request->validate([
            'job_category_id' => 'required|exists:job_categories,id',
            'title' => 'required|string|max:255',
            'link_type' => 'required|in:external,internal',
            'link' => 'nullable|required_if:link_type,external|url|max:255',
            'description' => 'nullable|required_if:link_type,internal|string',
        ]);

        $jobListing->update([
            'job_category_id' => $request->job_category_id,
            'title' => $request->title,
            'link_type' => $request->link_type,
            'link' => $request->link_type === 'external' ? $request->link : null,
            'description' => $request->link_type === 'internal' ? $request->description : null,
            'show_apply' => $request->link_type === 'internal' && $request->has('show_apply'),
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.job-listings.index')->with('success', 'Job listing updated successfully.');
    }

    public function destroy(JobListing $jobListing)
    {
        $jobListing->delete();
        return redirect()->route('admin.job-listings.index')->with('success', 'Job listing deleted successfully.');
    }
}
