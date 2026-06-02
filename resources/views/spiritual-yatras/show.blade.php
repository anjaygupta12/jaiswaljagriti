@extends('layouts.app')

@section('title', $yatra->title . ' - Jaiswal Jagriti')

@section('content')
<div class="container-custom py-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                @if($yatra->thumbnail)
                    <img src="{{ asset($yatra->thumbnail) }}" alt="{{ $yatra->title }}" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
                @endif
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-3">{{ $yatra->title }}</h1>
                    
                    <div class="d-flex align-items-center mb-4 text-muted small">
                        <span class="mr-3"><i class="fas fa-calendar-alt mr-1"></i> {{ $yatra->created_at->format('M d, Y') }}</span>
                    </div>

                    @if($yatra->short_description)
                        <div class="lead mb-4 font-italic text-muted" style="border-left: 4px solid #f80136; padding-left: 15px;">
                            {{ $yatra->short_description }}
                        </div>
                    @endif

                    <div class="content-body" style="line-height: 1.8;">
                        {!! $yatra->content !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Other Yatras</h4>
                    
                    @forelse($relatedYatras as $related)
                        <div class="mb-4">
                            <a href="{{ route('spiritual-yatras.show', $related->slug) }}" class="text-decoration-none">
                                <div class="row align-items-center g-2">
                                    <div class="col-4">
                                        <img src="{{ $related->thumbnail ? asset($related->thumbnail) : asset('assets/images/placeholder.jpg') }}" alt="{{ $related->title }}" class="img-fluid rounded" style="height: 60px; width: 100%; object-fit: cover;">
                                    </div>
                                    <div class="col-8">
                                        <h6 class="text-dark mb-1 fw-bold" style="font-size: 14px;">{{ Str::limit($related->title, 40) }}</h6>
                                        <small class="text-muted">{{ $related->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-muted small">No other yatras found.</p>
                    @endforelse

                    <div class="mt-4">
                        <a href="{{ route('spiritual-yatras.index') }}" class="btn btn-outline-primary btn-block rounded-pill">View All Yatras</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
