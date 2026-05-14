<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function create(Plan $plan)
    {
        return view('subscribe', compact('plan'));
    }

    public function store(Request $request, Plan $plan)
    {
        $request->validate([
            'transaction_id' => 'required|string|max:255',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('payment_screenshot') && $request->file('payment_screenshot')->isValid()) {
            $file = $request->file('payment_screenshot');
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $filename = 'screenshot_' . time() . '_' . uniqid() . '.' . $extension;
            $file->move(public_path('screenshots'), $filename);
            $path = 'screenshots/' . $filename;
        } else {
            return back()->withErrors(['payment_screenshot' => 'Failed to upload the image. Please try again.']);
        }

        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'transaction_id' => $request->transaction_id,
            'payment_screenshot' => $path,
            'status' => 'pending',
        ]);

        // Send email notifications
        \Illuminate\Support\Facades\Mail::to('admin@jaiswaljagriti.com')->send(new \App\Mail\SubscriptionRequested($subscription));
        \Illuminate\Support\Facades\Mail::to(Auth::user()->email)->send(new \App\Mail\SubscriptionStatusUpdated($subscription));
        
        $redirectRoute = $plan->type === 'patrika' ? 'patrika-subscription' : 'advertisement-subscription';
        return redirect()->route($redirectRoute)->with('success', 'Your subscription request has been submitted successfully and is pending admin approval.');
    }
}
