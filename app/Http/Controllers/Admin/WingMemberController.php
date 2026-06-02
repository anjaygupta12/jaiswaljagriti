<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WingMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WingMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WingMember::query();

        if ($request->has('type') && in_array($request->type, ['executive-body', 'youth-wing', 'womens-wing'])) {
            $query->where('type', $request->type);
        }

        $members = $query->orderBy('type')->orderBy('sort_order')->get();

        return view('admin.wing-members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wing-members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:executive-body,youth-wing,womens-wing',
            'sort_order' => 'required|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Ensure directory exists
            if (!File::exists(public_path('wings'))) {
                File::makeDirectory(public_path('wings'), 0755, true);
            }
            
            $file->move(public_path('wings'), $filename);
            $data['image'] = 'wings/' . $filename;
        }

        WingMember::create($data);

        return redirect()->route('admin.wing-members.index')->with('success', 'Wing member added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WingMember $wingMember)
    {
        return view('admin.wing-members.edit', compact('wingMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WingMember $wingMember)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:executive-body,youth-wing,womens-wing',
            'sort_order' => 'required|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->except('image');
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($wingMember->image && File::exists(public_path($wingMember->image))) {
                File::delete(public_path($wingMember->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            if (!File::exists(public_path('wings'))) {
                File::makeDirectory(public_path('wings'), 0755, true);
            }
            
            $file->move(public_path('wings'), $filename);
            $data['image'] = 'wings/' . $filename;
        }

        $wingMember->update($data);

        return redirect()->route('admin.wing-members.index')->with('success', 'Wing member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WingMember $wingMember)
    {
        // Delete image
        if ($wingMember->image && File::exists(public_path($wingMember->image))) {
            File::delete(public_path($wingMember->image));
        }

        $wingMember->delete();

        return redirect()->route('admin.wing-members.index')->with('success', 'Wing member deleted successfully.');
    }
}
