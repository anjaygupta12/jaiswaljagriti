@extends('admin.layouts.app')

@section('title', 'Contact Page')
@section('header', 'Contact Page')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">
            <i class="fas fa-address-card mr-2 text-primary"></i> Contact Page
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

        <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ====== Header Banner ====== --}}
            <div class="card mb-4 border-left-primary">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-image mr-2"></i> Header Banner Image
                </div>
                <div class="card-body">
                    @if($settings['contact_banner'])
                        <div class="mb-3">
                            <label class="d-block text-muted small mb-1">Current Banner</label>
                            <img src="{{ asset($settings['contact_banner']) }}"
                                 alt="Current Banner"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    @endif
                    <div class="form-group mb-3">
                        <label for="contact_banner_badge">Banner Badge (Small Text Above Title)</label>
                        <input type="text" class="form-control" id="contact_banner_badge" name="contact_banner_badge" value="{{ old('contact_banner_badge', $settings['contact_banner_badge'] ?? '') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="contact_banner_title">Banner Title</label>
                        <input type="text" class="form-control" id="contact_banner_title" name="contact_banner_title" value="{{ old('contact_banner_title', $settings['contact_banner_title'] ?? '') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="contact_banner_subtitle">Banner Subtitle</label>
                        <textarea class="form-control" id="contact_banner_subtitle" name="contact_banner_subtitle" rows="2">{{ old('contact_banner_subtitle', $settings['contact_banner_subtitle'] ?? '') }}</textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label>Upload New Banner <span class="text-muted small">(JPG, PNG, WEBP — Max 4MB)</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="contact_banner" name="contact_banner"
                                   accept="image/*" onchange="previewBanner(this)">
                            <label class="custom-file-label" for="contact_banner">Choose image...</label>
                        </div>
                        <div id="bannerPreviewWrapper" class="mt-3" style="display:none;">
                            <img id="bannerPreview" src="#" alt="Preview"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:8px;border:1px solid #dee2e6;">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ====== Contact Details ====== --}}
            <div class="card mb-4 border-left-info">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-address-card mr-2"></i> Contact Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_email">Contact Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                       value="{{ old('contact_email', $settings['contact_email']) }}" required>
                                <small class="form-text text-muted">Contact form messages will be sent to this email.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_phone">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                       value="{{ old('contact_phone', $settings['contact_phone']) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact_address">Office Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="contact_address" name="contact_address"
                                  rows="3" required>{{ old('contact_address', $settings['contact_address']) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ====== Map ====== --}}
            <div class="card mb-4 border-left-success">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-map-marked-alt mr-2"></i> Google Maps Embed URL
                </div>
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label for="contact_map_url">Embed URL <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="contact_map_url" name="contact_map_url"
                                  rows="3" required>{{ old('contact_map_url', $settings['contact_map_url']) }}</textarea>
                        <small class="form-text text-muted">
                            Go to Google Maps → Share → Embed a map → copy the <code>src="..."</code> URL only.
                        </small>
                    </div>
                    @if($settings['contact_map_url'])
                        <div class="mt-3">
                            <label class="d-block text-muted small mb-1">Map Preview</label>
                            <iframe src="{{ $settings['contact_map_url'] }}"
                                    width="100%" height="250" style="border:0;border-radius:8px;" loading="lazy"></iframe>
                        </div>
                    @endif
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i> Save Contact Page
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
