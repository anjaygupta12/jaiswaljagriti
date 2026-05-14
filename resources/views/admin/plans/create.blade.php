@extends('admin.layouts.app')

@section('title', 'Create Plan')
@section('header', 'Create New Plan')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Plan Details</h5>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Plan Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="type">Plan Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="patrika" {{ old('type') == 'patrika' ? 'selected' : '' }}>Patrika</option>
                            <option value="advertisement" {{ old('type') == 'advertisement' ? 'selected' : '' }}>Advertisement</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="price">Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="billing_cycle">Billing Cycle <span class="text-danger">*</span></label>
                        <select class="form-control" id="billing_cycle" name="billing_cycle" required>
                            <option value="monthly" {{ old('billing_cycle') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ old('billing_cycle') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            <option value="lifetime" {{ old('billing_cycle') == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Short Description</label>
                <textarea class="form-control" id="description" name="description" rows="2">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="features">Features (One per line)</label>
                <textarea class="form-control" id="features" name="features" rows="5" placeholder="Feature 1&#10;Feature 2&#10;Feature 3">{{ old('features') }}</textarea>
                <small class="form-text text-muted">Enter each feature on a new line.</small>
            </div>

            <div class="form-group form-check mt-3">
                <input type="checkbox" class="form-check-input" id="status" name="status" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active (Display on frontend)</label>
            </div>

            <hr>
            
            <button type="submit" class="btn btn-primary">Save Plan</button>
            <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
