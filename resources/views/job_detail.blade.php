@extends('layouts.app')

@section('title', $jobListing->title . ' | Job Listing')

@section('content')
<div id="primary" class="content-area normal">
    <div id="contentHolder">
        <div class="post-detail-style2">
            <div class="container">
                <div class="entry-thumbnail-area show-image" style="background: linear-gradient(135deg, #e36108 0%, #ff8c42 100%); padding: 60px 40px; border-radius: 18px; color: white; margin-top: 30px; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(227, 97, 8, 0.15);">
                    <div style="position: absolute; right: -50px; bottom: -50px; opacity: 0.1; font-size: 250px; color: white; pointer-events: none;">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="entry-header" style="position: relative; z-index: 2;">
                        <span class="entry-categories style-1">
                            <a href="{{ route('job') }}">
                                <span class="category-style" style="background: rgba(0,0,0,0.35); border: 1px solid rgba(255,255,255,0.4); color: white; padding: 6px 16px; border-radius: 50px; font-weight: 600; font-size: 13px; text-transform: uppercase;">
                                    {{ $jobListing->category->name }}
                                </span>
                            </a>
                        </span>
                        <h1 class="entry-title title-size-xl text-white" style="font-weight: 800; margin-top: 20px; font-size: 2.5rem; line-height: 1.3;">{{ $jobListing->title }}</h1>
                        <ul class="entry-meta text-white-50" style="list-style: none; padding: 0; display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; font-size: 14px;">
                            <li><i class="far fa-calendar-alt mr-2"></i> Posted: {{ $jobListing->created_at->format('F d, Y') }}</li>
                            <li><i class="fas fa-check-circle mr-2"></i> Verified Official Listing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <main id="main" class="site-main">
                        <div class="rt-sidebar-space">
                            <div class="card border-0" style="border-radius: 18px; overflow: hidden; background: white; box-shadow: 0 8px 30px rgba(0,0,0,0.05);">
                                <div class="card-body p-4 p-md-5">
                                    <h3 class="font-weight-bold mb-4" style="color: #e36108; border-bottom: 2px solid #f6f6f6; padding-bottom: 15px; font-size: 24px;">Job Details & Requirements</h3>
                                    <div class="entry-content rt-single-content" style="font-size: 16px; line-height: 1.9; color: #444;">
                                        {!! $jobListing->description !!}
                                    </div>
                                    
                                    <div class="mt-5 pt-3 d-flex flex-wrap align-items-center" style="border-top: 1px solid #f6f6f6; gap: 15px;">
                                        <a href="{{ route('job') }}" class="btn px-4 py-2 text-secondary bg-light mr-3" style="border: 1px solid #ddd; border-radius: 50px; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.3s;">
                                            <i class="fas fa-arrow-left mr-2"></i> Back to Job Listings
                                        </a>
                                        
                                        @if($jobListing->show_apply)
                                            <a href="{{ route('job.apply', $jobListing) }}" class="btn px-5 py-2 text-white" style="background: #e36108; border: none; border-radius: 50px; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.3s; box-shadow: 0 4px 15px rgba(227, 97, 8, 0.2);">
                                                <i class="fas fa-paper-plane mr-2"></i> Apply Now
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <aside class="sidebar-widget-area">
                        <div class="widget rt-post-box bg-white p-4" style="border-radius: 18px; box-shadow: 0 8px 30px rgba(0,0,0,0.05);">
                            <div class="section-title mb-4" style="border-left: 3px solid #e36108; padding-left: 12px;">
                                <h4 class="widgettitle font-weight-bold" style="margin: 0; color: #222; font-size: 18px;">Related Opportunities</h4>
                            </div>
                            <div class="box-style-2">
                                @forelse($relatedJobs as $rJob)
                                <div class="mb-3 p-3 bg-light rounded" style="border-radius: 12px; transition: 0.3s; border-left: 4px solid #e36108;">
                                    <h6 class="mb-1" style="font-weight: 600; line-height: 1.4; font-size: 14px;">
                                        <a href="{{ $rJob->isInternal() ? route('job.show', $rJob->id) : ($rJob->link ?: '#') }}" {{ !$rJob->isInternal() && $rJob->link ? 'target="_blank"' : '' }} class="text-dark hover-orange">
                                            {{ $rJob->title }}
                                        </a>
                                    </h6>
                                    <span class="badge badge-light text-muted p-0" style="font-size: 11px;">
                                        {{ $rJob->category->name }}
                                    </span>
                                </div>
                                @empty
                                <div class="text-muted small py-2">No other jobs in this category.</div>
                                @endforelse
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .hover-orange:hover {
        color: #e36108 !important;
        text-decoration: none;
    }
    .rt-single-content p {
        margin-bottom: 1.5rem;
    }
    .rt-single-content ul, .rt-single-content ol {
        margin-bottom: 1.5rem;
        padding-left: 20px;
    }
    .rt-single-content li {
        margin-bottom: 0.5rem;
    }
</style>
@endpush
