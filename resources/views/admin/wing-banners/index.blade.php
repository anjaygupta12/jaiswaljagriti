@extends('admin.layouts.app')

@section('title', 'Manage Wing Banners')
@section('header', 'Wing Banners')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Wing Header Banners</h6>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Upload a high-quality, wide aspect ratio image (e.g., 1920x500 pixels) for each wing's header background.</p>

                <form action="{{ route('admin.wing-banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <!-- Youth Wing Banner -->
                        <div class="col-md-4 mb-4">
                            <div class="border rounded p-3 text-center h-100">
                                <h5 class="font-weight-bold mb-3">Youth Wing Banner</h5>
                                @php
                                    $youthBanner = \App\Models\Setting::getVal('youth_wing_banner', 'assets/images/IMG-20250826-WA0008.jpg');
                                    $youthTitle = \App\Models\Setting::getVal('youth_wing_title', 'Youth’s Wing');
                                @endphp
                                <img src="{{ asset($youthBanner) }}" alt="Youth Wing" class="img-fluid rounded mb-3" style="height: 120px; object-fit: cover; width: 100%;">
                                
                                <div class="form-group mb-3 text-left">
                                    <label for="youth_wing_title" class="small font-weight-bold">Banner Title</label>
                                    <input type="text" name="youth_wing_title" id="youth_wing_title" class="form-control" value="{{ $youthTitle }}">
                                </div>
                                <div class="form-group mb-0 text-left">
                                    <label for="youth_wing_banner" class="small font-weight-bold">Upload New Banner</label>
                                    <input type="file" name="youth_wing_banner" id="youth_wing_banner" class="form-control-file border p-1 rounded" accept="image/*">
                                    @error('youth_wing_banner') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Executive Body Banner -->
                        <div class="col-md-4 mb-4">
                            <div class="border rounded p-3 text-center h-100">
                                <h5 class="font-weight-bold mb-3">Executive Body Banner</h5>
                                @php
                                    $executiveBanner = \App\Models\Setting::getVal('executive_body_banner', 'assets/images/IMG-20250826-WA0008.jpg');
                                    $executiveTitle = \App\Models\Setting::getVal('executive_body_title', 'National Executive Body');
                                @endphp
                                <img src="{{ asset($executiveBanner) }}" alt="Executive Body" class="img-fluid rounded mb-3" style="height: 120px; object-fit: cover; width: 100%;">
                                
                                <div class="form-group mb-3 text-left">
                                    <label for="executive_body_title" class="small font-weight-bold">Banner Title</label>
                                    <input type="text" name="executive_body_title" id="executive_body_title" class="form-control" value="{{ $executiveTitle }}">
                                </div>
                                <div class="form-group mb-0 text-left">
                                    <label for="executive_body_banner" class="small font-weight-bold">Upload New Banner</label>
                                    <input type="file" name="executive_body_banner" id="executive_body_banner" class="form-control-file border p-1 rounded" accept="image/*">
                                    @error('executive_body_banner') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Women's Wing Banner -->
                        <div class="col-md-4 mb-4">
                            <div class="border rounded p-3 text-center h-100">
                                <h5 class="font-weight-bold mb-3">Women's Wing Banner</h5>
                                @php
                                    $womensBanner = \App\Models\Setting::getVal('womens_wing_banner', 'assets/images/IMG-20250826-WA0008.jpg');
                                    $womensTitle = \App\Models\Setting::getVal('womens_wing_title', 'Women\'s Wing');
                                @endphp
                                <img src="{{ asset($womensBanner) }}" alt="Women's Wing" class="img-fluid rounded mb-3" style="height: 120px; object-fit: cover; width: 100%;">
                                
                                <div class="form-group mb-3 text-left">
                                    <label for="womens_wing_title" class="small font-weight-bold">Banner Title</label>
                                    <input type="text" name="womens_wing_title" id="womens_wing_title" class="form-control" value="{{ $womensTitle }}">
                                </div>
                                <div class="form-group mb-0 text-left">
                                    <label for="womens_wing_banner" class="small font-weight-bold">Upload New Banner</label>
                                    <input type="file" name="womens_wing_banner" id="womens_wing_banner" class="form-control-file border p-1 rounded" accept="image/*">
                                    @error('womens_wing_banner') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-3">
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save mr-2"></i> Save Banners</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
