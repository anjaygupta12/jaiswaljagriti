@extends('admin.layouts.app')

@section('title', 'Magazines')
@section('header', 'Magazines')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">Manage Magazines</h5>
        <a href="{{ route('admin.magazines.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Magazine
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Access Plan</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($magazines as $mag)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($mag->thumbnail)
                                <img src="{{ asset($mag->thumbnail) }}" alt="{{ $mag->title }}" style="height:55px;width:80px;object-fit:cover;border-radius:5px;">
                            @else
                                <span class="text-muted small">No Image</span>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $mag->title }}</strong>
                            <br><small class="text-muted">{{ Str::limit($mag->description, 50) }}</small>
                        </td>
                        <td>
                            @if($mag->isFree())
                                <span class="badge badge-success">Free (Everyone)</span>
                            @elseif($mag->plan)
                                <span class="badge badge-warning text-dark">{{ $mag->plan->name }}</span>
                                <br><small class="text-muted">{{ ucfirst($mag->plan->type) }} · ₹{{ number_format($mag->plan->price, 0) }}</small>
                            @else
                                <span class="badge badge-secondary">No Plan Set</span>
                            @endif
                        </td>
                        <td>
                            @if($mag->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.magazines.edit', $mag->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.magazines.destroy', $mag->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this magazine?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No magazines found. Add one to get started.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
