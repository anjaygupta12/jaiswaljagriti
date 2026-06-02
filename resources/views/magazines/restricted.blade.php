@extends('layouts.app')

@section('title', ($isOld ?? false) ? 'Login Required | Jaiswal Jagriti' : 'Subscription Required | Jaiswal Jagriti')

@section('content')
<div class="container-custom py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            <div class="card border-0 shadow-sm p-5" style="border-radius:20px;">
                <div class="mb-4">
                    @if($isOld ?? false)
                        <i class="fas fa-sign-in-alt fa-5x text-info"></i>
                    @else
                        <i class="fas fa-lock fa-5x" style="color:#F80136;"></i>
                    @endif
                </div>

                @if($isOld ?? false)
                    <h3 class="font-weight-bold text-dark mb-3">Login Required</h3>
                    <p class="text-muted mb-4">
                        The magazine <strong>{{ $magazine->title }}</strong> is free to read, but you must be logged in to access it.
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-info btn-lg rounded-pill px-5">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login to Continue
                    </a>
                @else
                    <h3 class="font-weight-bold text-dark mb-3">This is a Premium Magazine</h3>
                    <p class="text-muted mb-2">
                        <strong>{{ $magazine->title }}</strong> is only available to active <strong>Patrika</strong> subscribers.
                    </p>
                    <p class="text-muted mb-4">
                        Subscribe today and get unlimited access to all premium magazines and content!
                    </p>

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-5 mb-3">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login to Continue
                        </a>
                        <br>
                        <a href="{{ route('patrika-subscription') }}" class="btn btn-outline-primary rounded-pill px-5 mt-2">
                            View Subscription Plans
                        </a>
                    @else
                        <a href="{{ route('patrika-subscription') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                            <i class="fas fa-crown mr-2"></i> Subscribe Now
                        </a>
                    @endguest
                @endif

                <div class="mt-4">
                    <a href="{{ route('magazines.index') }}" class="text-muted small">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Magazines
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
