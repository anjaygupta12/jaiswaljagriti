<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionStatusUpdated;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['user', 'plan'])->latest()->get();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function show(Subscription $subscription)
    {
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $subscription->update([
            'status' => $request->status,
        ]);

        // Notify User
        Mail::to($subscription->user->email)->send(new SubscriptionStatusUpdated($subscription));

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription status updated successfully.');
    }
}
