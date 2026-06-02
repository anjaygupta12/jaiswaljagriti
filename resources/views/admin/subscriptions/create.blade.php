@extends('admin.layouts.app')

@section('title', 'Add Subscription')
@section('header', 'Add Subscription')

@section('content')
<div class="container-fluid px-0">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 font-weight-bold">Create New Subscription</h5>
                    <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('admin.subscriptions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- User Selection -->
                        <div class="form-group">
                            <label for="user_id" class="font-weight-bold">Select User <span class="text-danger">*</span></label>
                            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="" selected disabled>-- Choose a User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Plan Selection -->
                        <div class="form-group mt-3">
                            <label for="plan_id" class="font-weight-bold">Select Plan <span class="text-danger">*</span></label>
                            <select class="form-control @error('plan_id') is-invalid @enderror" id="plan_id" name="plan_id" required>
                                <option value="" selected disabled>-- Choose a Plan --</option>
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}" {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->name }} (₹{{ number_format($plan->price, 2) }} / {{ $plan->billing_cycle }})
                                    </option>
                                @endforeach
                            </select>
                            @error('plan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Transaction ID / UTR -->
                        <div class="form-group mt-3">
                            <label for="transaction_id" class="font-weight-bold">Transaction ID / UTR <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('transaction_id') is-invalid @enderror" 
                                   id="transaction_id" 
                                   name="transaction_id" 
                                   value="{{ old('transaction_id') }}" 
                                   placeholder="Enter bank transaction reference or UTR number" 
                                   required>
                            @error('transaction_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Selection -->
                        <div class="form-group mt-3">
                            <label for="status" class="font-weight-bold">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="approved" {{ old('status', 'approved') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Screenshot Upload -->
                        <div class="form-group mt-3">
                            <label for="payment_screenshot" class="font-weight-bold">Payment Screenshot <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('payment_screenshot') is-invalid @enderror" 
                                       id="payment_screenshot" 
                                       name="payment_screenshot" 
                                       accept="image/*" 
                                       required>
                                <label class="custom-file-label" for="payment_screenshot">Choose image file...</label>
                            </div>
                            <small class="form-text text-muted">Upload proof of payment (PNG, JPG, JPEG, GIF or WEBP format. Max 2MB).</small>
                            @error('payment_screenshot')
                                <div class="text-danger mt-1" style="font-size: 80%;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group mt-4 mb-0">
                            <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Save and Add Subscription
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Show the selected filename in the custom file input
    document.getElementById('payment_screenshot').addEventListener('change', function(e){
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush
