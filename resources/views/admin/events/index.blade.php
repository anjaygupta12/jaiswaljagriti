@extends('admin.layouts.app')

@section('title', 'Upcoming Events')
@section('header', 'Upcoming Events')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">Events List</h5>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Add Event
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Thumbnail</th>
                        <th>Event Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($event->thumbnail)
                                <img src="{{ asset($event->thumbnail) }}" alt="" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                            @else
                                <span class="badge badge-light border">No Image</span>
                            @endif
                        </td>
                        <td><strong>{{ $event->title }}</strong></td>
                        <td><span class="badge badge-info">{{ $event->category ?: 'Upcoming Event' }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
                        <td><span class="text-muted">{{ number_format($event->views) }}</span></td>
                        <td>
                            @if($event->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this event?');">
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
                        <td colspan="6" class="text-center py-4 text-muted">No events found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
