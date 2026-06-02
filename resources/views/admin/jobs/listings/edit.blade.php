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

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Link Type <span class="text-danger">*</span></label>
                        <select name="link_type" id="link_type" class="form-control @error('link_type') is-invalid @enderror" required>
                            <option value="external" {{ old('link_type', $jobListing->link_type) == 'external' ? 'selected' : '' }}>External Link</option>
                            <option value="internal" {{ old('link_type', $jobListing->link_type) == 'internal' ? 'selected' : '' }}>Internal Job Description</option>
                        </select>
                        @error('link_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group" id="external_link_wrapper">
                <label>External Link <small class="text-muted">(Optional - URL to full details)</small></label>
                <input type="url" name="link" class="form-control @error('link') is-invalid @enderror" value="{{ old('link', $jobListing->link) }}" placeholder="https://example.com/job-details">
                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group d-none" id="internal_desc_wrapper">
                <label>Job Description <span class="text-danger">*</span></label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="10">{{ old('description', $jobListing->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback text-danger d-block" style="font-size: 80%;">{{ $message }}</div>
                @enderror
                
                <div class="custom-control custom-switch mt-3">
                    <input type="checkbox" class="custom-control-input" id="show_apply" name="show_apply" value="1" {{ old('show_apply', $jobListing->show_apply) ? 'checked' : '' }}>
                    <label class="custom-control-label" for="show_apply">Show "Apply Now" Button on Frontend</label>
                </div>
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

@push('css')
<style>
    .ck-editor__editable_inline {
        min-height: 250px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const linkTypeSelect = document.getElementById('link_type');
        const externalWrapper = document.getElementById('external_link_wrapper');
        const internalWrapper = document.getElementById('internal_desc_wrapper');

        if (linkTypeSelect && externalWrapper && internalWrapper) {
            function toggleFields() {
                if (linkTypeSelect.value === 'internal') {
                    externalWrapper.style.setProperty('display', 'none', 'important');
                    internalWrapper.style.setProperty('display', 'block', 'important');
                } else {
                    externalWrapper.style.setProperty('display', 'block', 'important');
                    internalWrapper.style.setProperty('display', 'none', 'important');
                }
            }

            linkTypeSelect.addEventListener('change', toggleFields);
            toggleFields();
        }

        if (document.querySelector('#description')) {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ]
                })
                .catch(error => {
                    console.warn('CKEditor load notice:', error);
                });
        }
    });
</script>
@endpush
