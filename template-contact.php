<?php
/**
 * Template Name: Contact Us
 *
 * @package irf-theme
 */
get_header();

/* ── ACF site-level contact info ── */
$site_phone = irf_opt('site_phone', '+91 9533 200 400');
$site_email = irf_opt('site_email', 'queries@iace.co.in');
$site_wa    = preg_replace('/[^0-9]/', '', $site_phone); // digits only for WA link

/* ── Social links ── */
$f_yt = irf_opt('social_youtube',   '');
$f_ig = irf_opt('social_instagram', '');
$f_fb = irf_opt('social_facebook',  '');

/* ── Main offices ── */
$offices = array(
    array(
        'badge'   => 'Head Office',
        'name'    => 'IRF – IACE Ameerpet',
        'address' => 'Mythrivanam, Beside Harsha Mess Lane, 3rd Floor, Opp. Raghava Super Speciality Hospital, Ameerpet, Hyderabad – 500038',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
        'dark'    => true,
    ),
    array(
        'badge'   => 'Corporate Office',
        'name'    => 'IRF – IACE Corporate',
        'address' => 'Plot No. 47, Road No. 3, Banjara Hills, Hyderabad – 500034, Telangana',
        'email'   => 'corporate@iace.co.in',
        'phone'   => '+91 9533 300 400',
        'dark'    => false,
    ),
);

/* ── 9 Branches ── */
$branches = array(
    array(
        'name'    => 'Ameerpet',
        'address' => 'Mythrivanam, Beside Harsha Mess Lane, 3rd Floor, Opp. Raghava Super Speciality Hospital, Hyderabad – 500038',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
    ),
    array(
        'name'    => 'Dilsukhnagar',
        'address' => '17-109, 2nd Floor, Chaitanyapuri, Dilsukhnagar, Hyderabad',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
    ),
    array(
        'name'    => 'KPHB',
        'address' => 'Plot No: 80 & 81 Survey No.166, 4th Floor, Usha Mullapudi Rd, A.S.Raju Nagar, Kukatpally, Hyderabad',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
    ),
    array(
        'name'    => 'Nellore',
        'address' => '16-1-650, Trunk Road, Opp. Princes Hotel, Beside 4 Town Police Station, VRC Centre, Nellore, Andhra Pradesh – 524001',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9700 077 433',
    ),
    array(
        'name'    => 'Vizag',
        'address' => '47-10-24/25, 2nd Floor, 2nd Lane, Sagar Nagar, Dwaraka Nagar, Visakhapatnam',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
    ),
    array(
        'name'    => 'Vijayawada',
        'address' => '1st Floor, Above SBI Bank Besant Road Branch, Opp. BIG Bazar, Governor Peta, Vijayawada, Andhra Pradesh – 520002',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
    ),
    array(
        'name'    => 'Rajamundry',
        'address' => '1st Floor, Radha Enclave, Somalamma Temple Road, Rajahmundry',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9704 955 833',
    ),
    array(
        'name'    => 'Tirupati',
        'address' => '1st Floor, Balaji Complex, Prakasam Rd, Balaji Colony, Tirupati',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
    ),
    array(
        'name'    => 'Anantapur',
        'address' => '3rd Floor, ANR Centre, 10/315, Subhash Road, above Reliance Digital, near Clock Tower, Gulzarpet, Anantapur, Andhra Pradesh – 515001',
        'email'   => 'queries@iace.co.in',
        'phone'   => '+91 9533 200 400',
    ),
);

/* ── Inline SVG icons (reused multiple times) ── */
$ico_pin   = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>';
$ico_mail  = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>';
$ico_phone = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.62 4.42 2 2 0 0 1 3.59 2.24h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.16 6.16l.92-.92a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';
$ico_pin_lg   = '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>';
$ico_mail_lg  = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>';
$ico_phone_lg = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.62 4.42 2 2 0 0 1 3.59 2.24h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.16 6.16l.92-.92a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';
$ico_clock    = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
$ico_send     = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';
?>


<!-- ============================================================
     PAGE BANNER
     ============================================================ -->
<section class="page-banner ctc-banner">
    <div class="page-banner-bg"></div>
    <div class="ctc-banner-circle ctc-circle-1"></div>
    <div class="ctc-banner-circle ctc-circle-2"></div>
    <div class="container">
        <div class="page-banner-content">
            <span class="section-tag">Get In Touch</span>
            <h1 class="page-banner-title">Contact Us</h1>
            <p class="page-banner-subtitle">We're here to help you. Reach out to our nearest branch or send us your query.</p>
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="breadcrumb-sep">&#8250;</span>
                <span>Contact Us</span>
            </nav>
        </div>
    </div>
</section>


<!-- ============================================================
     KEY OFFICES
     ============================================================ -->
<section class="section ctc-offices-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Important Offices</span>
            <h2 class="section-title">Our Main Locations</h2>
            <p class="section-subtitle">Visit us at our head office or corporate center for admissions, queries, and direct support.</p>
        </div>
        <div class="ctc-offices-grid">
            <?php foreach ($offices as $off) : ?>
            <div class="ctc-office-card<?php echo $off['dark'] ? ' ctc-office-card--dark' : ''; ?>">
                <div class="ctc-office-badge"><?php echo esc_html($off['badge']); ?></div>
                <div class="ctc-office-icon"><?php echo $ico_pin_lg; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
                <h3 class="ctc-office-name"><?php echo esc_html($off['name']); ?></h3>
                <p class="ctc-office-address"><?php echo esc_html($off['address']); ?></p>
                <div class="ctc-office-details">
                    <a href="mailto:<?php echo esc_attr($off['email']); ?>" class="ctc-office-detail">
                        <?php echo $ico_mail_lg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                        <?php echo esc_html($off['email']); ?>
                    </a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $off['phone'])); ?>" class="ctc-office-detail">
                        <?php echo $ico_phone_lg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                        <?php echo esc_html($off['phone']); ?>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     BRANCHES GRID
     ============================================================ -->
<section class="section ctc-branches-section">
    <div class="container">
        <div class="section-header">
            <span class="section-tag section-tag-dark">Our Branches</span>
            <h2 class="section-title">Find a Branch Near You</h2>
            <p class="section-subtitle">With <?php echo count($branches); ?> branches across Telangana &amp; Andhra Pradesh, expert coaching is always close to home.</p>
        </div>
        <div class="ctc-branches-grid">
            <?php foreach ($branches as $br) :
                $tel     = preg_replace('/\s+/', '', $br['phone']);
                $dir_url = 'https://www.google.com/maps/dir/?api=1&destination=' . urlencode( $br['address'] );
            ?>
            <div class="ctc-branch-card">
                <!-- Red top: map-link icon + white pill -->
                <div class="ctc-branch-top">
                    <a href="<?php echo esc_url( $dir_url ); ?>"
                       class="ctc-branch-map-link"
                       target="_blank" rel="noopener noreferrer"
                       aria-label="Get directions to <?php echo esc_attr( $br['name'] ); ?>">
                        <?php echo $ico_pin_lg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    </a>
                    <span class="ctc-branch-pill"><?php echo esc_html($br['name']); ?></span>
                </div>
                <!-- White bottom: contact details -->
                <div class="ctc-branch-bottom">
                    <div class="ctc-branch-row">
                        <span class="ctc-bi"><?php echo $ico_pin; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                        <span><?php echo esc_html($br['address']); ?></span>
                    </div>
                    <div class="ctc-branch-row">
                        <span class="ctc-bi"><?php echo $ico_phone; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                        <a href="tel:<?php echo esc_attr($tel); ?>"><?php echo esc_html($br['phone']); ?></a>
                    </div>
                    <div class="ctc-branch-row">
                        <span class="ctc-bi"><?php echo $ico_mail; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
                        <a href="mailto:<?php echo esc_attr($br['email']); ?>"><?php echo esc_html($br['email']); ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     CONTACT FORM + INFO
     ============================================================ -->
<section class="section ctc-form-section" id="ctcForm">
    <div class="container">
        <div class="ctc-form-wrap">

            <!-- Left: Info Panel -->
            <div class="ctc-form-info">
                <span class="section-tag">Send a Message</span>
                <h2 class="ctc-form-info-title">Have a Question?<br>We'd Love to Help!</h2>
                <p class="ctc-form-info-sub">Fill in the form and our admission counselors will get back to you within 24 hours.</p>

                <div class="ctc-form-info-items">
                    <div class="ctc-form-info-item">
                        <div class="ctc-form-info-icon"><?php echo $ico_phone_lg; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
                        <div>
                            <div class="ctc-form-info-label">Call Us</div>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $site_phone)); ?>" class="ctc-form-info-value"><?php echo esc_html($site_phone); ?></a>
                        </div>
                    </div>
                    <div class="ctc-form-info-item">
                        <div class="ctc-form-info-icon"><?php echo $ico_mail_lg; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
                        <div>
                            <div class="ctc-form-info-label">Email Us</div>
                            <a href="mailto:<?php echo esc_attr($site_email); ?>" class="ctc-form-info-value"><?php echo esc_html($site_email); ?></a>
                        </div>
                    </div>
                    <div class="ctc-form-info-item">
                        <div class="ctc-form-info-icon"><?php echo $ico_clock; // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
                        <div>
                            <div class="ctc-form-info-label">Office Hours</div>
                            <div class="ctc-form-info-value">Mon – Sat &nbsp;|&nbsp; 9:00 AM – 7:00 PM</div>
                        </div>
                    </div>
                </div>

                <?php if ($f_yt || $f_ig || $f_fb) : ?>
                <div class="ctc-form-social">
                    <div class="ctc-form-social-label">Follow Us</div>
                    <div class="social-links">
                        <?php if ($f_yt) : ?>
                        <a href="<?php echo esc_url($f_yt); ?>" class="social-link" aria-label="YouTube" target="_blank" rel="noopener">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8zM9.7 15.5V8.5l6.3 3.5-6.3 3.5z"/></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($f_ig) : ?>
                        <a href="<?php echo esc_url($f_ig); ?>" class="social-link" aria-label="Instagram" target="_blank" rel="noopener">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 3.2.1 4.7 1.7 4.8 4.8.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.1-1.6 4.7-4.8 4.8-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1C4 21.4 2.5 19.8 2.4 16.7 2.3 15.5 2.3 15.1 2.3 12s0-3.6.1-4.8C2.5 4 4 2.5 7.2 2.3 8.4 2.2 8.8 2.2 12 2.2zm0-2.2C8.7 0 8.3 0 7.1.1 2.7.3.3 2.7.1 7.1 0 8.3 0 8.7 0 12s0 3.7.1 4.9C.3 21.3 2.7 23.7 7.1 23.9 8.3 24 8.7 24 12 24s3.7 0 4.9-.1c4.4-.2 6.8-2.6 7-7C24 15.7 24 15.3 24 12s0-3.7-.1-4.9C23.7 2.7 21.3.3 16.9.1 15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4A6.2 6.2 0 0 0 12 5.8zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.8a1.4 1.4 0 1 0 0 2.8 1.4 1.4 0 0 0 0-2.8z"/></svg>
                        </a>
                        <?php endif; ?>
                        <?php if ($f_fb) : ?>
                        <a href="<?php echo esc_url($f_fb); ?>" class="social-link" aria-label="Facebook" target="_blank" rel="noopener">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.1C24 5.4 18.6 0 12 0S0 5.4 0 12.1C0 18.1 4.4 23 10.1 24v-8.4H7.1v-3.5h3V9.4c0-3 1.8-4.7 4.5-4.7 1.3 0 2.7.2 2.7.2v3h-1.5c-1.5 0-2 .9-2 1.9v2.3h3.3l-.5 3.5h-2.8V24C19.6 23 24 18.1 24 12.1z"/></svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right: Form -->
            <div class="ctc-form-card">
                <form id="ctcInquiryForm" class="ctc-form" novalidate autocomplete="off">
                    <div class="ctc-form-row">
                        <div class="ctc-field">
                            <label class="ctc-label" for="ctc_name">Full Name <span class="ctc-req">*</span></label>
                            <input class="ctc-input" type="text" id="ctc_name" name="ctc_name" placeholder="Your full name" autocomplete="name">
                            <span class="ctc-error" id="err_name" role="alert"></span>
                        </div>
                        <div class="ctc-field">
                            <label class="ctc-label" for="ctc_phone">Phone Number <span class="ctc-req">*</span></label>
                            <input class="ctc-input" type="tel" id="ctc_phone" name="ctc_phone" placeholder="+91 XXXXX XXXXX" autocomplete="tel">
                            <span class="ctc-error" id="err_phone" role="alert"></span>
                        </div>
                    </div>
                    <div class="ctc-field">
                        <label class="ctc-label" for="ctc_email">Email Address <span class="ctc-req">*</span></label>
                        <input class="ctc-input" type="email" id="ctc_email" name="ctc_email" placeholder="your@email.com" autocomplete="email">
                        <span class="ctc-error" id="err_email" role="alert"></span>
                    </div>
                    <div class="ctc-form-row">
                        <div class="ctc-field">
                            <label class="ctc-label" for="ctc_course">Course Interested</label>
                            <select class="ctc-select" id="ctc_course" name="ctc_course">
                                <option value="">Select a course</option>
                                <option value="SSC CGL">SSC CGL</option>
                                <option value="SSC CHSL">SSC CHSL</option>
                                <option value="IBPS PO">IBPS PO</option>
                                <option value="IBPS Clerk">IBPS Clerk</option>
                                <option value="RBI Grade B">RBI Grade B</option>
                                <option value="SI Exam">SI Exam</option>
                                <option value="Constable">Constable</option>
                                <option value="Railway (RRB)">Railway (RRB)</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="ctc-field">
                            <label class="ctc-label" for="ctc_branch">Preferred Branch</label>
                            <select class="ctc-select" id="ctc_branch" name="ctc_branch">
                                <option value="">Select a branch</option>
                                <?php foreach ($branches as $br) : ?>
                                <option value="<?php echo esc_attr($br['name']); ?>"><?php echo esc_html($br['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="ctc-field">
                        <label class="ctc-label" for="ctc_message">Message</label>
                        <textarea class="ctc-textarea" id="ctc_message" name="ctc_message" rows="4" placeholder="Tell us how we can help you…"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary ctc-submit" id="ctcSubmitBtn">
                        <span class="ctc-submit-text">Submit Inquiry</span>
                        <span class="ctc-submit-spinner" style="display:none" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"/></svg>
                        </span>
                        <?php echo $ico_send; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    </button>

                    <div class="ctc-success" id="ctcSuccess" style="display:none" role="status">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Thank you! Our counselor will reach out to you within 24 hours.
                    </div>
                    <div class="ctc-error-msg" id="ctcError" style="display:none" role="alert">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Something went wrong. Please try again or call us directly.
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>


<!-- ============================================================
     MAP
     ============================================================ -->
<section class="ctc-map-section">
    <div class="container ctc-map-header">
        <span class="section-tag">Find Us</span>
        <h2 class="section-title">Visit Our Head Office</h2>
        <p class="section-subtitle" style="margin-top:8px;">Ameerpet, Hyderabad — the heart of competitive exam coaching in Telangana.</p>
    </div>
    <div class="ctc-map-embed">
        <!-- Replace the src URL with your actual Google Maps Embed URL -->
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3806.742!2d78.4487!3d17.4374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb90ce7e764097%3A0x2741ecfb8d3e4e19!2sAmeerpet%2C%20Hyderabad%2C%20Telangana!5e0!3m2!1sen!2sin!4v1678000000000!5m2!1sen!2sin"
            width="100%"
            height="440"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="IRF IACE Head Office – Ameerpet, Hyderabad">
        </iframe>
    </div>
</section>


<!-- ============================================================
     FOOTER CTA
     ============================================================ -->
<section class="ctc-footer-cta">
    <div class="ctc-footer-cta-bg"></div>
    <div class="container">
        <div class="ctc-footer-cta-inner">
            <div class="ctc-footer-cta-text">
                <h2 class="ctc-footer-cta-title">Have Questions? Talk to Our Experts Today!</h2>
                <p class="ctc-footer-cta-sub">Our admission counselors are available Mon–Sat, 9 AM to 7 PM to guide you.</p>
            </div>
            <div class="ctc-footer-cta-btns">
                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $site_phone)); ?>" class="btn btn-primary">
                    <?php echo $ico_phone_lg; // phpcs:ignore WordPress.Security.EscapeOutput ?>
                    Call Now
                </a>
                <a href="#ctcForm" class="btn btn-outline">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Enquire Now
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     STICKY BAR  (mobile only — hidden on desktop via CSS)
     ============================================================ -->
<div class="ctc-sticky-bar" id="ctcStickyBar" aria-label="Quick contact">
    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $site_phone)); ?>" class="ctc-sticky-btn ctc-sticky-call">
        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.62 4.42 2 2 0 0 1 3.59 2.24h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.16 6.16l.92-.92a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        Call Now
    </a>
    <a href="https://wa.me/<?php echo esc_attr($site_wa); ?>"
       target="_blank" rel="noopener noreferrer"
       class="ctc-sticky-btn ctc-sticky-whatsapp">
        <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
        WhatsApp
    </a>
</div>


<?php get_footer(); ?>
