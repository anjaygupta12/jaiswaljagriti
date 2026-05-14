@extends('admin.layouts.app')

@section('title', 'Edit Magazine')
@section('header', 'Edit Magazine')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Edit: {{ $magazine->title }}</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('admin.magazines.update', $magazine->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $magazine->title) }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Issue/Date <span class="text-danger">*</span></label>
                        <input type="date" name="magazine_date" class="form-control" value="{{ old('magazine_date', $magazine->magazine_date) }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Access / Plan <span class="text-danger">*</span></label>
                        <select name="plan_id" class="form-control">
                            <option value="">-- Free (Available to Everyone) --</option>
                            @foreach($plans as $plan)
                                @php $selected = old('plan_id', $magazine->plan_id) == $plan->id ? 'selected' : ''; @endphp
                                @if($plan->price == 0)
                                    <option value="{{ $plan->id }}" {{ $selected }}>
                                        {{ $plan->name }} (Free — {{ ucfirst($plan->type) }})
                                    </option>
                                @else
                                    <option value="{{ $plan->id }}" {{ $selected }}>
                                        {{ $plan->name }} — ₹{{ number_format($plan->price, 0) }}/{{ ucfirst($plan->billing_cycle) }} ({{ ucfirst($plan->type) }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <small class="text-muted">Select a paid plan to restrict access to subscribers only. Leave blank for free access.</small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $magazine->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Thumbnail Image <span class="text-muted">(leave blank to keep current)</span></label>
                        @if($magazine->thumbnail)
                            <div class="mb-2"><img src="{{ asset($magazine->thumbnail) }}" style="max-height:80px; border-radius:5px;"></div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumb(this)">
                            <label class="custom-file-label" for="thumbnail">Choose new image...</label>
                        </div>
                        <div id="thumbPreviewWrap" style="display:none; margin-top:10px;">
                            <img id="thumbPreview" src="#" style="max-height:100px; border-radius:6px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>PDF File <span class="text-muted">(leave blank to keep current)</span></label>
                        @if($magazine->pdf_file)
                            <div class="mb-2">
                                <a href="{{ asset($magazine->pdf_file) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-file-pdf"></i> View Current PDF
                                </a>
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="pdf_file" name="pdf_file" accept=".pdf"
                                onchange="document.querySelector('#pdf_file + label').textContent = this.files[0].name;">
                            <label class="custom-file-label" for="pdf_file">Choose new PDF...</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group form-check mt-2">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $magazine->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active (Display on frontend)</label>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Update Magazine</button>
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
