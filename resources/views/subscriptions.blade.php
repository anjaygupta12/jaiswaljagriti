@extends('layouts.app')

@section('content')
<div class="container-custom py-5">
    <div class="section-title text-center mb-5">
        <h2>{{ $title }}</h2>
        <p class="mt-3 text-white">Choose the best plan that fits your needs to support the community.</p>
    </div>

    <div class="bg-white p-5 rounded shadow-sm" style="border-radius: 20px;">
        <div class="row justify-content-center">
            @forelse($plans as $plan)
                @include('partials.plan_card', ['plan' => $plan])
            @empty
            <div class="col-12 text-center py-3">
                <h5 class="text-muted">No plans available in this category at the moment.</h5>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
