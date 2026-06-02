<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        $data = $request->except(['thumbnail', 'banner', 'magazine_ids', 'gallery']);
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        $data['author'] = $request->author ?: auth()->user()->name;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_thumb_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('events/thumbnails'), $filename);
            $data['thumbnail'] = 'events/thumbnails/' . $filename;
        }

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $filename = time() . '_banner_' . uniqid() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('events/banners'), $filename);
            $data['banner'] = 'events/banners/' . $filename;
        }

        $event = Event::create($data);

        if ($request->hasFile('gallery')) {
            $galleryFiles = $request->file('gallery');
            $flatGallery = [];
            foreach ($galleryFiles as $item) {
                if (is_array($item)) {
                    foreach ($item as $subItem) {
                        if ($subItem instanceof \Illuminate\Http\UploadedFile) {
                            $flatGallery[] = $subItem;
                        }
                    }
                } else if ($item instanceof \Illuminate\Http\UploadedFile) {
                    $flatGallery[] = $item;
                }
            }

            foreach ($flatGallery as $image) {
                $filename = time() . '_gallery_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('events/gallery'), $filename);
                $event->images()->create(['image_path' => 'events/gallery/' . $filename]);
            }
        }

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

        $data = $request->except(['thumbnail', 'banner', 'magazine_ids', 'gallery']);
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($event->thumbnail && file_exists(public_path($event->thumbnail))) {
                @unlink(public_path($event->thumbnail));
            }
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_thumb_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('events/thumbnails'), $filename);
            $data['thumbnail'] = 'events/thumbnails/' . $filename;
        }

        if ($request->hasFile('banner')) {
            if ($event->banner && file_exists(public_path($event->banner))) {
                @unlink(public_path($event->banner));
            }
            $banner = $request->file('banner');
            $filename = time() . '_banner_' . uniqid() . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('events/banners'), $filename);
            $data['banner'] = 'events/banners/' . $filename;
        }

        $event->update($data);

        if ($request->hasFile('gallery')) {
            $galleryFiles = $request->file('gallery');
            $flatGallery = [];
            foreach ($galleryFiles as $item) {
                if (is_array($item)) {
                    foreach ($item as $subItem) {
                        if ($subItem instanceof \Illuminate\Http\UploadedFile) {
                            $flatGallery[] = $subItem;
                        }
                    }
                } else if ($item instanceof \Illuminate\Http\UploadedFile) {
                    $flatGallery[] = $item;
                }
            }

            foreach ($flatGallery as $image) {
                $filename = time() . '_gallery_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('events/gallery'), $filename);
                $event->images()->create(['image_path' => 'events/gallery/' . $filename]);
            }
        }

        if ($request->has('magazine_ids')) {
            $event->relatedMagazines()->sync($request->magazine_ids);
        } else {
            $event->relatedMagazines()->detach();
        }

        if ($request->has('show_in_gallery')) {
            $showIds = array_keys($request->show_in_gallery);
            $event->images()->whereIn('id', $showIds)->update(['show_in_gallery' => true]);
            $event->images()->whereNotIn('id', $showIds)->update(['show_in_gallery' => false]);
        } else {
            $event->images()->update(['show_in_gallery' => false]);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->thumbnail && file_exists(public_path($event->thumbnail))) {
            @unlink(public_path($event->thumbnail));
        }
        if ($event->banner && file_exists(public_path($event->banner))) {
            @unlink(public_path($event->banner));
        }
        foreach ($event->images as $image) {
            if (file_exists(public_path($image->image_path))) {
                @unlink(public_path($image->image_path));
            }
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    public function deleteImage(\App\Models\EventImage $image)
    {
        if (file_exists(public_path($image->image_path))) {
            @unlink(public_path($image->image_path));
        }
        $image->delete();
        return response()->json(['success' => true]);
    }
}
