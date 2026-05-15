<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobCategoryController extends Controller
{
    public function index()
    {
        $categories = JobCategory::withCount('listings')->latest()->get();
        return view('admin.jobs.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.jobs.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name',
        ]);

        JobCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status')
        ]);

        return redirect()->route('admin.job-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(JobCategory $jobCategory)
    {
        return view('admin.jobs.categories.edit', compact('jobCategory'));
    }

    public function update(Request $request, JobCategory $jobCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name,' . $jobCategory->id,
        ]);

        $jobCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status')
        ]);

        return redirect()->route('admin.job-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();
        return redirect()->route('admin.job-categories.index')->with('success', 'Category deleted successfully.');
    }
}
