@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')
@section('header', 'Edit Gallery Image')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-box shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0 font-weight-bold">Edit Image</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-3">
                        <label for="title" class="font-weight-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="font-weight-bold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="location" class="font-weight-bold">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $gallery->location) }}">
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="image" class="font-weight-bold">Update Image</label><br>
                        @if($gallery->image_path)
                            <img src="{{ asset($gallery->image_path) }}" class="img-thumbnail mb-2" style="max-height: 150px;">
                        @endif
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Leave blank if you do not want to change the image. Max file size: 5MB.</small>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-group mb-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_active">Active (Show in gallery)</label>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.galleries.index') }}" class="btn btn-light rounded-pill px-4 mr-2">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Update Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
