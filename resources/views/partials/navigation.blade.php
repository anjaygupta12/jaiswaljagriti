    <!-- Main Header -->
    <div class="main-header">
        <div class="container-custom"
            style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div class="logo-area">
                <img src="{{ asset('assets/images/logo-1024x212.jpg') }}" alt="Jaiswal Jagriti Logo"
                    onerror="this.src='https://placehold.co/1024x212?text=Jaiswal+Jagriti'">
            </div>
            <div style="display: flex; gap: 15px;">
                @guest
                    <a href="{{ route('login') }}" class="btn-primary" id="memberLoginBtn"><i class="fas fa-user-plus"></i> Members Login / Registration</a>
                @else
                    <a href="{{ route('profile.index') }}" class="btn-primary" id="memberLoginBtn"><i class="fas fa-user"></i> My Profile</a>
                @endguest
                <a href="#" class="btn-primary" style="background: #0F172A;" id="donateBtn"><i
                        class="fas fa-donate"></i> Donate Now</a>
            </div>
        </div>
    </div>

    <!-- Navigation Bar -->
    <div class="navbar">
        <div class="container-custom" style="background-color:#e36108!important;" >
            <ul class="nav-links">
                <li><a href="/" class="active">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="">Matrimonial</a></li>
                <li><a href="{{ route('job') }}">Job & Careers</a></li>
                <li><a href="{{ route('youth-wing') }}">Youth's Wing</a></li>
                <li><a href="{{ route('executive-body') }}">Executive Body</a></li>
                <li><a href="{{ route('womens-wing') }}">Women's Wing</a></li>
                <li><a href="{{ route('events') }}">Events</a></li>
                <li class="nav-dropdown">
                    <a href="#" style="cursor: default;">Subscription <i class="fas fa-caret-down ml-1"></i></a>
                    <ul class="nav-dropdown-menu">
                        <li><a href="{{ route('patrika-subscription') }}">Patrika Subscription</a></li>
                        <li><a href="{{ route('advertisement-subscription') }}">Advertisement Subscription</a></li>
                    </ul>
                </li>
                <li><a href="#">Media Gallery</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>

    <style>
        .nav-dropdown { position: relative; }
        .nav-dropdown-menu { display: none; position: absolute; top: 100%; left: 0; background: #fff; box-shadow: 0 8px 16px rgba(0,0,0,0.1); padding: 10px 0; margin: 0; list-style: none; min-width: 250px; z-index: 1000; border-radius: 4px; border: 1px solid #eee; }
        .nav-dropdown:hover .nav-dropdown-menu { display: block; }
        .nav-dropdown-menu li { display: block; margin: 0; padding: 0; }
        .nav-dropdown-menu li a { color: #333 !important; display: block; padding: 12px 20px !important; text-decoration: none; font-weight: normal; font-size: 15px; border-bottom: 1px solid #f9f9f9; text-transform: none; }
        .nav-dropdown-menu li:last-child a { border-bottom: none; }
        .nav-dropdown-menu li a:hover { background: #fff4ed; color: #e36108 !important; padding-left: 25px !important; transition: all 0.3s ease; }
    </style>
