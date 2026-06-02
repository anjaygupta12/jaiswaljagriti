<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class WingBannerController extends Controller
{
    public function index()
    {
        return view('admin.wing-banners.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'youth_wing_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'youth_wing_title' => 'nullable|string|max:255',
            'executive_body_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'executive_body_title' => 'nullable|string|max:255',
            'womens_wing_banner' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'womens_wing_title' => 'nullable|string|max:255',
        ]);

        $wings = [
            'youth_wing',
            'executive_body',
            'womens_wing'
        ];

        foreach ($wings as $wing) {
            $bannerKey = $wing . '_banner';
            $titleKey = $wing . '_title';

            if ($request->hasFile($bannerKey)) {
                $file = $request->file($bannerKey);
                $filename = time() . '_' . $bannerKey . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/banners'), $filename);
                $path = 'assets/images/banners/' . $filename;
                
                // Delete old image if it exists and isn't the default
                $oldPath = Setting::getVal($bannerKey);
                if ($oldPath && file_exists(public_path($oldPath)) && strpos($oldPath, 'IMG-20250826-WA0008.jpg') === false) {
                    @unlink(public_path($oldPath));
                }

                Setting::setVal($bannerKey, $path);
            }

            if ($request->has($titleKey)) {
                Setting::setVal($titleKey, $request->input($titleKey));
            }
        }

        return redirect()->back()->with('success', 'Wing banners and titles updated successfully!');
    }
}
