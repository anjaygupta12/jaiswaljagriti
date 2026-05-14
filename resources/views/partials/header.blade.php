<div class="main-header">
    <div class="container-custom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; ">
        <div class="logo-area">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo-1024x212.jpg') }}" alt="Jaiswal Jagriti Logo">
            </a>
        </div>
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('login') }}" class="btn-primary" id="memberLoginBtn">
                <i class="fas fa-user-plus"></i> Members Login / Registration
            </a>
            <a href="{{ route('donate') }}" class="btn-primary" style="background: #0F172A;" id="donateBtn">
                <i class="fas fa-donate"></i> Donate Now
            </a>
        </div>
    </div>
</div>
