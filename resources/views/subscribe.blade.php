@extends('layouts.app')

@section('content')
<div class="container-custom py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0" style="border-radius: 20px;">
                <div class="card-header bg-white text-center pt-4 pb-0 border-0">
                    <h3 class="font-weight-bold">Subscribe to {{ $plan->name }}</h3>
                    <p class="text-muted">Complete your payment to activate this plan.</p>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Payment Details -->
                    <div class="row mb-5">
                        <div class="col-md-6 text-center" style="border-right: 1px solid #eee;">
                            <h5 class="font-weight-bold mb-3">Scan QR to Pay</h5>
                            <!-- Placeholder QR Code -->
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=exampleUPIID@upi" alt="QR Code" class="img-fluid border p-2 rounded" style="max-width: 150px;">
                            <p class="mt-2 mb-0"><strong>UPI ID:</strong> exampleUPIID@upi</p>
                            <p class="text-danger font-weight-bold mt-2" style="font-size: 20px;">Amount: ₹{{ number_format($plan->price, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="font-weight-bold mb-3 text-center">Bank Account Details</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between px-0"><span>Bank Name:</span> <strong>State Bank of India</strong></li>
                                <li class="list-group-item d-flex justify-content-between px-0"><span>Account Name:</span> <strong>Jaiswal Jagriti</strong></li>
                                <li class="list-group-item d-flex justify-content-between px-0"><span>Account No:</span> <strong>123456789012</strong></li>
                                <li class="list-group-item d-flex justify-content-between px-0"><span>IFSC Code:</span> <strong>SBIN0001234</strong></li>
                            </ul>
                        </div>
                    </div>

                    <hr>

                    <!-- Submission Form -->
                    <h5 class="font-weight-bold mb-4 mt-4">Submit Payment Details</h5>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('subscribe.store', $plan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="transaction_id" class="font-weight-bold">Transaction ID / UTR Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}" placeholder="Enter the 12-digit UTR or Transaction ID" required style="padding: 12px; border-radius: 8px;">
                        </div>

                        <div class="form-group mb-4">
                            <label for="payment_screenshot" class="font-weight-bold">Payment Screenshot <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file border p-2 w-100" id="payment_screenshot" name="payment_screenshot" accept="image/*" required style="border-radius: 8px;">
                            <small class="form-text text-muted mt-2">Upload a clear screenshot of your successful payment (JPG, PNG).</small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block rounded-pill" style="padding: 14px; font-size: 18px; font-weight: 600;">Submit Subscription Request</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
