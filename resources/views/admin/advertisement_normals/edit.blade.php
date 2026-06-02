@extends('admin.layouts.app')

@section('title', 'Edit Normal Advertisement')
@section('header', 'Edit Normal Advertisement')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-box shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 py-3">
                <h5 class="mb-0 font-weight-bold">Edit Advertisement</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.advertisement-normals.update', $advertisement_normal->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-4">
                        <label for="image" class="font-weight-bold">Update Image</label><br>
                        @if($advertisement_normal->image_path)
                            <img src="{{ asset($advertisement_normal->image_path) }}" class="img-thumbnail mb-2" style="max-height: 150px;">
                        @endif
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Leave blank if you do not want to change the image. Max file size: 5MB.</small>
                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="advertisement_type_id" class="font-weight-bold">Advertisement Size / Type <span class="text-danger">*</span></label>
                        <div class="d-flex">
                            <select class="form-control @error('advertisement_type_id') is-invalid @enderror mr-2" id="advertisement_type_id" name="advertisement_type_id" required>
                                <option value="">Select Type (e.g. 100 X 100)</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ old('advertisement_type_id', $advertisement_normal->advertisement_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addTypeModal" title="Add New Size">
                                <i class="fas fa-plus"></i> New
                            </button>
                        </div>
                        @error('advertisement_type_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="link" class="font-weight-bold">Destination Link</label>
                        <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $advertisement_normal->link) }}" placeholder="https://example.com">
                        @error('link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="form-group mb-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $advertisement_normal->is_active) ? 'checked' : '' }}>
                            <label class="custom-control-label font-weight-bold" for="is_active">Active Status</label>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="{{ route('admin.advertisement-normals.index') }}" class="btn btn-light rounded-pill px-4 mr-2">Cancel</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4">Update Advertisement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Type Modal -->
<div class="modal fade" id="addTypeModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTypeModalLabel">Add New Size / Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="new_type_name">Size Name (e.g. 150 X 150)</label>
                    <input type="text" id="new_type_name" class="form-control" placeholder="150 X 150">
                    <div class="invalid-feedback" id="new_type_error"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveTypeBtn">Save Size</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('saveTypeBtn').addEventListener('click', function() {
        let name = document.getElementById('new_type_name').value;
        let errorDiv = document.getElementById('new_type_error');
        let input = document.getElementById('new_type_name');
        
        if(name.trim() === '') {
            input.classList.add('is-invalid');
            errorDiv.innerText = 'Size name is required.';
            return;
        }

        let formData = new FormData();
        formData.append('name', name);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("admin.advertisement-types.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Add to select box
                let select = document.getElementById('advertisement_type_id');
                let option = document.createElement('option');
                option.value = data.type.id;
                option.text = data.type.name;
                option.selected = true;
                select.appendChild(option);
                
                // Close modal
                $('#addTypeModal').modal('hide');
                input.value = '';
                input.classList.remove('is-invalid');
            } else {
                input.classList.add('is-invalid');
                errorDiv.innerText = data.message || 'Error adding size.';
            }
        })
        .catch(error => {
            input.classList.add('is-invalid');
            errorDiv.innerText = 'This size may already exist or there was a server error.';
        });
    });
</script>
@endpush
