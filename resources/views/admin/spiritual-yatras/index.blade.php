@extends('admin.layouts.app')

@section('title', 'Spiritual Yatras')
@section('header', 'Spiritual Yatras')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold"><i class="fas fa-om mr-2 text-primary"></i> Spiritual Yatras</h5>
        <a href="{{ route('admin.spiritual-yatras.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    <div class="card-body p-0">
        @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date Added</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($yatras as $yatra)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($yatra->thumbnail)
                                <img src="{{ asset($yatra->thumbnail) }}" alt="Thumbnail" width="60" class="rounded">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td class="font-weight-bold">{{ $yatra->title }}</td>
                        <td>
                            @if($yatra->status)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $yatra->created_at->format('M d, Y') }}</td>
                        <td class="text-right">
                            <a href="{{ route('spiritual-yatras.show', $yatra->slug) }}" target="_blank" class="btn btn-info btn-sm" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.spiritual-yatras.edit', $yatra->id) }}" class="btn btn-warning btn-sm text-white" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.spiritual-yatras.destroy', $yatra->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this yatra?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No spiritual yatras found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
