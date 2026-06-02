@extends('admin.layouts.app')

@section('title', 'Manage Normal Advertisements')
@section('header', 'Normal Advertisements')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-box shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 font-weight-bold">Normal Advertisements</h5>
                <a href="{{ route('admin.advertisement-normals.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                    <i class="fas fa-plus mr-1"></i> Add Advertisement
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Size / Type</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ads as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->image_path) }}" alt="Ad Image" class="img-thumbnail" style="height: 60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $item->type->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        @if($item->link)
                                            <a href="{{ $item->link }}" target="_blank"><i class="fas fa-external-link-alt"></i> Link</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-danger' }} badge-pill">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.advertisement-normals.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.advertisement-normals.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this advertisement?');">
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
                                    <td colspan="5" class="text-center py-4 text-muted">No Normal advertisements found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($ads->hasPages())
            <div class="card-footer bg-white">
                {{ $ads->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
