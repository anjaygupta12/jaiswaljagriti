@extends('admin.layouts.app')

@section('title', 'Add Banner')
@section('header', 'Add New Banner')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Upload Banner Image</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Banner Image <span class="text-danger">*</span></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" required onchange="previewImage(this)">
                    <label class="custom-file-label" for="image">Choose image...</label>
                </div>
                <small class="form-text text-muted">Accepted formats: JPG, PNG, WEBP. Max size: 4MB. Recommended size: 1920×600px.</small>
            </div>

            <div id="imagePreviewWrapper" class="mb-3" style="display:none;">
                <label>Preview</label>
                <img id="imagePreview" src="#" alt="Preview" style="width:100%; max-height:300px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6;">
            </div>

            <div class="form-group form-check mt-3">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                <label class="form-check-label" for="is_active">Active (Display on Homepage)</label>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Upload Banner</button>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const wrapper = document.getElementById('imagePreviewWrapper');
        const preview = document.getElementById('imagePreview');
        const label = document.querySelector('.custom-file-label');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { preview.src = e.target.result; wrapper.style.display = 'block'; };
            reader.readAsDataURL(input.files[0]);
            label.textContent = input.files[0].name;
        }
    }
</script>
@endpush
