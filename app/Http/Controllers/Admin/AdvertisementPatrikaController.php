<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertisementPatrika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementPatrikaController extends Controller
{
    protected $types = [
        'first_front' => 'First front',
        'first_front_back' => 'First front back',
        'last_page' => 'Last page',
        'last_page_second' => 'Last page second'
    ];

    public function index()
    {
        $ads = AdvertisementPatrika::latest()->paginate(10);
        return view('admin.advertisement_patrikas.index', compact('ads'));
    }

    public function create()
    {
        $types = $this->types;
        return view('admin.advertisement_patrikas.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'type' => 'required|string|in:' . implode(',', array_keys($this->types)),
            'link' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/advertisements/patrika'), $filename);
            $data['image_path'] = 'storage/advertisements/patrika/' . $filename;
        }

        AdvertisementPatrika::create($data);

        return redirect()->route('admin.advertisement-patrikas.index')->with('success', 'Patrika advertisement added successfully.');
    }

    public function edit(AdvertisementPatrika $advertisement_patrika)
    {
        $types = $this->types;
        return view('admin.advertisement_patrikas.edit', compact('advertisement_patrika', 'types'));
    }

    public function update(Request $request, AdvertisementPatrika $advertisement_patrika)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'type' => 'required|string|in:' . implode(',', array_keys($this->types)),
            'link' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($advertisement_patrika->image_path && file_exists(public_path($advertisement_patrika->image_path))) {
                @unlink(public_path($advertisement_patrika->image_path));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/advertisements/patrika'), $filename);
            $data['image_path'] = 'storage/advertisements/patrika/' . $filename;
        }

        $advertisement_patrika->update($data);

        return redirect()->route('admin.advertisement-patrikas.index')->with('success', 'Patrika advertisement updated successfully.');
    }

    public function destroy(AdvertisementPatrika $advertisement_patrika)
    {
        if ($advertisement_patrika->image_path && file_exists(public_path($advertisement_patrika->image_path))) {
            @unlink(public_path($advertisement_patrika->image_path));
        }
        
        $advertisement_patrika->delete();

        return redirect()->route('admin.advertisement-patrikas.index')->with('success', 'Patrika advertisement deleted successfully.');
    }
}
