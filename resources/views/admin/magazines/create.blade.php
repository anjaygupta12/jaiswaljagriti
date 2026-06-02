@extends('admin.layouts.app')

@section('title', 'Add Magazine')
@section('header', 'Add New Magazine')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Magazine Details</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('admin.magazines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Issue/Date <span class="text-danger">*</span></label>
                        <input type="date" name="magazine_date" class="form-control" value="{{ old('magazine_date') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Thumbnail Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumb(this)">
                            <label class="custom-file-label" for="thumbnail">Choose image...</label>
                        </div>
                        <small class="text-muted">JPG, PNG, WEBP. Max 4MB.</small>
                        <div id="thumbPreviewWrap" style="display:none; margin-top:10px;">
                            <img id="thumbPreview" src="#" style="max-height:120px; border-radius:6px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>PDF File <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="pdf_file" name="pdf_file" accept=".pdf" required
                                onchange="document.querySelector('#pdf_file + label').textContent = this.files[0].name;">
                            <label class="custom-file-label" for="pdf_file">Choose PDF...</label>
                        </div>
                        <small class="text-muted">PDF only. Max 20MB.</small>
                    </div>
                </div>
            </div>

            <div class="form-group form-check mt-2">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active (Display on frontend)</label>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Save Magazine</button>
            <a href="{{ route('admin.magazines.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewThumb(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('thumbPreview').src = e.target.result;
            document.getElementById('thumbPreviewWrap').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
        document.querySelector('#thumbnail + label').textContent = input.files[0].name;
    }
}
</script>
@endpush
