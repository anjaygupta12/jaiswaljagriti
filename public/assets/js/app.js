import './bootstrap';

// Initialize Swiper when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Hero Swiper
    if (document.querySelector('.heroSwiper')) {
        const swiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: { delay: 4000, disableOnInteraction: false },
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        });
    }

    // Member Login Button
    const memberBtn = document.getElementById('memberLoginBtn');
    if (memberBtn) {
        memberBtn.addEventListener('click', function(e) {
            e.preventDefault();
            alert('Member Login / Registration portal coming soon.');
        });
    }

    // Donate Button
    const donateBtn = document.getElementById('donateBtn');
    if (donateBtn) {
        donateBtn.addEventListener('click', function(e) {
            e.preventDefault();
            alert('Thank you for your support! Donation page will open shortly.');
        });
    }

    // Active nav link handling
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
