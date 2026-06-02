<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertisementNormal;
use App\Models\AdvertisementType;
use Illuminate\Http\Request;

class AdvertisementNormalController extends Controller
{
    public function index()
    {
        $ads = AdvertisementNormal::with('type')->latest()->paginate(10);
        return view('admin.advertisement_normals.index', compact('ads'));
    }

    public function create()
    {
        $types = AdvertisementType::orderBy('name')->get();
        return view('admin.advertisement_normals.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'advertisement_type_id' => 'required|exists:advertisement_types,id',
            'link' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/advertisements/normal'), $filename);
            $data['image_path'] = 'storage/advertisements/normal/' . $filename;
        }

        AdvertisementNormal::create($data);

        return redirect()->route('admin.advertisement-normals.index')->with('success', 'Normal advertisement added successfully.');
    }

    public function edit(AdvertisementNormal $advertisement_normal)
    {
        $types = AdvertisementType::orderBy('name')->get();
        return view('admin.advertisement_normals.edit', compact('advertisement_normal', 'types'));
    }

    public function update(Request $request, AdvertisementNormal $advertisement_normal)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'advertisement_type_id' => 'required|exists:advertisement_types,id',
            'link' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($advertisement_normal->image_path && file_exists(public_path($advertisement_normal->image_path))) {
                @unlink(public_path($advertisement_normal->image_path));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/advertisements/normal'), $filename);
            $data['image_path'] = 'storage/advertisements/normal/' . $filename;
        }

        $advertisement_normal->update($data);

        return redirect()->route('admin.advertisement-normals.index')->with('success', 'Normal advertisement updated successfully.');
    }

    public function destroy(AdvertisementNormal $advertisement_normal)
    {
        if ($advertisement_normal->image_path && file_exists(public_path($advertisement_normal->image_path))) {
            @unlink(public_path($advertisement_normal->image_path));
        }
        
        $advertisement_normal->delete();

        return redirect()->route('admin.advertisement-normals.index')->with('success', 'Normal advertisement deleted successfully.');
    }

    public function storeType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:advertisement_types,name'
        ]);

        $type = AdvertisementType::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'type' => $type
        ]);
    }
}
