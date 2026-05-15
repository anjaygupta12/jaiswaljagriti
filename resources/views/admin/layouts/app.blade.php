<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title', 'Admin Panel')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            overflow-x: hidden;
            background: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }

        .sidebar .nav-link {
            color: #c2c7d0;
            padding: 12px 20px;
            font-size: 15px;
        }

        .sidebar .nav-link:hover {
            background: #495057;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #007bff;
            color: #fff;
        }

        .content-area {
            padding: 20px;
        }

        .card-box {
            border-radius: 10px;
        }

        /* CMS Submenu */
        #cmsMenu .nav-link {
            color: #adb5bd;
            padding: 8px 12px;
            border-left: 2px solid #495057;
            margin-left: 8px;
        }
        #cmsMenu .nav-link:hover,
        #cmsMenu .nav-link.active {
            color: #fff;
            border-left-color: #007bff;
            background: transparent;
        }
        a[data-toggle="collapse"][aria-expanded="true"] .cms-arrow {
            transform: rotate(180deg);
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 p-0 sidebar">

                <div class="text-center text-white py-4 border-bottom">
                    <h4 class="font-weight-bold mb-0">
                        Admin Panel
                    </h4>
                </div>

                <ul class="nav flex-column mt-3">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') ?? '#' }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.plans.index') }}" class="nav-link {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                            <i class="fas fa-list-alt mr-2"></i>
                            Subscription Plans
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.subscriptions.index') }}" class="nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            Subscription Requests
                        </a>
                    </li>

                    <!-- CMS Section -->
                    <li class="nav-item">
                        <a href="#cmsMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.magazines.*') || request()->routeIs('admin.job-*') || request()->routeIs('admin.events.*') ? 'active' : '' }}"
                            data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.magazines.*') || request()->routeIs('admin.job-*') || request()->routeIs('admin.events.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-layer-group mr-2"></i> CMS</span>
                            <i class="fas fa-angle-down cms-arrow" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.magazines.*') || request()->routeIs('admin.job-*') || request()->routeIs('admin.events.*') ? 'show' : '' }}" id="cmsMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.banners.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-images mr-2"></i> Home Banners
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.magazines.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.magazines.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-book mr-2"></i> Magazines
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.job-categories.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.job-categories.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-list mr-2"></i> Job Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.job-listings.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.job-listings.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-briefcase mr-2"></i> Job Listings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.event-categories.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.event-categories.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-tags mr-2"></i> Event Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.events.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-calendar-star mr-2"></i> Upcoming Events
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.comments.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-comments mr-2"></i> Manage Comments
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Orders
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-wallet mr-2"></i>
                            Transactions
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Reports
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cog mr-2"></i>
                            Settings
                        </a>
                    </li>

                    <li class="nav-item mt-4">
                        <form action="{{ route('logout') ?? '#' }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="btn btn-danger btn-block rounded-0">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>

            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-0">

                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-3">

                    <h4 class="mb-0 font-weight-bold">
                        @yield('header', 'Dashboard')
                    </h4>

                    <div class="ml-auto">
                        <span class="font-weight-bold text-primary">
                            Welcome Admin
                        </span>
                    </div>

                </nav>

                <!-- Content -->
                <div class="content-area">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>

            </div>

        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    @stack('scripts')

</body>

</html>
