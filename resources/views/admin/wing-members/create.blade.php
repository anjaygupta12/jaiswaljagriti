@extends('admin.layouts.app')

@section('title', 'Add Wing Member')
@section('header', 'Add Wing Member')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm card-box">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h5 class="m-0 font-weight-bold text-dark">Add New Wing Member</h5>
                <a href="{{ route('admin.wing-members.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Directory
                </a>
            </div>
            
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.wing-members.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required placeholder="e.g. Manoj Kumar Shah">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="designation" class="font-weight-bold">Designation <span class="text-danger">*</span></label>
                                <input type="text" name="designation" id="designation" class="form-control" value="{{ old('designation') }}" required placeholder="e.g. Adhyaksh / President">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="short_description" class="font-weight-bold">Short Description <span class="text-muted font-weight-normal">(Optional)</span></label>
                        <textarea name="short_description" id="short_description" class="form-control" rows="3" placeholder="e.g. A dedicated leader with 15+ years of community service experience...">{{ old('short_description') }}</textarea>
                        <small class="text-muted">A brief bio shown on the public member profile cards.</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="font-weight-bold">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="e.g. 9891237738">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="e.g. mkshah22@gmail.com">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type" class="font-weight-bold">Wing Category <span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" disabled selected>-- Select Wing --</option>
                                    <option value="executive-body" {{ old('type') == 'executive-body' ? 'selected' : '' }}>Executive Body</option>
                                    <option value="youth-wing" {{ old('type') == 'youth-wing' ? 'selected' : '' }}>Youth Wing</option>
                                    <option value="womens-wing" {{ old('type') == 'womens-wing' ? 'selected' : '' }}>Women's Wing</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sort_order" class="font-weight-bold">Sort Order <span class="text-danger">*</span></label>
                                <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0" required placeholder="Lower numbers show first">
                                <small class="text-muted">Determines display sequence. 0 shows first.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="image" class="font-weight-bold">Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" name="image" id="image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label" for="image">Choose image file...</label>
                                </div>
                                <small class="text-muted d-block mt-1">Recommended: Square format (1:1), Max size: 2MB.</small>
                            </div>
                        </div>
                        
                        <div class="col-md-4 text-center">
                            <div class="mt-2">
                                <img id="preview" src="#" alt="Preview" class="img-thumbnail rounded-circle d-none" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group d-flex align-items-center">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="status" id="status" class="custom-control-input" value="1" {{ old('status', 1) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="status">Active State</label>
                        </div>
                        <span class="ml-3 text-muted" style="font-size: 13px;">Inactive members are dynamically hidden from public view.</span>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary btn-block py-2 font-weight-bold">
                        <i class="fas fa-save mr-1"></i> Save Wing Member
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Show selected file name
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
            
            // Image Preview
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).removeClass('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
