@extends('admin.layouts.app')

@section('title', 'Add Spiritual Yatra')
@section('header', 'Add Spiritual Yatra')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">Create New Yatra</h5>
        <a href="{{ route('admin.spiritual-yatras.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.spiritual-yatras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Short Description (for Home Page Card) *</label>
                        <textarea name="short_description" id="short_description" class="form-control" rows="3" required>{{ old('short_description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Full Content / Details</label>
                        <textarea name="content" id="content" class="form-control summernote">{{ old('content') }}</textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail Image *</label>
                                <input type="file" name="thumbnail" id="thumbnail" class="form-control-file" accept="image/*" required onchange="previewImage(this)">
                                <div id="imagePreviewWrapper" class="mt-3" style="display:none;">
                                    <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded shadow-sm">
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                                    <label class="custom-control-label" for="status">Publish (Active)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">
                        <i class="fas fa-save"></i> Save Yatra
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewWrapper').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
