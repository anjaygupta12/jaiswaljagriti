@extends('admin.layouts.app')

@section('title', 'Edit Job Listing')
@section('header', 'Edit Job Listing')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Update Job Details</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.job-listings.update', $jobListing->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Category <span class="text-danger">*</span></label>
                        <select name="job_category_id" class="form-control @error('job_category_id') is-invalid @enderror" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('job_category_id', $jobListing->job_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('job_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Job Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $jobListing->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>External Link <small class="text-muted">(Optional - URL to full details)</small></label>
                <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $jobListing->link) }}">
                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" {{ old('is_featured', $jobListing->is_featured) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_featured">Featured (Show in Top 4 Cards)</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" {{ old('status', $jobListing->status) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="status">Active Status</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Update Job Listing</button>
            <a href="{{ route('admin.job-listings.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
