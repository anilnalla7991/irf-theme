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
        var cardW    = 352 + 24; // card width + gap
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
    // Announcement Ticker — Tab Switching + Color
    // ==========================================
    var tickerTabs   = document.querySelectorAll('.irf-tab');
    var tickerTracks = document.querySelectorAll('.irf-ticker-track');
    var tickerBar    = document.getElementById('irfTickerBar');
    var PX_PER_SEC   = 130;

    /* Clone the inner element off-screen to get its true natural width,
       regardless of whether its parent track is visible or not.        */
    function measureInnerWidth(inner) {
        var clone = inner.cloneNode(true);
        clone.style.cssText = [
            'position:fixed', 'top:-9999px', 'left:0',
            'display:inline-flex', 'white-space:nowrap',
            'visibility:hidden', 'animation:none', 'transform:none',
            'pointer-events:none', 'z-index:-1'
        ].join(';');
        document.body.appendChild(clone);
        var w = clone.offsetWidth;
        document.body.removeChild(clone);
        return w;
    }

    function applySpeed(inner) {
        var w = measureInnerWidth(inner);
        if (w <= 0) return;
        var dur = Math.max(6, Math.round((w / 2) / PX_PER_SEC));
        inner.style.animationDuration = dur + 's';
    }

    /* Set speed for every track at load time */
    tickerTracks.forEach(function (track) {
        var inner = track.querySelector('.irf-ticker-inner');
        if (inner) applySpeed(inner);
    });

    tickerTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = this.getAttribute('data-tab');
            var color  = this.getAttribute('data-color');

            tickerTabs.forEach(function (t) { t.classList.remove('active'); });
            this.classList.add('active');

            if (tickerBar && color) tickerBar.style.background = color;

            tickerTracks.forEach(function (tr) { tr.classList.remove('active'); });
            var activeTrack = document.querySelector('.irf-ticker-track[data-track="' + target + '"]');
            if (activeTrack) {
                activeTrack.classList.add('active');
                var inner = activeTrack.querySelector('.irf-ticker-inner');
                if (inner) {
                    /* Preserve the calculated duration across animation restart */
                    var dur = inner.style.animationDuration;
                    inner.style.animationName = 'none';
                    inner.offsetHeight;
                    inner.style.animationName = '';
                    if (dur) inner.style.animationDuration = dur;
                }
            }
        });
    });

    // ==========================================
    // Banner Slider — Dynamic Effect System
    // Effects cycle: fade → slide → zoom-in → cube-h →
    //                fragment → zoom-out → cube-v → (repeat)
    // direction-aware: slide reverses to slide-rev on prev nav
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
        var INTERVAL       = 5000;

        // Ordered effect sequence — light effects interspersed with heavy ones.
        // Cycles automatically for any number of slides; never two heavy effects
        // back-to-back in a 7-slot period.
        var FX_SEQUENCE = ['fade', 'slide', 'zoom-in', 'cube-h', 'fragment', 'zoom-out', 'cube-v'];

        // Per-effect animation duration (ms)
        var FX_DURATION = {
            'fade':      650,
            'slide':     750,
            'slide-rev': 750,
            'zoom-in':   700,
            'zoom-out':  700,
            'cube-h':    900,
            'cube-v':    900,
            'fragment':  1100
        };

        // Effects that also animate the leaving slide via CSS
        var BFX_HAS_LEAVE = { 'slide': true, 'slide-rev': true, 'cube-h': true, 'cube-v': true };

        // Assign effect to every slide upfront — scalable, no PHP changes needed
        bannerSlides.forEach(function (slide, i) {
            slide.setAttribute('data-fx', FX_SEQUENCE[i % FX_SEQUENCE.length]);
        });

        function bannerPad(n) { return (n < 10 ? '0' : '') + n; }

        function bannerUpdateUI(index) {
            bannerDots.forEach(function (d, i) { d.classList.toggle('active', i === index); });
            if (bannerCurrNum) bannerCurrNum.textContent = bannerPad(index + 1);
        }

        function bannerStartProgress() {
            if (!bannerProgress) return;
            bannerProgress.style.transition = 'none';
            bannerProgress.style.width = '0%';
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    bannerProgress.style.transition = 'width ' + INTERVAL + 'ms linear';
                    bannerProgress.style.width = '100%';
                });
            });
        }

        // Fragment effect: JS-built tile grid that exits staggered, revealing
        // the entering slide piece-by-piece. No blur, transform+opacity only.
        function bannerRunFragment(currEl, nextEl, duration, onDone) {
            var COLS = 5, ROWS = 4, TILES = COLS * ROWS;
            var slider   = document.getElementById('bannerSlider');
            var overlay  = document.createElement('div');
            overlay.className = 'banner-frag-overlay';

            // Shuffle exit order so tiles disappear in random positions
            var order = [];
            for (var i = 0; i < TILES; i++) order.push(i);
            for (var i = order.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var tmp = order[i]; order[i] = order[j]; order[j] = tmp;
            }

            // Spread tile exits over 72% of the total duration
            var spreadMs = duration * 0.72;
            var tileMs   = Math.round(duration * 0.32);
            var stepMs   = TILES > 1 ? spreadMs / (TILES - 1) : 0;

            for (var idx = 0; idx < TILES; idx++) {
                var r    = Math.floor(idx / COLS);
                var c    = idx % COLS;
                var tile = document.createElement('div');
                tile.className = 'banner-frag-tile';
                tile.style.left            = (c / COLS * 100) + '%';
                tile.style.top             = (r / ROWS * 100) + '%';
                tile.style.width           = (100 / COLS) + '%';
                tile.style.height          = (100 / ROWS) + '%';
                tile.style.transitionDuration = tileMs + 'ms, ' + tileMs + 'ms';
                tile.style.transitionDelay    = Math.round(order[idx] * stepMs) + 'ms';
                overlay.appendChild(tile);
            }

            // Overlay sits above both slides; swap active immediately (tiles cover the cut)
            slider.appendChild(overlay);
            nextEl.classList.add('active');
            currEl.classList.remove('active');

            // Trigger tile exit on next paint
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    var tiles = overlay.querySelectorAll('.banner-frag-tile');
                    for (var i = 0; i < tiles.length; i++) {
                        tiles[i].style.opacity   = '0';
                        tiles[i].style.transform = 'scale(0.85)';
                    }
                });
            });

            setTimeout(function () {
                if (overlay.parentNode) overlay.parentNode.removeChild(overlay);
                onDone();
            }, duration);
        }

        function bannerGoTo(next, isPrev) {
            if (bannerBusy || bannerTotal < 2) return;
            var target = (next + bannerTotal) % bannerTotal;
            if (target === bannerCurrent) return;
            bannerBusy = true;

            var curr   = bannerSlides[bannerCurrent];
            var nextEl = bannerSlides[target];
            var fx     = nextEl.getAttribute('data-fx') || 'fade';

            // Reverse slide direction when going backwards
            if (isPrev && fx === 'slide') fx = 'slide-rev';

            var duration = FX_DURATION[fx] || 750;

            // Fragment is handled entirely in JS
            if (fx === 'fragment') {
                bannerRunFragment(curr, nextEl, duration, function () {
                    bannerCurrent = target;
                    bannerUpdateUI(bannerCurrent);
                    bannerBusy = false;
                });
                return;
            }

            // CSS-animation approach for all other effects
            nextEl.style.opacity = '1';
            nextEl.classList.add('entering-' + fx);
            if (BFX_HAS_LEAVE[fx]) curr.classList.add('leaving-' + fx);

            setTimeout(function () {
                nextEl.classList.remove('entering-' + fx);
                nextEl.style.opacity = '';
                nextEl.classList.add('active');
                curr.classList.remove('active');
                curr.classList.remove('leaving-' + fx);
                bannerCurrent = target;
                bannerUpdateUI(bannerCurrent);
                bannerBusy = false;
            }, duration);
        }

        function bannerStartAuto() {
            clearInterval(bannerTimer);
            bannerStartProgress();
            bannerTimer = setInterval(function () {
                bannerGoTo(bannerCurrent + 1, false);
                bannerStartProgress();
            }, INTERVAL);
        }

        bannerUpdateUI(0);

        if (bannerPrev) {
            bannerPrev.addEventListener('click', function () {
                clearInterval(bannerTimer);
                bannerGoTo(bannerCurrent - 1, true);
                bannerStartAuto();
            });
        }
        if (bannerNext) {
            bannerNext.addEventListener('click', function () {
                clearInterval(bannerTimer);
                bannerGoTo(bannerCurrent + 1, false);
                bannerStartAuto();
            });
        }
        bannerDots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                clearInterval(bannerTimer);
                bannerGoTo(i, i < bannerCurrent);
                bannerStartAuto();
            });
        });

        if (bannerTotal > 1) bannerStartAuto();
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
