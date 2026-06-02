@extends('admin.layouts.app')

@section('title', 'Add Patrika Advertisement')
@section('header', 'Add Patrika Advertisement')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-box shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0 font-weight-bold">Add New Advertisement</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-patrikas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mb-4">
                        <label for="image" class="font-weight-bold">Advertisement Image <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                        <small class="form-text text-muted">Max file size: 5MB.</small>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="type" class="font-weight-bold">Advertisement Type <span class="text-danger">*</span></label>
                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Select Type</option>
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="link" class="font-weight-bold">Destination Link</label>
                        <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="https://example.com">
                        @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-group mb-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_active">Active Status</label>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.advertisement-patrikas.index') }}" class="btn btn-light rounded-pill px-4 mr-2">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Save Advertisement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
