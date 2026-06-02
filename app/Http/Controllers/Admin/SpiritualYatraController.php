<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpiritualYatra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpiritualYatraController extends Controller
{
    public function index()
    {
        $yatras = SpiritualYatra::latest()->get();
        return view('admin.spiritual-yatras.index', compact('yatras'));
    }

    public function create()
    {
        return view('admin.spiritual-yatras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'content'           => 'nullable|string',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = $request->except(['_token', 'thumbnail']);
        $data['slug'] = Str::slug($request->title) . '-' . uniqid();
        $data['status'] = $request->has('status');

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_yatra_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('yatras/thumbnails'), $filename);
            $data['thumbnail'] = 'yatras/thumbnails/' . $filename;
        }

        SpiritualYatra::create($data);

        return redirect()->route('admin.spiritual-yatras.index')->with('success', 'Spiritual Yatra created successfully.');
    }

    public function edit(SpiritualYatra $spiritualYatra)
    {
        return view('admin.spiritual-yatras.edit', compact('spiritualYatra'));
    }

    public function update(Request $request, SpiritualYatra $spiritualYatra)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'content'           => 'nullable|string',
            'thumbnail'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = $request->except(['_token', 'thumbnail']);
        $data['status'] = $request->has('status');
        
        if ($request->title !== $spiritualYatra->title) {
            $data['slug'] = Str::slug($request->title) . '-' . uniqid();
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_yatra_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('yatras/thumbnails'), $filename);
            
            if ($spiritualYatra->thumbnail && file_exists(public_path($spiritualYatra->thumbnail))) {
                @unlink(public_path($spiritualYatra->thumbnail));
            }
            
            $data['thumbnail'] = 'yatras/thumbnails/' . $filename;
        }

        $spiritualYatra->update($data);

        return redirect()->route('admin.spiritual-yatras.index')->with('success', 'Spiritual Yatra updated successfully.');
    }

    public function destroy(SpiritualYatra $spiritualYatra)
    {
        if ($spiritualYatra->thumbnail && file_exists(public_path($spiritualYatra->thumbnail))) {
            @unlink(public_path($spiritualYatra->thumbnail));
        }
        
        $spiritualYatra->delete();

        return redirect()->route('admin.spiritual-yatras.index')->with('success', 'Spiritual Yatra deleted successfully.');
    }
}
