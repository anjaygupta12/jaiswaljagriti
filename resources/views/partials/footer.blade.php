    <footer class="footer">
        <div class="container-custom">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px;">
                <div>
                    <h4 style="color:white;">{{ \App\Models\Setting::getVal('footer_about_title', 'Jaiswal Jagriti') }}</h4>
                    <p>{{ \App\Models\Setting::getVal('footer_about_text', 'Uniting the community since 1994, fostering culture, careers, and social harmony.') }}</p>
                </div>
                <div>
                    <h4 style="color:white;">Quick Links</h4>
                    <ul style="list-style:none; line-height: 2;">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="#">Matrimonial</a></li>
                        <li><a href="{{ route('job') }}">Job Listings</a></li>
                        <li><a href="{{ route('events') }}">Events</a></li>
                        <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="color:white;">Get in Touch</h4>
                    <p><i class="fas fa-map-marker-alt"></i> {{ \App\Models\Setting::getVal('footer_address', 'Delhi, India') }}</p>
                    <p><i class="fas fa-phone"></i> {{ \App\Models\Setting::getVal('footer_phone', '+91 9868105658') }}</p>
                    <p><i class="fas fa-envelope"></i> {{ \App\Models\Setting::getVal('footer_email', 'jaiswaljagrity@gmail.com') }}</p>
                </div>
                <div>
                    <h4 style="color:white;">Follow Us On</h4>
                    <div style="display: flex; gap: 20px;">
                        <a href="{{ \App\Models\Setting::getVal('footer_facebook', '#') }}" target="_blank" style="color: inherit;"><i class="fab fa-facebook-f fa-lg" style="cursor:pointer;"></i></a>
                        <a href="{{ \App\Models\Setting::getVal('footer_instagram', '#') }}" target="_blank" style="color: inherit;"><i class="fab fa-instagram fa-lg" style="cursor:pointer;"></i></a>
                        <a href="{{ \App\Models\Setting::getVal('footer_youtube', '#') }}" target="_blank" style="color: inherit;"><i class="fab fa-youtube fa-lg" style="cursor:pointer;"></i></a>
                        <a href="{{ \App\Models\Setting::getVal('footer_twitter', '#') }}" target="_blank" style="color: inherit;"><i class="fab fa-twitter fa-lg" style="cursor:pointer;"></i></a>
                    </div>
                </div>
            </div>
            <hr style="margin: 30px 0; border-color:#374151;">
            <p style="text-align: center;">{{ \App\Models\Setting::getVal('footer_copyright', '© 2025 Jaiswal Jagriti Family. All rights reserved. | Together for Progress') }}</p>
        </div>
    </footer>
