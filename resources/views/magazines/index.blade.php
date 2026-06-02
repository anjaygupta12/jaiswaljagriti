@extends('layouts.app')

@section('title', 'Magazines | Jaiswal Jagriti')

@section('content')
<div class="container-custom py-5">
    <div class="section-title text-center mb-5">
        <h2>Magazines</h2>
        <p class="mt-3 text-white">Explore our collection of Jaiswal Jagriti magazines and publications.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-warning text-center">{{ session('error') }}</div>
    @endif

    @if($magazines->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">No magazines available at the moment.</h4>
        </div>
    @else
        <div class="row">
            @foreach($magazines as $mag)
            @php
                $oldFromDate = \App\Models\Setting::getVal('magazine_old_from_date');
                $isOld = $oldFromDate && $mag->magazine_date && ($mag->magazine_date < $oldFromDate);
                
                $hasAccess = false;
                if ($isOld) {
                    $hasAccess = auth()->check();
                } else {
                    $hasAccess = auth()->check() && (auth()->user()->is_admin == 1 || auth()->user()->subscriptions()
                        ->where('status', 'approved')
                        ->whereHas('plan', function($q) {
                            $q->where('type', 'patrika');
                        })
                        ->exists());
                }
            @endphp
            <div class="col-lg-3 col-md-6 mb-4">

                @if($hasAccess)
                    {{-- FREE or SUBSCRIBED: Open PDF in new tab --}}
                    <a href="{{ route('magazines.show', $mag->slug) }}" target="_blank" class="text-decoration-none">
                @else
                    {{-- LOCKED: show restricted page --}}
                    <a href="{{ route('magazines.show', $mag->slug) }}" class="text-decoration-none">
                @endif

                    <div class="card h-100 border-0 shadow-sm magazine-card" style="border-radius:14px; overflow:hidden; transition: transform 0.3s ease;">

                        <!-- Thumbnail -->
                        <div style="position:relative; height:450px; overflow:hidden;">
                            @if($mag->thumbnail)
                                <img src="{{ asset($mag->thumbnail) }}" alt="{{ $mag->title }}" class="mag-image"
                                    style="width:100%; height:100%; object-fit:cover; transform: scale(1.1); transition: transform 0.5s ease;">
                            @else
                                <div style="width:100%; height:100%; background: linear-gradient(135deg, #F80136, #ff6b6b); display:flex; align-items:center; justify-content:center; transform: scale(1.1); transition: transform 0.5s ease;" class="mag-image">
                                    <i class="fas fa-book fa-5x text-white"></i>
                                </div>
                            @endif

                            <!-- Access Badge -->
                            <div style="position:absolute; top:10px; right:10px;">
                                @if($hasAccess)
                                    <span class="badge badge-success" style="font-size:11px; padding: 5px 10px; border-radius:20px;">
                                        <i class="fas fa-unlock mr-1"></i> Read Now
                                    </span>
                                @else
                                    @if($isOld)
                                        <span class="badge badge-info" style="font-size:11px; padding: 5px 10px; border-radius:20px;">
                                            <i class="fas fa-sign-in-alt mr-1"></i> Login Required
                                        </span>
                                    @else
                                        <span class="badge badge-warning text-dark" style="font-size:11px; padding: 5px 10px; border-radius:20px;">
                                            <i class="fas fa-lock mr-1"></i> Premium
                                        </span>
                                    @endif
                                @endif
                            </div>

                            <!-- Hover Overlay -->
                            <div class="pdf-overlay" style="position:absolute; inset:0; background:rgba(0,0,0,0.45); display:flex; align-items:center; justify-content:center; opacity:0; transition:opacity 0.3s;">
                                @if($hasAccess)
                                    <i class="fas fa-file-pdf fa-3x text-white"></i>
                                @else
                                    <div class="text-center text-white">
                                        @if($isOld)
                                            <i class="fas fa-sign-in-alt fa-2x mb-2"></i>
                                            <p class="mb-0 small font-weight-bold">Login to Read</p>
                                        @else
                                            <i class="fas fa-lock fa-2x mb-2"></i>
                                            <p class="mb-0 small font-weight-bold">Subscribe to Read</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body p-3 text-center">
                            <h2 class="font-weight-bold text-dark mb-1" style="font-size:18px; line-height:1.4;">{{ $mag->title }}</h2>
                            @if($mag->magazine_date)
                                <p class="text-muted small mb-0">{{ \Carbon\Carbon::parse($mag->magazine_date)->format('M Y') }}</p>
                            @endif
                        </div>

                    </div>
                </a>

            </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .magazine-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    .magazine-card:hover .pdf-overlay {
        opacity: 1;
    }
</style>
@endsection
