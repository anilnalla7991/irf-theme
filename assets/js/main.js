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
        var wordsAttr  = typedEl.getAttribute('data-words');
        var words;
        try { words = wordsAttr ? JSON.parse(wordsAttr) : null; } catch (e) { words = null; }
        words = words && words.length ? words : ['SSC CGL', 'IBPS PO', 'RBI Grade B', 'SI Exam', 'Constable', 'RRB NTPC', 'SBI PO'];
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
    // Announcement Ticker — Tab Switching
    // ==========================================
    var tickerTabs   = document.querySelectorAll('.irf-tab');
    var tickerTracks = document.querySelectorAll('.irf-ticker-track');

    tickerTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = this.getAttribute('data-tab');
            tickerTabs.forEach(function (t) { t.classList.remove('active'); });
            tickerTracks.forEach(function (tr) { tr.classList.remove('active'); });
            this.classList.add('active');
            var activeTrack = document.querySelector('.irf-ticker-track[data-track="' + target + '"]');
            if (activeTrack) activeTrack.classList.add('active');
        });
    });

    // ==========================================
    // Banner Slider — Cinematic Clip-Path Reveal
    // ==========================================
    var bannerTrack = document.getElementById('bannerTrack');
    if (bannerTrack) {
        var bannerSlides   = Array.prototype.slice.call(bannerTrack.querySelectorAll('.banner-slide'));
        var bannerDots     = Array.prototype.slice.call(document.querySelectorAll('.banner-dot'));
        var bannerPrev     = document.querySelector('.banner-prev');
        var bannerNext     = document.querySelector('.banner-next');
        var bannerProgress = document.getElementById('bannerProgress');
        var bannerCurrNum  = document.getElementById('bannerCurrNum');
        var bannerCurrent  = 0;
        var bannerTotal    = bannerSlides.length;
        var bannerBusy     = false;
        var bannerTimer;
        var progressTimer;
        var INTERVAL       = 5000; // ms between slides
        var TRANSITION     = 900;  // ms clip-path animation duration

        function bannerPad(n) {
            return (n < 10 ? '0' : '') + n;
        }

        function bannerUpdateUI(index) {
            bannerDots.forEach(function (d, i) { d.classList.toggle('active', i === index); });
            if (bannerCurrNum) { bannerCurrNum.textContent = bannerPad(index + 1); }
        }

        function bannerStartProgress() {
            if (!bannerProgress) return;
            clearInterval(progressTimer);
            bannerProgress.style.transition = 'none';
            bannerProgress.style.width = '0%';
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    bannerProgress.style.transition = 'width ' + INTERVAL + 'ms linear';
                    bannerProgress.style.width = '100%';
                });
            });
        }

        function bannerGoTo(next) {
            if (bannerBusy || bannerTotal < 2) return;
            var target = (next + bannerTotal) % bannerTotal;
            if (target === bannerCurrent) return;
            bannerBusy = true;

            var curr   = bannerSlides[bannerCurrent];
            var nextEl = bannerSlides[target];

            // Bring next slide in with .entering (triggers clip-path animation)
            nextEl.classList.add('entering');
            // After animation completes, swap active
            setTimeout(function () {
                curr.classList.remove('active');
                nextEl.classList.remove('entering');
                nextEl.classList.add('active');
                bannerCurrent = target;
                bannerUpdateUI(bannerCurrent);
                bannerBusy = false;
            }, TRANSITION);
        }

        function bannerStartAuto() {
            clearInterval(bannerTimer);
            bannerStartProgress();
            bannerTimer = setInterval(function () {
                bannerGoTo(bannerCurrent + 1);
                bannerStartProgress();
            }, INTERVAL);
        }

        // Init UI
        bannerUpdateUI(0);

        if (bannerPrev) {
            bannerPrev.addEventListener('click', function () {
                clearInterval(bannerTimer);
                bannerGoTo(bannerCurrent - 1);
                bannerStartAuto();
            });
        }
        if (bannerNext) {
            bannerNext.addEventListener('click', function () {
                clearInterval(bannerTimer);
                bannerGoTo(bannerCurrent + 1);
                bannerStartAuto();
            });
        }
        bannerDots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                clearInterval(bannerTimer);
                bannerGoTo(i);
                bannerStartAuto();
            });
        });

        if (bannerTotal > 1) { bannerStartAuto(); }
    }

    // ==========================================
    // Hero: SVG Ring fill trigger
    // ==========================================
    var ringFill = document.getElementById('ringFill');
    if (ringFill) {
        // Inject SVG gradient defs
        var svg = ringFill.closest('svg');
        if (svg) {
            var defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
            defs.innerHTML = '<linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" style="stop-color:#fe0000"/><stop offset="100%" style="stop-color:#ff6b35"/></linearGradient>';
            svg.insertBefore(defs, svg.firstChild);
        }
        setTimeout(function () { ringFill.classList.add('animated'); }, 400);
    }

    // ==========================================
    // Hero Right: mouse parallax tilt
    // ==========================================
    var heroVisual = document.getElementById('heroVisual');
    if (heroVisual && window.innerWidth > 900) {
        document.addEventListener('mousemove', function (e) {
            var cx = window.innerWidth  / 2;
            var cy = window.innerHeight / 2;
            var dx = (e.clientX - cx) / cx;
            var dy = (e.clientY - cy) / cy;
            heroVisual.style.transform = 'perspective(1200px) rotateY(' + (dx * 6) + 'deg) rotateX(' + (-dy * 4) + 'deg)';
        });
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
