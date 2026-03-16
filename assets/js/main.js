document.addEventListener('DOMContentLoaded', function () {

    // ==========================================
    // Header: scroll effect
    // ==========================================
    const header = document.getElementById('site-header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.classList.toggle('scrolled', window.scrollY > 50);
        });
    }

    // ==========================================
    // Mobile navigation
    // ==========================================
    const hamburger = document.getElementById('hamburger');
    const navMenu   = document.getElementById('nav-menu');
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('open');
        });
        navMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                hamburger.classList.remove('active');
                navMenu.classList.remove('open');
            });
        });
    }

    // ==========================================
    // Typing animation
    // ==========================================
    var typedEl = document.querySelector('.typed-text');
    if (typedEl) {
        var words      = ['SSC CGL', 'IBPS PO', 'RBI Grade B', 'SI Exam', 'Constable', 'RRB NTPC', 'SBI PO'];
        var wordIndex  = 0;
        var charIndex  = 0;
        var deleting   = false;

        function type() {
            var current = words[wordIndex];
            if (deleting) {
                typedEl.textContent = current.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typedEl.textContent = current.substring(0, charIndex + 1);
                charIndex++;
            }
            if (!deleting && charIndex === current.length) {
                deleting = true;
                setTimeout(type, 1800);
                return;
            }
            if (deleting && charIndex === 0) {
                deleting   = false;
                wordIndex  = (wordIndex + 1) % words.length;
            }
            setTimeout(type, deleting ? 70 : 110);
        }
        type();
    }

    // ==========================================
    // Counter animation
    // ==========================================
    function animateCounter(el) {
        var target   = parseInt(el.dataset.target, 10);
        if (isNaN(target) || target <= 0) return;
        var suffix   = el.dataset.suffix || '';
        var duration = 1800;
        var steps    = 60;
        var increment= target / steps;
        var current  = 0;
        var timer    = setInterval(function () {
            current += increment;
            if (current >= target) {
                el.textContent = target.toLocaleString() + suffix;
                clearInterval(timer);
            } else {
                el.textContent = Math.floor(current).toLocaleString() + suffix;
            }
        }, duration / steps);
    }

    // ==========================================
    // Intersection Observer: scroll reveal + counters
    // ==========================================
    var revealEls  = document.querySelectorAll('.reveal');
    var counterEls = document.querySelectorAll('.counter');

    if ('IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(function (el) { revealObserver.observe(el); });

        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        counterEls.forEach(function (el) { counterObserver.observe(el); });
    } else {
        // Fallback for older browsers
        revealEls.forEach(function (el) { el.classList.add('visible'); });
        counterEls.forEach(function (el) { animateCounter(el); });
    }

    // ==========================================
    // Success Stories Carousel
    // ==========================================
    var track         = document.getElementById('storiesTrack');
    var prevBtn       = document.querySelector('.carousel-btn.prev');
    var nextBtn       = document.querySelector('.carousel-btn.next');
    var dotsContainer = document.getElementById('carouselDots');

    if (track && prevBtn && nextBtn && dotsContainer) {
        var cards    = track.querySelectorAll('.story-card');
        var cardW    = 360 + 24; // min-width + gap
        var visible  = Math.max(1, Math.floor(track.parentElement.offsetWidth / cardW));
        var maxIndex = Math.max(0, cards.length - visible);
        var current  = 0;
        var autoTimer;

        // Generate dots dynamically based on actual card count
        var dots = [];
        for (var d = 0; d <= maxIndex; d++) {
            var dot = document.createElement('div');
            dot.className = 'carousel-dot' + (d === 0 ? ' active' : '');
            dotsContainer.appendChild(dot);
            dots.push(dot);
        }

        function goTo(index) {
            current = Math.max(0, Math.min(index, maxIndex));
            track.style.transform = 'translateX(-' + (current * cardW) + 'px)';
            dots.forEach(function (dot, i) {
                dot.classList.toggle('active', i === current);
            });
        }

        function startAuto() {
            autoTimer = setInterval(function () {
                goTo(current >= maxIndex ? 0 : current + 1);
            }, 4000);
        }

        nextBtn.addEventListener('click', function () { clearInterval(autoTimer); goTo(current + 1); startAuto(); });
        prevBtn.addEventListener('click', function () { clearInterval(autoTimer); goTo(current - 1); startAuto(); });
        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () { clearInterval(autoTimer); goTo(i); startAuto(); });
        });

        startAuto();
    }

    // ==========================================
    // Smooth scroll for anchor links
    // ==========================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                var offset = header ? header.offsetHeight + 16 : 80;
                var top    = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

});
