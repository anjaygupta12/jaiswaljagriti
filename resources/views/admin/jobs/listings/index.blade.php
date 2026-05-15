@extends('admin.layouts.app')

@section('title', 'Job Listings')
@section('header', 'Job Listings')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">Active Job Listings</h5>
        <a href="{{ route('admin.job-listings.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Add Job
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Job Title</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $job->title }}</strong>
                            @if($job->link)
                                <br><small><a href="{{ $job->link }}" target="_blank" class="text-info"><i class="fas fa-external-link-alt"></i> View Link</a></small>
                            @endif
                        </td>
                        <td><span class="badge badge-outline-secondary">{{ $job->category->name }}</span></td>
                        <td>
                            @if($job->is_featured)
                                <span class="badge badge-warning text-dark"><i class="fas fa-star mr-1"></i> Top Card</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            @if($job->status)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.job-listings.edit', $job->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.job-listings.destroy', $job->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this job?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No jobs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
