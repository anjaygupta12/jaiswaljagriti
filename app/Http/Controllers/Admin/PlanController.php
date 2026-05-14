<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->get();
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:patrika,advertisement',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|string',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'status' => 'boolean'
        ]);

        if (!empty($validated['features'])) {
            $features = array_map('trim', explode("\n", $validated['features']));
            $validated['features'] = array_filter($features);
        } else {
            $validated['features'] = [];
        }

        $validated['status'] = $request->has('status');

        Plan::create($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plan created successfully.');
    }

    public function edit(Plan $plan)
    {
        // Convert features array back to string for textarea
        $features = is_array($plan->features) ? implode("\n", $plan->features) : '';
        return view('admin.plans.edit', compact('plan', 'features'));
    }

    public function update(Request $request, Plan $plan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:patrika,advertisement',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|string',
            'description' => 'nullable|string',
            'features' => 'nullable|string'
        ]);

        if (!empty($validated['features'])) {
            $features = array_map('trim', explode("\n", $validated['features']));
            $validated['features'] = array_filter($features);
        } else {
            $validated['features'] = [];
        }

        $validated['status'] = $request->has('status');

        $plan->update($validated);

        return redirect()->route('admin.plans.index')->with('success', 'Plan updated successfully.');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Plan deleted successfully.');
    }
}
