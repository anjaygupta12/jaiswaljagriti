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
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: calc(16.6667% + 30px); /* col-md-2 equivalent + 30px */
            max-width: calc(16.6667% + 30px);
            flex: 0 0 calc(16.6667% + 30px);
            overflow-y: auto;
            overflow-x: hidden;
            background: #343a40;
            z-index: 100;
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

        /* push content right to account for fixed sidebar */
        .main-content-col {
            margin-left: calc(16.6667% + 30px);
            width: calc(83.3333% - 30px);
            max-width: calc(83.3333% - 30px);
            flex: 0 0 calc(83.3333% - 30px);
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
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>

                    <!-- Home -->
                    <li class="nav-item">
                        <a href="#homeMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.home-welcome.*') || request()->routeIs('admin.home-magazine.*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.home-welcome.*') || request()->routeIs('admin.home-magazine.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-home mr-2"></i> Home</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.banners.*') || request()->routeIs('admin.home-welcome.*') || request()->routeIs('admin.home-magazine.*') ? 'show' : '' }}" id="homeMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.banners.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-images mr-2"></i>Banner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.home-welcome.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.home-welcome.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-heading mr-2"></i> Welcome Section
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.home-magazine.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.home-magazine.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-book-open mr-2"></i> Magazine Section
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Subscription -->
                    <li class="nav-item">
                        <a href="#subscriptionMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.plans.*') || request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.plans.*') || request()->routeIs('admin.subscriptions.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-file-invoice-dollar mr-2"></i> Subscription</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.plans.*') || request()->routeIs('admin.subscriptions.*') ? 'show' : '' }}" id="subscriptionMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.plans.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-list-alt mr-2"></i> Subscription Plane
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.subscriptions.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-bell mr-2"></i> Subscription Request
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Magazines -->
                    <li class="nav-item">
                        <a href="#magazineMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.magazines.*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.magazines.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-book mr-2"></i> Magazines</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.magazines.*') ? 'show' : '' }}" id="magazineMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.magazines.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.magazines.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-book-open mr-2"></i> Magazines
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Jobs -->
                    <li class="nav-item">
                        <a href="#jobsMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.job-*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.job-*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-briefcase mr-2"></i> Jobs</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.job-*') ? 'show' : '' }}" id="jobsMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.job-categories.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.job-categories.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-list mr-2"></i> Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.job-listings.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.job-listings.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-briefcase mr-2"></i> Listing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.job-applications.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.job-applications.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-file-signature mr-2"></i> Applied
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Events -->
                    <li class="nav-item">
                        <a href="#eventsMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.event-categories.*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.events.*') || request()->routeIs('admin.event-categories.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-calendar-star mr-2"></i> Events</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.event-categories.*') ? 'show' : '' }}" id="eventsMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.events.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-calendar mr-2"></i> Upcoming Events
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.events-banner.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.events-banner.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-image mr-2"></i> Banner
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Spiritual Yatras -->
                    <li class="nav-item">
                        <a href="#yatrasMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.spiritual-yatras.*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.spiritual-yatras.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-om mr-2"></i> Spiritual Yatra</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.spiritual-yatras.*') ? 'show' : '' }}" id="yatrasMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.spiritual-yatras.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.spiritual-yatras.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-list mr-2"></i> All Yatras
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Advertisement -->
                    <li class="nav-item">
                        <a href="#advMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.advertisement-patrikas.*') || request()->routeIs('admin.advertisement-normals.*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.advertisement-patrikas.*') || request()->routeIs('admin.advertisement-normals.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-ad mr-2"></i> Advertisement</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.advertisement-patrikas.*') || request()->routeIs('admin.advertisement-normals.*') ? 'show' : '' }}" id="advMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.advertisement-patrikas.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.advertisement-patrikas.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-newspaper mr-2"></i> Patrika
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.advertisement-normals.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.advertisement-normals.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-image mr-2"></i> Normal
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#cmsMenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.contact-page.*') || request()->routeIs('admin.about-page.*') || request()->routeIs('admin.galleries.*') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.contact-page.*') || request()->routeIs('admin.about-page.*') || request()->routeIs('admin.galleries.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-file-alt mr-2"></i> CMS</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.contact-page.*') || request()->routeIs('admin.about-page.*') || request()->routeIs('admin.galleries.*') ? 'show' : '' }}" id="cmsMenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.about-page.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.about-page.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-info-circle mr-2"></i> About Page
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.contact-page.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.contact-page.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-address-book mr-2"></i> Contact Page
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.galleries.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-images mr-2"></i> Gallery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.footer.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.footer.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-shoe-prints mr-2"></i> Footer
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Wing Management -->
                    <li class="nav-item">
                        <a href="#wingSubmenu" class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.wing-members.*') || request()->routeIs('admin.wing-banners.*') ? 'active' : '' }}"
                            data-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.wing-members.*') || request()->routeIs('admin.wing-banners.*') ? 'true' : 'false' }}">
                            <span><i class="fas fa-users mr-2"></i> Wing Management</span>
                            <i class="fas fa-angle-down" style="transition: transform 0.2s;"></i>
                        </a>
                        <ul class="collapse nav flex-column pl-3 {{ request()->routeIs('admin.wing-members.*') || request()->routeIs('admin.wing-banners.*') ? 'show' : '' }}" id="wingSubmenu">
                            <li class="nav-item">
                                <a href="{{ route('admin.wing-members.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.wing-members.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-user-friends mr-2"></i> Member
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.wing-banners.index') }}" class="nav-link py-2 {{ request()->routeIs('admin.wing-banners.*') ? 'active' : '' }}" style="font-size: 14px;">
                                    <i class="fas fa-image mr-2"></i> Banner
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') && !request()->routeIs('admin.contact-page.*') ? 'active' : '' }}">
                            <i class="fas fa-cogs mr-2"></i>
                            Settings
                        </a>
                    </li>

                    <li class="nav-item mt-4">
                        <form action="{{ route('logout') ?? '#' }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block rounded-0">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>

            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-0 main-content-col">

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
