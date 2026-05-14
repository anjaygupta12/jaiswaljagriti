@extends('layouts.app')

@section('content')
<div class="container-custom py-5">
    <div class="section-title text-center mb-5">
        <h2>My Profile</h2>
        <p class="mt-3 text-white">Manage your account details and view your active subscriptions.</p>
    </div>

    <div class="row">
        <!-- Left Column: User Details & Password -->
        <div class="col-lg-4 mb-4">
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                    <i class="fas fa-user-edit text-primary mr-2"></i> Account Details
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.details.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">Update Details</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                    <i class="fas fa-lock text-primary mr-2"></i> Change Password
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">Update Password</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Right Column: Subscriptions -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                    <i class="fas fa-newspaper text-primary mr-2"></i> Patrika Subscriptions
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                    <th>Transaction ID</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($patrikaSubscriptions as $sub)
                                <tr>
                                    <td>{{ $sub->plan->name }}</td>
                                    <td>₹{{ number_format($sub->plan->price, 2) }}</td>
                                    <td>{{ $sub->transaction_id }}</td>
                                    <td>
                                        @if($sub->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($sub->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning text-white">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $sub->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">You have no Patrika subscriptions. <br> <a href="{{ route('patrika-subscription') }}" class="btn btn-sm btn-outline-primary mt-2">Subscribe Now</a></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white font-weight-bold" style="border-radius: 15px 15px 0 0;">
                    <i class="fas fa-ad text-primary mr-2"></i> Advertisement Subscriptions
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Plan Name</th>
                                    <th>Price</th>
                                    <th>Transaction ID</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($advertisementSubscriptions as $sub)
                                <tr>
                                    <td>{{ $sub->plan->name }}</td>
                                    <td>₹{{ number_format($sub->plan->price, 2) }}</td>
                                    <td>{{ $sub->transaction_id }}</td>
                                    <td>
                                        @if($sub->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($sub->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning text-white">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $sub->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">You have no Advertisement subscriptions. <br> <a href="{{ route('advertisement-subscription') }}" class="btn btn-sm btn-outline-primary mt-2">Subscribe Now</a></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="mt-4 text-right">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger rounded-pill px-4"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
