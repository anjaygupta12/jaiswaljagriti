@extends('admin.layouts.app')

@section('title', 'Application Details')
@section('header', 'Application Details')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-box border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 font-weight-bold">Applicant Details</h5>
                <a href="{{ route('admin.job-applications.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Applicant Name</th>
                        <td>{{ $jobApplication->user->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td>{{ $jobApplication->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>{{ $jobApplication->phone }}</td>
                    </tr>
                    <tr>
                        <th>Applied For</th>
                        <td>{{ $jobApplication->jobListing->title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Applied On</th>
                        <td>{{ $jobApplication->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Resume</th>
                        <td>
                            @if($jobApplication->resume_path)
                                <a href="{{ asset($jobApplication->resume_path) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fas fa-file-download mr-1"></i> Download / View Resume
                                </a>
                            @else
                                <span class="text-muted">No resume uploaded.</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Current Status</th>
                        <td>
                            @if($jobApplication->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($jobApplication->status == 'reviewed')
                                <span class="badge badge-info">Reviewed</span>
                            @elseif($jobApplication->status == 'accepted')
                                <span class="badge badge-success">Accepted</span>
                            @elseif($jobApplication->status == 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer bg-light">
                <form action="{{ route('admin.job-applications.status', $jobApplication) }}" method="POST" class="form-inline">
                    @csrf
                    @method('PATCH')
                    <label class="mr-2 font-weight-bold">Update Status:</label>
                    <select name="status" class="form-control mr-2" required>
                        <option value="pending" {{ $jobApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewed" {{ $jobApplication->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                        <option value="accepted" {{ $jobApplication->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ $jobApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
