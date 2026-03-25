/* =============================================================
   Contact Page — JavaScript
   ============================================================= */

document.addEventListener('DOMContentLoaded', function () {

    /* ----------------------------------------------------------
       Sticky bar: reveal after scrolling past the banner
    ---------------------------------------------------------- */
    var stickyBar = document.getElementById('ctcStickyBar');
    if (stickyBar) {
        window.addEventListener('scroll', function () {
            stickyBar.classList.toggle('visible', window.scrollY > 420);
        }, { passive: true });
    }


    /* ----------------------------------------------------------
       Contact form
    ---------------------------------------------------------- */
    var form       = document.getElementById('ctcInquiryForm');
    if (!form) return;

    var submitBtn  = document.getElementById('ctcSubmitBtn');
    var submitText = submitBtn.querySelector('.ctc-submit-text');
    var spinner    = submitBtn.querySelector('.ctc-submit-spinner');
    var successEl  = document.getElementById('ctcSuccess');
    var errorEl    = document.getElementById('ctcError');

    /* Helpers */
    function clearErrors() {
        form.querySelectorAll('.ctc-error').forEach(function (el) {
            el.textContent = '';
        });
        form.querySelectorAll('.ctc-input, .ctc-select, .ctc-textarea').forEach(function (el) {
            el.classList.remove('ctc-input-err');
        });
    }

    function markError(fieldId, errId, msg) {
        var field = document.getElementById(fieldId);
        var err   = document.getElementById(errId);
        if (field) field.classList.add('ctc-input-err');
        if (err)   err.textContent = msg;
    }

    /* Validate required fields */
    function validate() {
        clearErrors();
        var valid = true;

        var name  = document.getElementById('ctc_name').value.trim();
        var phone = document.getElementById('ctc_phone').value.trim();
        var email = document.getElementById('ctc_email').value.trim();

        if (!name) {
            markError('ctc_name', 'err_name', 'Full name is required.');
            valid = false;
        } else if (name.length < 2) {
            markError('ctc_name', 'err_name', 'Please enter a valid name.');
            valid = false;
        }

        if (!phone) {
            markError('ctc_phone', 'err_phone', 'Phone number is required.');
            valid = false;
        } else if (!/^[+]?[\d\s\-()]{8,16}$/.test(phone)) {
            markError('ctc_phone', 'err_phone', 'Enter a valid phone number.');
            valid = false;
        }

        if (!email) {
            markError('ctc_email', 'err_email', 'Email address is required.');
            valid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            markError('ctc_email', 'err_email', 'Enter a valid email address.');
            valid = false;
        }

        return valid;
    }

    /* Live clear on blur once user corrects a field */
    ['ctc_name', 'ctc_phone', 'ctc_email'].forEach(function (id) {
        var el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('input', function () {
            if (this.value.trim()) {
                this.classList.remove('ctc-input-err');
                var suffix = id.replace('ctc_', '');
                var errEl  = document.getElementById('err_' + suffix);
                if (errEl) errEl.textContent = '';
            }
        });
    });

    /* Form submit */
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (!validate()) {
            /* Scroll to first error */
            var firstErr = form.querySelector('.ctc-input-err');
            if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        /* UI: loading state */
        submitText.textContent = 'Sending…';
        spinner.style.display  = 'inline-flex';
        submitBtn.disabled     = true;
        successEl.style.display = 'none';
        errorEl.style.display   = 'none';

        var fd = new FormData();
        fd.append('action',  'irf_contact_form');
        fd.append('nonce',   (typeof irfContact !== 'undefined') ? irfContact.nonce : '');
        fd.append('name',    document.getElementById('ctc_name').value.trim());
        fd.append('phone',   document.getElementById('ctc_phone').value.trim());
        fd.append('email',   document.getElementById('ctc_email').value.trim());
        fd.append('course',  document.getElementById('ctc_course').value);
        fd.append('branch',  document.getElementById('ctc_branch').value);
        fd.append('message', document.getElementById('ctc_message').value.trim());

        var ajaxUrl = (typeof irfContact !== 'undefined') ? irfContact.ajaxurl : '/wp-admin/admin-ajax.php';

        fetch(ajaxUrl, {
            method: 'POST',
            body: fd,
            credentials: 'same-origin',
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            if (data.success) {
                form.reset();
                successEl.style.display = 'flex';
                successEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                errorEl.style.display = 'flex';
            }
        })
        .catch(function () {
            errorEl.style.display = 'flex';
        })
        .finally(function () {
            submitText.textContent = 'Submit Inquiry';
            spinner.style.display  = 'none';
            submitBtn.disabled     = false;
        });
    });

});
