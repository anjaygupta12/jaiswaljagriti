@extends('admin.layouts.app')

@section('title', 'Edit Event')
@section('header', 'Edit Event')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Update Event Details</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Event Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $event->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Event Content / Description <span class="text-danger">*</span></label>
                        <textarea name="content" rows="15" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $event->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Event Category <span class="text-danger">*</span></label>
                        <select name="event_category_id" class="form-control @error('event_category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('event_category_id', $event->event_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('event_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Event Date <span class="text-danger">*</span></label>
                        <input type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date', $event->event_date) }}" required>
                        @error('event_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}">
                    </div>

                    <div class="form-group">
                        <label>Author Name</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $event->author) }}">
                    </div>

                    <div class="form-group">
                        <label>Related Magazines</label>
                        <select name="magazine_ids[]" class="form-control select2" multiple data-placeholder="Choose Magazines">
                            @foreach($magazines as $mag)
                                <option value="{{ $mag->id }}" {{ in_array($mag->id, $selectedMagazines) ? 'selected' : '' }}>{{ $mag->title }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Select magazines to show in the sidebar of this event.</small>
                    </div>

                    <div class="form-group">
                        <label>Thumbnail Image</label>
                        @if($event->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset($event->thumbnail) }}" alt="" class="img-thumbnail" style="height: 100px;">
                            </div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control-file @error('thumbnail') is-invalid @enderror">
                        @error('thumbnail')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Banner Image</label>
                        @if($event->banner)
                            <div class="mb-2">
                                <img src="{{ asset($event->banner) }}" alt="" class="img-thumbnail" style="height: 100px;">
                            </div>
                        @endif
                        <input type="file" name="banner" class="form-control-file @error('banner') is-invalid @enderror">
                        @error('banner')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $event->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Active Status</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4">Update Event</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary px-4">Cancel</a>
        </form>
    </div>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush
