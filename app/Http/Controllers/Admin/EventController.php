<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('eventCategory')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = EventCategory::where('status', true)->get();
        $magazines = Magazine::where('is_active', true)->latest()->get();
        return view('admin.events.create', compact('categories', 'magazines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'content'           => 'required|string',
            'event_date'        => 'required|date',
            'event_category_id' => 'required|exists:event_categories,id',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = $request->except(['thumbnail', 'banner', 'magazine_ids']);
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        $data['author'] = $request->author ?: auth()->user()->name;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/thumbnails'), $filename);
            $data['thumbnail'] = 'uploads/events/thumbnails/' . $filename;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = 'banner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/banners'), $filename);
            $data['banner'] = 'uploads/events/banners/' . $filename;
        }

        $event = Event::create($data);

        if ($request->has('magazine_ids')) {
            $event->relatedMagazines()->sync($request->magazine_ids);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $categories = EventCategory::where('status', true)->get();
        $magazines = Magazine::where('is_active', true)->latest()->get();
        $selectedMagazines = $event->relatedMagazines->pluck('id')->toArray();
        return view('admin.events.edit', compact('event', 'categories', 'magazines', 'selectedMagazines'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'content'           => 'required|string',
            'event_date'        => 'required|date',
            'event_category_id' => 'required|exists:event_categories,id',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = $request->except(['thumbnail', 'banner', 'magazine_ids']);
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($event->thumbnail && file_exists(public_path($event->thumbnail))) {
                unlink(public_path($event->thumbnail));
            }
            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/thumbnails'), $filename);
            $data['thumbnail'] = 'uploads/events/thumbnails/' . $filename;
        }

        if ($request->hasFile('banner')) {
            if ($event->banner && file_exists(public_path($event->banner))) {
                unlink(public_path($event->banner));
            }
            $file = $request->file('banner');
            $filename = 'banner_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/banners'), $filename);
            $data['banner'] = 'uploads/events/banners/' . $filename;
        }

        $event->update($data);

        if ($request->has('magazine_ids')) {
            $event->relatedMagazines()->sync($request->magazine_ids);
        } else {
            $event->relatedMagazines()->detach();
        }

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->thumbnail && file_exists(public_path($event->thumbnail))) {
            unlink(public_path($event->thumbnail));
        }
        if ($event->banner && file_exists(public_path($event->banner))) {
            unlink(public_path($event->banner));
        }
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
