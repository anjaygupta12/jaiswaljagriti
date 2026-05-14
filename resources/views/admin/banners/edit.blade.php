@extends('admin.layouts.app')

@section('title', 'Edit Banner')
@section('header', 'Edit Banner')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Update Banner</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Current Banner Image</label>
                <div>
                    <img src="{{ asset($banner->image_path) }}" alt="Current Banner" style="width:100%; max-height:300px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6;">
                </div>
            </div>

            <div class="form-group">
                <label>Replace Image <span class="text-muted">(optional)</span></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                    <label class="custom-file-label" for="image">Choose new image...</label>
                </div>
                <small class="form-text text-muted">Leave blank to keep the current image.</small>
            </div>

            <div id="imagePreviewWrapper" class="mb-3" style="display:none;">
                <label>New Preview</label>
                <img id="imagePreview" src="#" alt="Preview" style="width:100%; max-height:300px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6;">
            </div>

            <div class="form-group form-check mt-3">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active (Display on Homepage)</label>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Update Banner</button>
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
