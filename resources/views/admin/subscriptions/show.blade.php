@extends('admin.layouts.app')

@section('title', 'Subscription Details')
@section('header', 'Review Subscription')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Subscription Request Details</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold border-bottom pb-2">User Details</h6>
                <p><strong>Name:</strong> {{ $subscription->user->name }}</p>
                <p><strong>Email:</strong> {{ $subscription->user->email }}</p>

                <h6 class="font-weight-bold border-bottom pb-2 mt-4">Plan Details</h6>
                <p><strong>Plan Name:</strong> {{ $subscription->plan->name }}</p>
                <p><strong>Price:</strong> ₹{{ number_format($subscription->plan->price, 2) }}</p>
                <p><strong>Billing Cycle:</strong> {{ ucfirst($subscription->plan->billing_cycle) }}</p>
                
                <h6 class="font-weight-bold border-bottom pb-2 mt-4">Payment Details</h6>
                <p><strong>Transaction / UTR ID:</strong> <span class="text-primary font-weight-bold">{{ $subscription->transaction_id }}</span></p>
                <p><strong>Status:</strong> 
                    @if($subscription->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($subscription->status == 'approved')
                        <span class="badge badge-success">Approved</span>
                    @else
                        <span class="badge badge-danger">Rejected</span>
                    @endif
                </p>
                <p><strong>Submitted On:</strong> {{ $subscription->created_at->format('d M Y, h:i A') }}</p>
            </div>
            
            <div class="col-md-6 text-center border-left">
                <h6 class="font-weight-bold border-bottom pb-2">Payment Screenshot</h6>
                <a href="{{ asset($subscription->payment_screenshot) }}" target="_blank">
                    <img src="{{ asset($subscription->payment_screenshot) }}" alt="Screenshot" class="img-fluid rounded border mt-3" style="max-height: 400px;">
                </a>
                <p class="text-muted mt-2"><small>Click image to view full size.</small></p>
            </div>
        </div>

        <hr>
        
        @if($subscription->status == 'pending')
        <div class="d-flex justify-content-end gap-2">
            <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST" class="mr-2">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to APPROVE this subscription?');">
                    <i class="fas fa-check"></i> Approve Subscription
                </button>
            </form>

            <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to REJECT this subscription?');">
                    <i class="fas fa-times"></i> Reject Subscription
                </button>
            </form>
        </div>
        @else
            <div class="alert alert-info mb-0 mt-3 text-center">
                This subscription request has already been <strong>{{ strtoupper($subscription->status) }}</strong>.
            </div>
        @endif
    </div>
</div>
@endsection
