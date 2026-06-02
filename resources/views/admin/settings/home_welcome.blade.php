@extends('admin.layouts.app')

@section('title', 'Home Welcome Section Settings')
@section('header', 'Home Welcome Section Settings')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">
            <i class="fas fa-home mr-2 text-primary"></i> Home Welcome Section
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

        <form action="{{ route('admin.home-welcome.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Main Title -->
            <div class="card mb-4 border-left-primary">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-heading mr-2"></i> Main Section Title
                </div>
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label for="home_welcome_title">Title (e.g., Welcome to Jaiswal Jagriti Family)</label>
                        <input type="text" class="form-control" id="home_welcome_title" name="home_welcome_title" value="{{ old('home_welcome_title', $settings['home_welcome_title'] ?? '') }}">
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
                        <label for="home_welcome_info_title">Information Title</label>
                        <input type="text" class="form-control" id="home_welcome_info_title" name="home_welcome_info_title" value="{{ old('home_welcome_info_title', $settings['home_welcome_info_title'] ?? '') }}">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="home_welcome_info_text">Information Text (HTML allowed)</label>
                        <textarea class="form-control summernote" id="home_welcome_info_text" name="home_welcome_info_text" rows="5">{{ old('home_welcome_info_text', $settings['home_welcome_info_text'] ?? '') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="home_welcome_btn_text">Button Text</label>
                            <input type="text" class="form-control" id="home_welcome_btn_text" name="home_welcome_btn_text" value="{{ old('home_welcome_btn_text', $settings['home_welcome_btn_text'] ?? '') }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="home_welcome_btn_link">Button Link</label>
                            <input type="text" class="form-control" id="home_welcome_btn_link" name="home_welcome_btn_link" value="{{ old('home_welcome_btn_link', $settings['home_welcome_btn_link'] ?? '') }}">
                        </div>
                    </div>
                    
                    <hr>

                    @if($settings['home_welcome_image'])
                        <div class="mb-3">
                            <label class="d-block text-muted small mb-1">Current Image</label>
                            <img src="{{ asset($settings['home_welcome_image']) }}"
                                 alt="Current Welcome Image"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <label>Upload New Side Image <span class="text-muted small">(JPG, PNG, WEBP — Max 4MB)</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="home_welcome_image" name="home_welcome_image"
                                   accept="image/*" onchange="previewImage(this)">
                            <label class="custom-file-label" for="home_welcome_image">Choose image...</label>
                        </div>
                        <div id="imagePreviewWrapper" class="mt-3" style="display:none;">
                            <img id="imagePreview" src="#" alt="Preview"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="card mb-4 border-left-info">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-th mr-2"></i> Category Grid (6 Cards)
                </div>
                <div class="card-body">
                    <div class="row">
                    @for($i = 1; $i <= 6; $i++)
                        <div class="col-md-6 mb-4">
                            <div class="p-3 border rounded">
                                <h6 class="font-weight-bold text-primary mb-3">Card {{ $i }}</h6>
                                
                                <div class="form-group mb-2">
                                    <label>Title</label>
                                    <input type="text" class="form-control form-control-sm" name="home_cat_{{ $i }}_title" value="{{ old('home_cat_'.$i.'_title', $settings['home_cat_'.$i.'_title'] ?? '') }}">
                                </div>

                                <div class="form-group mb-2">
                                    <label>Link URL</label>
                                    <input type="text" class="form-control form-control-sm" name="home_cat_{{ $i }}_link" value="{{ old('home_cat_'.$i.'_link', $settings['home_cat_'.$i.'_link'] ?? '#') }}">
                                </div>
                                
                                @if(!empty($settings['home_cat_'.$i.'_image']))
                                    <div class="mb-2">
                                        <img src="{{ asset($settings['home_cat_'.$i.'_image']) }}" alt="Card {{ $i }} Image" style="height: 50px; border-radius: 4px; object-fit: cover;">
                                    </div>
                                @endif
                                
                                <div class="form-group mb-0">
                                    <label>Upload Image</label>
                                    <input type="file" class="form-control-file" name="home_cat_{{ $i }}_image" accept="image/*">
                                </div>
                            </div>
                        </div>
                    @endfor
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
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

function previewImage(input) {
    const wrapper = document.getElementById('imagePreviewWrapper');
    const preview = document.getElementById('imagePreview');
    const label   = document.querySelector('.custom-file-label');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; wrapper.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
        label.textContent = input.files[0].name;
    }
}
</script>
@endpush
