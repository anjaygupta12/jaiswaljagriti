@extends('admin.layouts.app')

@section('title', 'Job Categories')
@section('header', 'Job Categories')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">Job Categories</h5>
        <a href="{{ route('admin.job-categories.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Add Category
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Total Jobs</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>{{ $category->listings_count }}</td>
                        <td>
                            @if($category->status)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.job-categories.edit', $category->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.job-categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete category and all its jobs?');">
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
                        <td colspan="5" class="text-center py-4 text-muted">No categories found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
