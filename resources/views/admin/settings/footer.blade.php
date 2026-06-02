@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
            <h5 class="mb-0 fw-bold text-primary">Footer Settings</h5>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.footer.update') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- About Section -->
                    <div class="col-md-6">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">About Section</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Title</label>
                                    <input type="text" name="footer_about_title" class="form-control" value="{{ $settings['footer_about_title'] }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Text</label>
                                    <textarea name="footer_about_text" class="form-control" rows="3" required>{{ $settings['footer_about_text'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details -->
                    <div class="col-md-6">
                        <div class="card bg-light border-0 h-100">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Contact Details</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <input type="text" name="footer_address" class="form-control" value="{{ $settings['footer_address'] }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Phone</label>
                                    <input type="text" name="footer_phone" class="form-control" value="{{ $settings['footer_phone'] }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="footer_email" class="form-control" value="{{ $settings['footer_email'] }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="col-md-12">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Social Links</h6>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Facebook</label>
                                        <input type="text" name="footer_facebook" class="form-control" value="{{ $settings['footer_facebook'] }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Instagram</label>
                                        <input type="text" name="footer_instagram" class="form-control" value="{{ $settings['footer_instagram'] }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">YouTube</label>
                                        <input type="text" name="footer_youtube" class="form-control" value="{{ $settings['footer_youtube'] }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Twitter</label>
                                        <input type="text" name="footer_twitter" class="form-control" value="{{ $settings['footer_twitter'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="col-md-12">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Copyright Text</h6>
                                <div>
                                    <input type="text" name="footer_copyright" class="form-control" value="{{ $settings['footer_copyright'] }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
