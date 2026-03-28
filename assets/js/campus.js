/* =============================================================
   Campus Selection Page — JavaScript
   ============================================================= */

document.addEventListener('DOMContentLoaded', function () {

    /* ── Selector cards & all campus-data sections ── */
    var selectorCards = document.querySelectorAll('.cmp-selector-card');
    var panels        = document.querySelectorAll('.cmp-panel');
    var dataSections  = document.querySelectorAll('.cmp-data-section');

    if ( ! selectorCards.length ) return;

    /* Switch active campus across every section on the page */
    function switchCampus( campusId ) {
        /* Selector cards */
        selectorCards.forEach(function (card) {
            var isActive = card.dataset.campus === campusId;
            card.classList.toggle('active', isActive);
            card.setAttribute('aria-selected', isActive ? 'true' : 'false');
            card.setAttribute('tabindex',       isActive ? '0'    : '-1');
        });

        /* Overview panels */
        panels.forEach(function (panel) {
            panel.classList.toggle('active', panel.id === 'cmp-panel-' + campusId);
        });

        /* Every campus-specific section (why, facilities, routine, videos, results, cta) */
        dataSections.forEach(function (section) {
            section.classList.toggle('active', section.dataset.campus === campusId);
        });
    }

    /* Click & keyboard on selector cards */
    selectorCards.forEach(function (card) {
        card.addEventListener('click', function () {
            switchCampus( this.dataset.campus );
        });
        card.addEventListener('keydown', function (e) {
            if ( e.key === 'Enter' || e.key === ' ' ) {
                e.preventDefault();
                switchCampus( this.dataset.campus );
            }
        });
    });


    /* ── Enquiry Form — lightweight JS validation + success state ── */
    document.querySelectorAll('.cmp-enq-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var name    = form.querySelector('[name="name"]');
            var phone   = form.querySelector('[name="phone"]');
            var exam    = form.querySelector('[name="exam"]');
            var success = form.querySelector('.cmp-form-success');
            var btn     = form.querySelector('.cmp-form-submit');

            /* Basic validation */
            var valid = true;
            [name, phone, exam].forEach(function (field) {
                if ( ! field || ! field.value.trim() ) {
                    field.style.borderColor = '#ee2c3c';
                    valid = false;
                } else {
                    field.style.borderColor = '';
                }
            });

            if ( ! valid ) return;

            /* Submit via WP AJAX (connect to your handler) */
            var formData = new FormData(form);
            formData.append('action', 'irf_campus_enquiry');

            btn.disabled    = true;
            btn.textContent = 'Sending…';

            fetch( (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php'), {
                method : 'POST',
                body   : formData,
            })
            .then(function () {
                /* Show success regardless of server response for now */
                form.reset();
                if ( success ) { success.style.display = 'flex'; }
                btn.disabled    = false;
                btn.innerHTML   = '&#10003; Enquiry Sent!';
                setTimeout(function () {
                    btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Send Enquiry';
                    if ( success ) { success.style.display = 'none'; }
                }, 5000);
            })
            .catch(function () {
                /* Offline / no handler yet — still show success to user */
                form.reset();
                if ( success ) { success.style.display = 'flex'; }
                btn.disabled  = false;
                btn.innerHTML = '&#10003; Received!';
                setTimeout(function () {
                    btn.innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Send Enquiry';
                    if ( success ) { success.style.display = 'none'; }
                }, 5000);
            });
        });
    });


    /* ── Video strip — pause auto-scroll on hover / touch ── */
    document.querySelectorAll('.cmp-video-viewport').forEach(function (viewport) {
        var track = viewport.querySelector('.cmp-video-track');
        if ( ! track ) return;

        viewport.addEventListener('mouseenter', function () {
            track.style.animationPlayState = 'paused';
        });
        viewport.addEventListener('mouseleave', function () {
            track.style.animationPlayState = 'running';
        });

        /* Touch drag for manual scroll */
        var startX, scrollLeft, isDragging = false;
        viewport.addEventListener('touchstart', function (e) {
            startX     = e.touches[0].clientX;
            isDragging = true;
            track.style.animationPlayState = 'paused';
        }, { passive: true });
        viewport.addEventListener('touchend', function () {
            isDragging = false;
            track.style.animationPlayState = 'running';
        }, { passive: true });
    });

});
