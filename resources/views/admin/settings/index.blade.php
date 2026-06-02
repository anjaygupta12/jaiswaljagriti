@extends('admin.layouts.app')

@section('title', 'Magazine Settings')
@section('header', 'Magazine Settings')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold">
            <i class="fas fa-cogs mr-2 text-success"></i> Magazine Settings
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

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div class="card mb-4 border-left-warning">
                <div class="card-header bg-light font-weight-bold">
                    <i class="fas fa-calendar-alt mr-2 text-warning"></i> Access Date Cutoff Configuration
                </div>
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label for="magazine_old_from_date" class="font-weight-bold">Old Magazines From Date</label>
                        <input type="date" class="form-control col-md-5" id="magazine_old_from_date"
                               name="magazine_old_from_date"
                               value="{{ old('magazine_old_from_date', $settings['magazine_old_from_date']) }}">
                        <small class="form-text text-muted mt-2">
                            <ul class="pl-3 mb-0">
                                <li>Magazines published <strong>before</strong> this date are considered <strong>Old Magazines</strong>.</li>
                                <li>Old magazines are accessible for <strong>free to all logged-in users</strong> — no subscription needed, but login is mandatory.</li>
                                <li>Magazines published <strong>on or after</strong> this date are restricted to users with an active <strong>Patrika Subscription</strong>.</li>
                                <li>If left empty, all magazines require a Patrika subscription.</li>
                            </ul>
                        </small>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i> Save Settings
            </button>
        </form>

    </div>
</div>
@endsection
