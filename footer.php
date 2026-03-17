
<?php
$f_phone   = irf_opt('site_phone',   '+91 98765 43210');
$f_email   = irf_opt('site_email',   'info@irf-iace.com');
$f_address = irf_opt('site_address', '123, Main Road, Hyderabad, Telangana – 500001');
$f_yt      = irf_opt('social_youtube',   '#');
$f_ig      = irf_opt('social_instagram', '#');
$f_fb      = irf_opt('social_facebook',  '#');
$f_tg      = irf_opt('social_telegram',  '#');
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="IRF IACE" class="footer-logo-img">
                </a>
                <p class="footer-desc">
                    IRF – IACE Result Factory is a premier competitive exam coaching institute dedicated to shaping successful careers through smart preparation, consistent practice, and expert mentorship.
                </p>
                <div class="social-links">
                    <a href="<?php echo esc_url($f_yt); ?>" class="social-link" aria-label="YouTube" <?php if ($f_yt === '#') echo 'style="display:none"'; ?>>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8zM9.7 15.5V8.5l6.3 3.5-6.3 3.5z"/></svg>
                    </a>
                    <a href="<?php echo esc_url($f_ig); ?>" class="social-link" aria-label="Instagram" <?php if ($f_ig === '#') echo 'style="display:none"'; ?>>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 3.2.1 4.7 1.7 4.8 4.8.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.1-1.6 4.7-4.8 4.8-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1C4 21.4 2.5 19.8 2.4 16.7 2.3 15.5 2.3 15.1 2.3 12s0-3.6.1-4.8C2.5 4 4 2.5 7.2 2.3 8.4 2.2 8.8 2.2 12 2.2zm0-2.2C8.7 0 8.3 0 7.1.1 2.7.3.3 2.7.1 7.1 0 8.3 0 8.7 0 12s0 3.7.1 4.9C.3 21.3 2.7 23.7 7.1 23.9 8.3 24 8.7 24 12 24s3.7 0 4.9-.1c4.4-.2 6.8-2.6 7-7C24 15.7 24 15.3 24 12s0-3.7-.1-4.9C23.7 2.7 21.3.3 16.9.1 15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4A6.2 6.2 0 0 0 12 5.8zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.8a1.4 1.4 0 1 0 0 2.8 1.4 1.4 0 0 0 0-2.8z"/></svg>
                    </a>
                    <a href="<?php echo esc_url($f_fb); ?>" class="social-link" aria-label="Facebook" <?php if ($f_fb === '#') echo 'style="display:none"'; ?>>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.1C24 5.4 18.6 0 12 0S0 5.4 0 12.1C0 18.1 4.4 23 10.1 24v-8.4H7.1v-3.5h3V9.4c0-3 1.8-4.7 4.5-4.7 1.3 0 2.7.2 2.7.2v3h-1.5c-1.5 0-2 .9-2 1.9v2.3h3.3l-.5 3.5h-2.8V24C19.6 23 24 18.1 24 12.1z"/></svg>
                    </a>
                    <a href="<?php echo esc_url($f_tg); ?>" class="social-link" aria-label="Telegram" <?php if ($f_tg === '#') echo 'style="display:none"'; ?>>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.6 0 12 0zm5.9 8.2-2 9.4c-.1.6-.5.8-1 .5l-2.7-2-1.3 1.2c-.1.2-.3.2-.6.2l.2-2.8 5-4.5c.2-.2 0-.3-.3-.1L7.2 14.4 4.6 13.6c-.6-.2-.6-.6.1-.8l11.6-4.5c.5-.2 1 .1.8.9z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">&#8250; Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about-irf')); ?>">&#8250; About IRF</a></li>
                    <li><a href="<?php echo esc_url(home_url('/facilities')); ?>">&#8250; Facilities</a></li>
                    <li><a href="<?php echo esc_url(home_url('/results')); ?>">&#8250; Results</a></li>
                    <li><a href="<?php echo esc_url(home_url('/gallery')); ?>">&#8250; Gallery</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>">&#8250; Blog</a></li>
                </ul>
            </div>

            <!-- Exams -->
            <div class="footer-col">
                <h4 class="footer-heading">Exams We Cover</h4>
                <ul class="footer-links">
                    <li><a href="#">&#8250; SSC CGL / CHSL</a></li>
                    <li><a href="#">&#8250; IBPS PO / Clerk</a></li>
                    <li><a href="#">&#8250; RBI Grade B</a></li>
                    <li><a href="#">&#8250; SI Exam</a></li>
                    <li><a href="#">&#8250; Constable</a></li>
                    <li><a href="#">&#8250; Railway (RRB)</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-col">
                <h4 class="footer-heading">Contact Us</h4>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">&#9873;</span>
                    <span><?php echo esc_html($f_address); ?></span>
                </div>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">&#128222;</span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $f_phone)); ?>" style="color:inherit"><?php echo esc_html($f_phone); ?></a>
                </div>
                <div class="footer-contact-item">
                    <span class="footer-contact-icon">&#9993;</span>
                    <a href="mailto:<?php echo esc_attr($f_email); ?>" style="color:inherit"><?php echo esc_html($f_email); ?></a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> IRF – IACE Result Factory. All rights reserved.</p>
            <p>Designed &amp; Developed by IRF Tech Team</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
