@extends('admin.layouts.app')

@section('title', 'Add Event Category')
@section('header', 'Add Event Category')

@section('content')
<div class="card shadow border-0 col-md-6">
    <div class="card-header bg-white">
        <h5 class="mb-0 font-weight-bold">Category Details</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.event-categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Category Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" checked>
                    <label class="custom-control-label" for="status">Active Status</label>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Save Category</button>
            <a href="{{ route('admin.event-categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
