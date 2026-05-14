<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_active' => 'boolean'
        ]);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename = 'banner_' . time() . '_' . uniqid() . '.' . $extension;
        $file->move(public_path('banners'), $filename);
        $path = 'banners/' . $filename;

        Banner::create([
            'image_path' => $path,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_active' => 'boolean'
        ]);

        $data = [
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = 'banner_' . time() . '_' . uniqid() . '.' . $extension;
            $file->move(public_path('banners'), $filename);
            
            // Delete old file
            if (file_exists(public_path($banner->image_path))) {
                unlink(public_path($banner->image_path));
            }
            
            $data['image_path'] = 'banners/' . $filename;
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        if (file_exists(public_path($banner->image_path))) {
            unlink(public_path($banner->image_path));
        }
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
