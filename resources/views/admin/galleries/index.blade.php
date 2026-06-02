@extends('admin.layouts.app')

@section('title', 'Manage Gallery')
@section('header', 'Manage Gallery')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-box shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 font-weight-bold">Gallery Images</h5>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="fas fa-plus mr-1"></i> Add Image
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($galleries as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <strong>{{ $item->title }}</strong><br>
                                        <small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                    </td>
                                    <td>{{ $item->location ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-danger' }} badge-pill">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.galleries.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.galleries.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No images found in the gallery.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($galleries->hasPages())
            <div class="card-footer bg-white">
                {{ $galleries->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
