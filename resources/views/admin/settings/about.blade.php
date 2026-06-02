@extends('admin.layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">About Page Settings</h6>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('admin.about-page.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h5 class="mb-3">1. Top Banner Section</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_banner_title">Banner Title</label>
                                <input type="text" class="form-control" id="about_banner_title" name="about_banner_title" value="{{ old('about_banner_title', $settings['about_banner_title'] ?? '') }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="about_banner">Banner Image (Leave blank to keep current)</label>
                                <input type="file" class="form-control-file" id="about_banner" name="about_banner" accept="image/*">
                                @if(isset($settings['about_banner']) && $settings['about_banner'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_banner']) }}" alt="Banner" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">2. First Gallery Section</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_gallery_1_img1">Image 1</label>
                                <input type="file" class="form-control-file" id="about_gallery_1_img1" name="about_gallery_1_img1" accept="image/*">
                                @if(isset($settings['about_gallery_1_img1']) && $settings['about_gallery_1_img1'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_gallery_1_img1']) }}" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_gallery_1_img2">Image 2</label>
                                <input type="file" class="form-control-file" id="about_gallery_1_img2" name="about_gallery_1_img2" accept="image/*">
                                @if(isset($settings['about_gallery_1_img2']) && $settings['about_gallery_1_img2'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_gallery_1_img2']) }}" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">3. Second Gallery Section</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_gallery_2_img1">Image 1</label>
                                <input type="file" class="form-control-file" id="about_gallery_2_img1" name="about_gallery_2_img1" accept="image/*">
                                @if(isset($settings['about_gallery_2_img1']) && $settings['about_gallery_2_img1'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_gallery_2_img1']) }}" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_gallery_2_img2">Image 2</label>
                                <input type="file" class="form-control-file" id="about_gallery_2_img2" name="about_gallery_2_img2" accept="image/*">
                                @if(isset($settings['about_gallery_2_img2']) && $settings['about_gallery_2_img2'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_gallery_2_img2']) }}" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">4. Matchmaking Section (Bringing Hearts Together)</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_hearts_title1">Title 1</label>
                                <input type="text" class="form-control" id="about_hearts_title1" name="about_hearts_title1" value="{{ old('about_hearts_title1', $settings['about_hearts_title1'] ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_hearts_title2">Title 2</label>
                                <input type="text" class="form-control" id="about_hearts_title2" name="about_hearts_title2" value="{{ old('about_hearts_title2', $settings['about_hearts_title2'] ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="about_hearts_text">Description Text</label>
                                <textarea class="form-control" id="about_hearts_text" name="about_hearts_text" rows="4">{{ old('about_hearts_text', $settings['about_hearts_text'] ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label for="about_hearts_features">Features List (Bullet Points)</label>
                                <textarea class="form-control summernote" id="about_hearts_features" name="about_hearts_features" rows="5">{{ old('about_hearts_features', $settings['about_hearts_features'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">5. Empowering Community Section</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_empowering_title">Empowering Title</label>
                                <input type="text" class="form-control" id="about_empowering_title" name="about_empowering_title" value="{{ old('about_empowering_title', $settings['about_empowering_title'] ?? '') }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="about_empowering_text">Empowering Text</label>
                                <textarea class="form-control" id="about_empowering_text" name="about_empowering_text" rows="5">{{ old('about_empowering_text', $settings['about_empowering_text'] ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="about_opportunities_title">Opportunities Title</label>
                                <input type="text" class="form-control" id="about_opportunities_title" name="about_opportunities_title" value="{{ old('about_opportunities_title', $settings['about_opportunities_title'] ?? '') }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="about_opportunities_text">Opportunities Text</label>
                                <textarea class="form-control" id="about_opportunities_text" name="about_opportunities_text" rows="5">{{ old('about_opportunities_text', $settings['about_opportunities_text'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">6. Third Gallery Section (Bottom)</h5>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="about_gallery_3_img1">Image 1</label>
                                <input type="file" class="form-control-file" id="about_gallery_3_img1" name="about_gallery_3_img1" accept="image/*">
                                @if(isset($settings['about_gallery_3_img1']) && $settings['about_gallery_3_img1'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_gallery_3_img1']) }}" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="about_gallery_3_img2">Image 2</label>
                                <input type="file" class="form-control-file" id="about_gallery_3_img2" name="about_gallery_3_img2" accept="image/*">
                                @if(isset($settings['about_gallery_3_img2']) && $settings['about_gallery_3_img2'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_gallery_3_img2']) }}" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="about_gallery_3_img3">Image 3</label>
                                <input type="file" class="form-control-file" id="about_gallery_3_img3" name="about_gallery_3_img3" accept="image/*">
                                @if(isset($settings['about_gallery_3_img3']) && $settings['about_gallery_3_img3'])
                                    <div class="mt-2">
                                        <img src="{{ asset($settings['about_gallery_3_img3']) }}" style="max-height: 100px;" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-4">Update About Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endpush
