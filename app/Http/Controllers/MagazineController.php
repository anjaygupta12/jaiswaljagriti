<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::with('plan')->where('is_active', true)->latest()->get();
        return view('magazines.index', compact('magazines'));
    }

    public function show(Magazine $magazine)
    {
        $oldFromDate = \App\Models\Setting::getVal('magazine_old_from_date');
        $isOld = $oldFromDate && $magazine->magazine_date && ($magazine->magazine_date < $oldFromDate);

        if ($isOld) {
            // Old magazine: show free but login is required
            if (!auth()->check()) {
                return view('magazines.restricted', compact('magazine', 'isOld'));
            }
            $hasAccess = true;
        } else {
            // New magazine: show for all patrika subscription users (or admin)
            if (!auth()->check()) {
                return view('magazines.restricted', compact('magazine', 'isOld'));
            }

            $hasAccess = auth()->user()->is_admin == 1 || auth()->user()->subscriptions()
                ->where('status', 'approved')
                ->whereHas('plan', function($q) {
                    $q->where('type', 'patrika');
                })
                ->exists();
        }

        if (!$hasAccess) {
            return view('magazines.restricted', compact('magazine', 'isOld'));
        }

        // Serve the PDF through Laravel
        $filePath = public_path($magazine->pdf_file);
        if (!file_exists($filePath)) abort(404, 'PDF file not found.');
        return response()->file($filePath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $magazine->slug . '.pdf"',
        ]);
    }
}
