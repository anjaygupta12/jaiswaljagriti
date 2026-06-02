<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/galleries'), $filename);
            $data['image_path'] = 'storage/galleries/' . $filename;
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery image added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($gallery->image_path && file_exists(public_path($gallery->image_path))) {
                unlink(public_path($gallery->image_path));
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/galleries'), $filename);
            $data['image_path'] = 'storage/galleries/' . $filename;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path && file_exists(public_path($gallery->image_path))) {
            unlink(public_path($gallery->image_path));
        }
        
        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery image deleted successfully.');
    }
}
