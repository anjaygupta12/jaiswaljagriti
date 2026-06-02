@extends('admin.layouts.app')

@section('title', 'Events Banner')
@section('header', 'Events Banner')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">
            <i class="fas fa-image mr-2 text-primary"></i> Events Banner
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

        <form action="{{ route('admin.events-banner.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-4 border-left-primary">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-image mr-2"></i> Events Banner Image & Text
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="events_banner_title">Banner Title</label>
                        <input type="text" class="form-control" id="events_banner_title" name="events_banner_title" value="{{ old('events_banner_title', $settings['events_banner_title'] ?? '') }}">
                    </div>

                    @if($settings['events_banner'])
                        <div class="mb-3">
                            <label class="d-block text-muted small mb-1">Current Banner</label>
                            <img src="{{ asset($settings['events_banner']) }}"
                                 alt="Current Banner"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <label>Upload New Banner <span class="text-muted small">(JPG, PNG, WEBP — Max 4MB)</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="events_banner" name="events_banner"
                                   accept="image/*" onchange="previewBanner(this)">
                            <label class="custom-file-label" for="events_banner">Choose image...</label>
                        </div>
                        <div id="bannerPreviewWrapper" class="mt-3" style="display:none;">
                            <img id="bannerPreview" src="#" alt="Preview"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i> Save Events Banner
            </button>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
function previewBanner(input) {
    const wrapper = document.getElementById('bannerPreviewWrapper');
    const preview = document.getElementById('bannerPreview');
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
