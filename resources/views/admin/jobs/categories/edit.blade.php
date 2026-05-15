@extends('admin.layouts.app')

@section('title', 'Edit Job Category')
@section('header', 'Edit Job Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0 font-weight-bold">Update Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.job-categories.update', $jobCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $jobCategory->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" {{ $jobCategory->status ? 'checked' : '' }}>
                            <label class="custom-control-label" for="status">Active Status</label>
                        </div>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="{{ route('admin.job-categories.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
