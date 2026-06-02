@extends('admin.layouts.app')

@section('title', 'Subscription Requests')
@section('header', 'Subscription Requests')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">Manage Requests</h5>
        <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Add Subscription
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Plan</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $sub)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sub->user->name }} <br><small>{{ $sub->user->email }}</small></td>
                        <td>{{ $sub->plan->name }}</td>
                        <td>₹{{ number_format($sub->plan->price, 2) }}</td>
                        <td>{{ $sub->created_at->format('d M Y') }}</td>
                        <td>
                            @if($sub->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($sub->status == 'approved')
                                <span class="badge badge-success">Approved</span>
                            @else
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.subscriptions.show', $sub->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No subscription requests found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
