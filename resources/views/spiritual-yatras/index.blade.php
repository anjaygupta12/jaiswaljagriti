@extends('layouts.app')

@section('title', 'Spiritual Yatras - Jaiswal Jagriti')

@section('content')
<div class="container-custom" style="padding-top: 40px; padding-bottom: 60px;">
    <div class="section-title text-center mb-5">
        <h2>Spiritual Yatras</h2>
        <p class="text-muted mt-2">Explore our spiritual journeys and community yatras.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
        @forelse($yatras as $yatra)
            <div class="card-mini" style="background:#fff; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); padding-bottom:15px; overflow:hidden;">
                <img src="{{ $yatra->thumbnail ? asset($yatra->thumbnail) : asset('assets/images/placeholder.jpg') }}"
                    style="width:100%; height: 200px; object-fit:cover;" alt="{{ $yatra->title }}">
                <div style="padding: 15px;">
                    <h4 style="margin: 0 0 10px 0; color:#333;">{{ $yatra->title }}</h4>
                    <p style="color:#666; font-size:14px;">{{ Str::limit($yatra->short_description, 80) }}</p>
                    <a href="{{ route('spiritual-yatras.show', $yatra->slug) }}" style="color:#f80136; font-weight:bold; text-decoration:none;">Read More →</a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No spiritual yatras found at the moment.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $yatras->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
