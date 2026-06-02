<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Plan;
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

    public function create()
    {
        $users = User::where('is_admin', '!=', 1)->orderBy('name')->get();
        $plans = Plan::orderBy('name')->get();
        return view('admin.subscriptions.create', compact('users', 'plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'transaction_id' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $subscription = new Subscription();
        $subscription->user_id = $request->user_id;
        $subscription->plan_id = $request->plan_id;
        $subscription->transaction_id = $request->transaction_id;
        $subscription->status = $request->status;

        if ($request->hasFile('payment_screenshot')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->payment_screenshot->extension();
            $request->payment_screenshot->move(public_path('uploads/subscriptions'), $imageName);
            $subscription->payment_screenshot = 'uploads/subscriptions/' . $imageName;
        }

        $subscription->save();

        // Notify User
        try {
            Mail::to($subscription->user->email)->send(new SubscriptionStatusUpdated($subscription));
        } catch (\Exception $e) {
            // Keep going even if mail sending fails in local environments
        }

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully.');
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
        try {
            Mail::to($subscription->user->email)->send(new SubscriptionStatusUpdated($subscription));
        } catch (\Exception $e) {
            // Keep going even if mail sending fails in local environments
        }

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription status updated successfully.');
    }
}
