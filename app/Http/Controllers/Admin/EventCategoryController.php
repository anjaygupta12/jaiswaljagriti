<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventCategoryController extends Controller
{
    public function index()
    {
        $categories = EventCategory::withCount('events')->latest()->get();
        return view('admin.events.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.events.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:event_categories,name',
        ]);

        EventCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.event-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(EventCategory $eventCategory)
    {
        return view('admin.events.categories.edit', compact('eventCategory'));
    }

    public function update(Request $request, EventCategory $eventCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:event_categories,name,' . $eventCategory->id,
        ]);

        $eventCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.event-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(EventCategory $eventCategory)
    {
        $eventCategory->delete();
        return redirect()->route('admin.event-categories.index')->with('success', 'Category deleted successfully.');
    }
}
