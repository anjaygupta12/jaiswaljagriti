@extends('admin.layouts.app')

@section('title', 'Manage Comments')
@section('header', 'Manage Comments')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Recent Comments</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>On Post/Event</th>
                        <th>Date</th>
                        <th>Approved</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $comment->name ?: ($comment->user ? $comment->user->name : 'Guest') }}</strong><br>
                            <small class="text-muted">{{ $comment->email ?: ($comment->user ? $comment->user->email : '-') }}</small>
                        </td>
                        <td>{{ Str::limit($comment->content, 50) }}</td>
                        <td>
                            @if($comment->commentable)
                                <span class="badge badge-light border">
                                    {{ class_basename($comment->commentable_type) }}: {{ $comment->commentable->title }}
                                </span>
                            @else
                                <span class="text-muted">Deleted Content</span>
                            @endif
                        </td>
                        <td>{{ $comment->created_at->format('M d, Y') }}</td>
                        <td>
                            <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="approved-{{ $comment->id }}" name="is_approved" {{ $comment->is_approved ? 'checked' : '' }} onchange="this.form.submit()">
                                    <label class="custom-control-label" for="approved-{{ $comment->id }}"></label>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this comment?');">
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
                        <td colspan="7" class="text-center py-4 text-muted">No comments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
