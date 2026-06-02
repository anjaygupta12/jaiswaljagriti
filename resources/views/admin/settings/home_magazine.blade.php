@extends('admin.layouts.app')

@section('title', 'Home Magazine Section Settings')
@section('header', 'Home Magazine Section Settings')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">
            <i class="fas fa-book-open mr-2 text-primary"></i> Home Magazine Section
        </h5>
    </div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <form action="{{ route('admin.home-magazine.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Main Title -->
            <div class="card mb-4 border-left-primary">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-heading mr-2"></i> Main Section Title
                </div>
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label for="home_magazine_title">Title (e.g., Jaiswal Jagriti Magazine)</label>
                        <input type="text" class="form-control" id="home_magazine_title" name="home_magazine_title" value="{{ old('home_magazine_title', $settings['home_magazine_title'] ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="card mb-4 border-left-primary">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-align-left mr-2"></i> Information Block
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="home_magazine_info_text">Information Text (HTML allowed)</label>
                        <textarea class="form-control summernote" id="home_magazine_info_text" name="home_magazine_info_text" rows="5">{{ old('home_magazine_info_text', $settings['home_magazine_info_text'] ?? '') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="home_magazine_btn_text">Button Text</label>
                            <input type="text" class="form-control" id="home_magazine_btn_text" name="home_magazine_btn_text" value="{{ old('home_magazine_btn_text', $settings['home_magazine_btn_text'] ?? '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="home_magazine_btn_link">Button Link</label>
                            <input type="text" class="form-control" id="home_magazine_btn_link" name="home_magazine_btn_link" value="{{ old('home_magazine_btn_link', $settings['home_magazine_btn_link'] ?? '') }}">
                        </div>
                    </div>
                    
                    <hr>

                    @if(!empty($settings['home_magazine_image']))
                        <div class="mb-3">
                            <label class="d-block text-muted small mb-1">Current Image</label>
                            <img src="{{ asset($settings['home_magazine_image']) }}"
                                 alt="Current Magazine Image"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <label>Upload New Side Image <span class="text-muted small">(JPG, PNG, WEBP — Max 4MB)</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="home_magazine_image" name="home_magazine_image"
                                   accept="image/*" onchange="previewImage(this)">
                            <label class="custom-file-label" for="home_magazine_image">Choose image...</label>
                        </div>
                        <div id="imagePreviewWrapper" class="mt-3" style="display:none;">
                            <img id="imagePreview" src="#" alt="Preview"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i> Save Changes
            </button>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function() {
    $('.summernote').summernote({
        height: 250,
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
            // Update custom file label
            var fileName = input.files[0].name;
            $(input).next('.custom-file-label').html(fileName);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
