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
        // Free magazine or no plan assigned — open for everyone
        if ($magazine->isFree()) {
            $filePath = public_path($magazine->pdf_file);
            if (!file_exists($filePath)) abort(404, 'PDF file not found.');
            return response()->file($filePath, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $magazine->slug . '.pdf"',
            ]);
        }

        // Subscription-based: check if user is logged in & has active plan
        if (!auth()->check()) {
            return view('magazines.restricted', compact('magazine'));
        }

        $hasAccess = auth()->user()->subscriptions()
            ->where('status', 'approved')
            ->where('plan_id', $magazine->plan_id)
            ->exists();

        if (!$hasAccess) {
            return view('magazines.restricted', compact('magazine'));
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
