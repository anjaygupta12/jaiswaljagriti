@extends('admin.layouts.app')

@section('title', 'Applied Jobs')
@section('header', 'Applied Jobs')

@section('content')
<div class="card card-box border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Job Applications</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">#</th>
                        <th>Applicant Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Job Title</th>
                        <th>Status</th>
                        <th>Applied On</th>
                        <th width="15%" class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $application)
                        <tr>
                            <td>{{ $loop->iteration + $applications->firstItem() - 1 }}</td>
                            <td>{{ $application->user->name ?? 'N/A' }}</td>
                            <td>{{ $application->email }}</td>
                            <td>{{ $application->phone }}</td>
                            <td>{{ $application->jobListing->title ?? 'N/A' }}</td>
                            <td>
                                @if($application->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($application->status == 'reviewed')
                                    <span class="badge badge-info">Reviewed</span>
                                @elseif($application->status == 'accepted')
                                    <span class="badge badge-success">Accepted</span>
                                @elseif($application->status == 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.job-applications.show', $application) }}" class="btn btn-sm btn-info" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($application->resume_path)
                                <a href="{{ asset($application->resume_path) }}" target="_blank" class="btn btn-sm btn-primary" title="View Resume">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                @endif
                                <form action="{{ route('admin.job-applications.destroy', $application) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this application?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                No applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($applications->hasPages())
        <div class="card-footer bg-white border-top-0 pt-3">
            {{ $applications->links() }}
        </div>
    @endif
</div>
@endsection
