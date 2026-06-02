<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::with('plan')->latest()->get();
        return view('admin.magazines.index', compact('magazines'));
    }

    public function create()
    {
        return view('admin.magazines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'magazine_date' => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'thumbnail'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'pdf_file'      => 'required|mimes:pdf|max:20480',
        ]);

        $data = [
            'title'         => $request->title,
            'magazine_date' => $request->magazine_date,
            'slug'          => Str::slug($request->title),
            'description'   => $request->description,
            'is_active'     => $request->has('is_active'),
        ];

        // Make slug unique
        $originalSlug = $data['slug'];
        $count = 1;
        while (Magazine::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count++;
        }

        // Upload Thumbnail
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('mag-files/thumbnails'), $filename);
            $data['thumbnail'] = 'mag-files/thumbnails/' . $filename;
        }

        // Upload PDF
        $pdf = $request->file('pdf_file');
        $pdfName = 'mag_' . time() . '_' . uniqid() . '.pdf';
        $pdf->move(public_path('mag-files/pdfs'), $pdfName);
        $data['pdf_file'] = 'mag-files/pdfs/' . $pdfName;

        Magazine::create($data);

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine created successfully.');
    }

    public function edit(Magazine $magazine)
    {
        return view('admin.magazines.edit', compact('magazine'));
    }

    public function update(Request $request, Magazine $magazine)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'magazine_date' => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'thumbnail'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'pdf_file'      => 'nullable|mimes:pdf|max:20480',
        ]);

        $data = [
            'title'         => $request->title,
            'magazine_date' => $request->magazine_date,
            'description'   => $request->description,
            'is_active'     => $request->has('is_active'),
        ];

        // Upload new thumbnail
        if ($request->hasFile('thumbnail')) {
            if ($magazine->thumbnail && file_exists(public_path($magazine->thumbnail))) {
                unlink(public_path($magazine->thumbnail));
            }
            $file = $request->file('thumbnail');
            $filename = 'thumb_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('mag-files/thumbnails'), $filename);
            $data['thumbnail'] = 'mag-files/thumbnails/' . $filename;
        }

        // Upload new PDF
        if ($request->hasFile('pdf_file')) {
            if ($magazine->pdf_file && file_exists(public_path($magazine->pdf_file))) {
                unlink(public_path($magazine->pdf_file));
            }
            $pdf = $request->file('pdf_file');
            $pdfName = 'mag_' . time() . '_' . uniqid() . '.pdf';
            $pdf->move(public_path('mag-files/pdfs'), $pdfName);
            $data['pdf_file'] = 'mag-files/pdfs/' . $pdfName;
        }

        $magazine->update($data);

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine updated successfully.');
    }

    public function destroy(Magazine $magazine)
    {
        if ($magazine->thumbnail && file_exists(public_path($magazine->thumbnail))) {
            unlink(public_path($magazine->thumbnail));
        }
        if ($magazine->pdf_file && file_exists(public_path($magazine->pdf_file))) {
            unlink(public_path($magazine->pdf_file));
        }
        $magazine->delete();

        return redirect()->route('admin.magazines.index')->with('success', 'Magazine deleted successfully.');
    }
}
