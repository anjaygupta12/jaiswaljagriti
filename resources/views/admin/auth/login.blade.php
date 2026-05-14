<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>JaiswalJagriti | Admin Login</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6 col-lg-5">

                <div class="card shadow border-0 rounded-lg">

                    <!-- Header -->
                    <div class="card-header bg-dark text-white text-center py-4 rounded-top">
                        <i class="fas fa-user-shield fa-3x mb-2"></i>

                        <h3 class="mb-0 font-weight-bold">
                            JaiswalJagriti
                        </h3>

                        <p class="mb-0 small text-white-50">
                            Admin Login Portal
                        </p>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">

                        <!-- Session Error -->
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ session('error') }}

                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <ul class="mb-0 pl-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf

                            <input type="hidden" name="is_admin" value="1">

                            <!-- Email -->
                            <div class="form-group">

                                <label for="email" class="font-weight-bold">
                                    <i class="fas fa-envelope mr-1"></i>
                                    Email
                                </label>

                                <input type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email"
                                    autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror

                                <small class="form-text text-muted">
                                    Enter your registered admin email
                                </small>
                            </div>

                            <!-- Password -->
                            <div class="form-group">

                                <label for="password" class="font-weight-bold">
                                    <i class="fas fa-lock mr-1"></i>
                                    Password
                                </label>

                                <input type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter Password"
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback d-block">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <!-- Remember -->
                            <div class="form-group d-flex justify-content-between align-items-center">

                                <div class="custom-control custom-checkbox">

                                    <input type="checkbox" class="custom-control-input" id="rememberCheck"
                                        name="remember">

                                    <label class="custom-control-label" for="rememberCheck">
                                        Remember Me
                                    </label>
                                </div>

                                <a href="#" class="text-primary small">
                                    <i class="fas fa-question-circle"></i>
                                    Forgot Password?
                                </a>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold">

                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </button>

                        </form>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-center text-muted py-3 bg-light">
                        © {{ date('Y') }} JaiswalJagriti. All Rights Reserved.
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
