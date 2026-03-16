<?php get_header(); ?>

<!-- ============================================================
     SECTION 1: HERO
     ============================================================ -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="dot"></span>
                India's #1 Competitive Exam Institute
            </div>
            <h1 class="hero-title">
                Crack Your Dream Exam with <span class="highlight">IRF – IACE</span>
            </h1>
            <p class="hero-subtitle">Smart preparation. Expert guidance. Proven results.</p>
            <p class="hero-typed">We prepare you for <span class="typed-text">SSC CGL</span></p>
            <div class="hero-actions">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Enroll Now &rarr;</a>
                <a href="<?php echo esc_url(home_url('/results')); ?>" class="btn btn-outline">View Results</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-number counter" data-target="5000" data-suffix="+">0</div>
                    <div class="hero-stat-label">Students Enrolled</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number counter" data-target="1200" data-suffix="+">0</div>
                    <div class="hero-stat-label">Selections Made</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number counter" data-target="10" data-suffix="+ Yrs">0</div>
                    <div class="hero-stat-label">Experience</div>
                </div>
                <div class="hero-stat">
                    <div class="hero-stat-number counter" data-target="98" data-suffix="%">0</div>
                    <div class="hero-stat-label">Success Rate</div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroll-indicator">
        <div class="scroll-mouse"><div class="scroll-wheel"></div></div>
        <span>Scroll Down</span>
    </div>
</section>


<!-- ============================================================
     SECTION 2: EXAMS WE PREPARE FOR
     ============================================================ -->
<section class="section exams-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">What We Teach</span>
            <h2 class="section-title">Exams We Prepare For</h2>
            <p class="section-subtitle">Comprehensive coaching for all major government competitive exams across India.</p>
        </div>
        <div class="exams-grid">
            <?php
            $exams = array(
                array('icon' => '📋', 'name' => 'SSC CGL', 'full' => 'Combined Graduate Level'),
                array('icon' => '📄', 'name' => 'SSC CHSL', 'full' => 'Combined Higher Secondary'),
                array('icon' => '🏦', 'name' => 'IBPS PO', 'full' => 'Probationary Officer'),
                array('icon' => '💳', 'name' => 'IBPS Clerk', 'full' => 'Clerical Cadre'),
                array('icon' => '🏛️', 'name' => 'RBI Grade B', 'full' => 'Reserve Bank of India'),
                array('icon' => '👮', 'name' => 'SI Exam', 'full' => 'Sub Inspector'),
                array('icon' => '🚔', 'name' => 'Constable', 'full' => 'Police Constable'),
                array('icon' => '🚂', 'name' => 'RRB NTPC', 'full' => 'Railway Recruitment Board'),
                array('icon' => '📊', 'name' => 'SBI PO', 'full' => 'State Bank of India'),
                array('icon' => '⚖️', 'name' => 'NABARD', 'full' => 'Agriculture Bank'),
            );
            foreach ($exams as $index => $exam) :
            ?>
            <div class="exam-card reveal reveal-delay-<?php echo esc_attr(min($index + 1, 4)); ?>">
                <div class="exam-icon"><span><?php echo $exam['icon']; ?></span></div>
                <div class="exam-name"><?php echo esc_html($exam['name']); ?></div>
                <div class="exam-full"><?php echo esc_html($exam['full']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 3: IRF LEARNING MODEL
     ============================================================ -->
<section class="section learning-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Our Methodology</span>
            <h2 class="section-title">The IRF Learning Model</h2>
            <p class="section-subtitle" style="color:rgba(255,255,255,0.6)">A proven 4-step framework that has produced thousands of government job selections.</p>
        </div>
        <div class="learning-steps">
            <div class="learning-step reveal reveal-delay-1">
                <div class="step-number"><span class="step-icon">📝</span></div>
                <h3 class="step-title">Practice</h3>
                <p class="step-desc">Daily mock tests, previous year papers and topic-wise drills to build exam readiness.</p>
            </div>
            <div class="learning-step reveal reveal-delay-2">
                <div class="step-number"><span class="step-icon">🔍</span></div>
                <h3 class="step-title">Analyze</h3>
                <p class="step-desc">Detailed performance analytics to identify weak areas and track your progress scientifically.</p>
            </div>
            <div class="learning-step reveal reveal-delay-3">
                <div class="step-number"><span class="step-icon">🎯</span></div>
                <h3 class="step-title">Improve</h3>
                <p class="step-desc">Targeted sessions with expert mentors to close gaps and strengthen your core concepts.</p>
            </div>
            <div class="learning-step reveal reveal-delay-4">
                <div class="step-number"><span class="step-icon">🏆</span></div>
                <h3 class="step-title">Perform</h3>
                <p class="step-desc">Full-length simulated exams in CBT format to build speed, accuracy and exam-day confidence.</p>
            </div>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 4: FACILITIES
     ============================================================ -->
<section class="section facilities-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">World-Class Infrastructure</span>
            <h2 class="section-title">Our Facilities</h2>
            <p class="section-subtitle">Everything you need to prepare, practice and perform — all under one roof.</p>
        </div>
        <div class="facilities-grid">
            <?php
            $facilities = array(
                array('icon' => '🏛️', 'title' => 'Practice Hall', 'desc' => 'Spacious, air-conditioned study halls designed for focused, distraction-free learning with seating for 200+ students.'),
                array('icon' => '💻', 'title' => 'CBT Lab', 'desc' => 'State-of-the-art computer-based testing lab with 100+ systems simulating the exact real exam environment.'),
                array('icon' => '👨‍🏫', 'title' => 'Expert Mentorship', 'desc' => 'One-on-one mentoring sessions with experienced faculty who are former toppers and subject matter experts.'),
                array('icon' => '📊', 'title' => 'Mock Tests', 'desc' => 'Weekly full-length mock exams with instant analysis, rankings and detailed score breakdowns.'),
                array('icon' => '📈', 'title' => 'Performance Analysis', 'desc' => 'AI-powered analytics dashboard to track strengths, weaknesses and daily improvement metrics.'),
                array('icon' => '🗺️', 'title' => 'Exam Strategy', 'desc' => 'Customized study plans, time management workshops and last-mile revision strategies for every exam.'),
            );
            foreach ($facilities as $index => $facility) :
            ?>
            <div class="facility-card reveal reveal-delay-<?php echo esc_attr(($index % 3) + 1); ?>">
                <div class="facility-icon"><?php echo $facility['icon']; ?></div>
                <h3 class="facility-title"><?php echo esc_html($facility['title']); ?></h3>
                <p class="facility-desc"><?php echo esc_html($facility['desc']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 5: RESULTS (CPT)
     ============================================================ -->
<section class="section results-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Proven Track Record</span>
            <h2 class="section-title">Our Toppers</h2>
            <p class="section-subtitle">Real students. Real results. Selections across every major competitive exam.</p>
        </div>
        <div class="results-grid">
            <?php
            $results_query = new WP_Query(array(
                'post_type'      => 'results',
                'posts_per_page' => 8,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($results_query->have_posts()) :
                while ($results_query->have_posts()) : $results_query->the_post();
                    $student_name  = function_exists('get_field') ? get_field('student_name')  : get_the_title();
                    $exam_name     = function_exists('get_field') ? get_field('exam_name')      : '';
                    $rank          = function_exists('get_field') ? get_field('rank')           : '';
                    $year          = function_exists('get_field') ? get_field('year')           : '';
                    $student_photo = function_exists('get_field') ? get_field('student_photo')  : null;
            ?>
            <div class="result-card reveal">
                <?php if ($student_photo) : ?>
                    <img src="<?php echo esc_url(is_array($student_photo) && isset($student_photo['url']) ? $student_photo['url'] : $student_photo); ?>" alt="<?php echo esc_attr($student_name); ?>" class="result-photo">
                <?php elseif (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', array('class' => 'result-photo')); ?>
                <?php else : ?>
                    <div class="result-photo-placeholder">🎓</div>
                <?php endif; ?>
                <div class="result-info">
                    <?php if ($rank) : ?>
                        <span class="result-rank">Rank <?php echo esc_html($rank); ?></span>
                    <?php endif; ?>
                    <div class="result-name"><?php echo esc_html($student_name); ?></div>
                    <?php if ($exam_name) : ?>
                        <div class="result-exam"><?php echo esc_html($exam_name); ?></div>
                    <?php endif; ?>
                    <?php if ($year) : ?>
                        <div class="result-year"><?php echo esc_html($year); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="no-results">
                <p>Results coming soon. Our toppers will be featured here!</p>
            </div>
            <?php endif; ?>
        </div>
        <div style="text-align:center; margin-top:48px;">
            <a href="<?php echo esc_url(home_url('/results')); ?>" class="btn btn-primary">View All Results &rarr;</a>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 6: SUCCESS STORIES CAROUSEL (CPT)
     ============================================================ -->
<section class="section stories-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Student Stories</span>
            <h2 class="section-title">Success Stories</h2>
            <p class="section-subtitle" style="color:rgba(255,255,255,0.6)">Hear directly from students who achieved their dreams with IRF.</p>
        </div>
        <div class="stories-carousel reveal">
            <div class="stories-track" id="storiesTrack">
                <?php
                $stories_query = new WP_Query(array(
                    'post_type'      => 'success_stories',
                    'posts_per_page' => 8,
                    'post_status'    => 'publish',
                ));

                if ($stories_query->have_posts()) :
                    while ($stories_query->have_posts()) : $stories_query->the_post();
                        $s_name    = function_exists('get_field') ? get_field('student_name')   : get_the_title();
                        $s_exam    = function_exists('get_field') ? get_field('exam_cleared')   : '';
                        $s_rank    = function_exists('get_field') ? get_field('rank')           : '';
                        $s_msg     = function_exists('get_field') ? get_field('student_message'): get_the_excerpt();
                        $s_photo   = function_exists('get_field') ? get_field('student_photo')  : null;
                ?>
                <div class="story-card">
                    <div class="story-header">
                        <?php if ($s_photo) : ?>
                            <img src="<?php echo esc_url(is_array($s_photo) && isset($s_photo['url']) ? $s_photo['url'] : $s_photo); ?>" alt="<?php echo esc_attr($s_name); ?>" class="story-photo">
                        <?php elseif (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('thumbnail', array('class' => 'story-photo')); ?>
                        <?php else : ?>
                            <div class="story-photo-placeholder">🎓</div>
                        <?php endif; ?>
                        <div>
                            <div class="story-name"><?php echo esc_html($s_name); ?></div>
                            <?php if ($s_exam) : ?>
                                <div class="story-exam"><?php echo esc_html($s_exam); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($s_msg) : ?>
                        <p class="story-message">"<?php echo esc_html($s_msg); ?>"</p>
                    <?php endif; ?>
                    <?php if ($s_rank) : ?>
                        <span class="story-rank">🏆 Rank <?php echo esc_html($s_rank); ?></span>
                    <?php endif; ?>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Placeholder cards when no data
                    $placeholders = array(
                        array('name' => 'Rahul Sharma', 'exam' => 'SSC CGL 2023', 'rank' => '142', 'msg' => 'IRF structured approach and daily mock tests helped me crack SSC CGL in my first attempt. The faculty support was exceptional.'),
                        array('name' => 'Priya Reddy', 'exam' => 'IBPS PO 2023', 'rank' => '87', 'msg' => 'The performance analysis system at IRF showed me exactly where I was going wrong. Cleared IBPS PO with a top rank!'),
                        array('name' => 'Kiran Kumar', 'exam' => 'SI Exam 2023', 'rank' => '23', 'msg' => 'Joined IRF with zero coaching experience. The step-by-step learning model made everything clear. Proud SI now!'),
                        array('name' => 'Sneha Patel', 'exam' => 'RBI Grade B 2023', 'rank' => '56', 'msg' => 'The CBT lab practice at IRF was a game changer. I was fully prepared for the online exam format from day one.'),
                    );
                    foreach ($placeholders as $p) :
                ?>
                <div class="story-card">
                    <div class="story-header">
                        <div class="story-photo-placeholder">🎓</div>
                        <div>
                            <div class="story-name"><?php echo esc_html($p['name']); ?></div>
                            <div class="story-exam"><?php echo esc_html($p['exam']); ?></div>
                        </div>
                    </div>
                    <p class="story-message">"<?php echo esc_html($p['msg']); ?>"</p>
                    <span class="story-rank">🏆 Rank <?php echo esc_html($p['rank']); ?></span>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
        <div class="carousel-controls">
            <button class="carousel-btn prev" aria-label="Previous">&#8592;</button>
            <div class="carousel-dots" id="carouselDots"></div>
            <button class="carousel-btn next" aria-label="Next">&#8594;</button>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 7: ANNOUNCEMENTS / EVENTS (CPT)
     ============================================================ -->
<section class="section announcements-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Stay Updated</span>
            <h2 class="section-title">Latest Announcements</h2>
            <p class="section-subtitle">Upcoming events, exam schedules and important notifications from IRF.</p>
        </div>
        <div class="announcements-grid">
            <?php
            $announcements_query = new WP_Query(array(
                'post_type'      => 'announcements',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));

            if ($announcements_query->have_posts()) :
                while ($announcements_query->have_posts()) : $announcements_query->the_post();
                    $event_date  = function_exists('get_field') ? get_field('event_date')        : '';
                    $event_type  = function_exists('get_field') ? get_field('event_type')        : 'Event';
                    $event_desc  = function_exists('get_field') ? get_field('event_description') : get_the_excerpt();
                    $event_image = function_exists('get_field') ? get_field('event_image')       : null;
            ?>
            <div class="announcement-card reveal">
                <?php if ($event_image) : ?>
                    <img src="<?php echo esc_url(is_array($event_image) && isset($event_image['url']) ? $event_image['url'] : $event_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="announcement-image">
                <?php elseif (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium_large', array('class' => 'announcement-image')); ?>
                <?php else : ?>
                    <div class="announcement-image-placeholder">📢</div>
                <?php endif; ?>
                <div class="announcement-body">
                    <div class="announcement-meta">
                        <span class="announcement-type"><?php echo esc_html($event_type ?: 'Event'); ?></span>
                        <?php if ($event_date) : ?>
                            <span class="announcement-date">📅 <?php echo esc_html($event_date); ?></span>
                        <?php endif; ?>
                    </div>
                    <h3 class="announcement-title"><?php echo esc_html(get_the_title()); ?></h3>
                    <?php if ($event_desc) : ?>
                        <p class="announcement-desc"><?php echo esc_html(wp_trim_words($event_desc, 20)); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="announcement-link">Read More &#8594;</a>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
            <div class="no-results" style="grid-column:1/-1; text-align:center; color:var(--gray); padding:40px 0;">
                <p>No announcements yet. Check back soon!</p>
            </div>
            <?php endif; ?>
        </div>
        <div style="text-align:center; margin-top:48px;">
            <a href="<?php echo esc_url(home_url('/announcements')); ?>" class="btn btn-primary">View All Announcements &rarr;</a>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 8: YOUTUBE REELS AUTO-SCROLL
     ============================================================ -->
<section class="section reels-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-tag">Watch &amp; Learn</span>
            <h2 class="section-title">IRF on YouTube</h2>
            <p class="section-subtitle">Quick exam tips, success stories and strategies — straight from our YouTube channel.</p>
        </div>
    </div>
    <div class="reels-track-wrapper">
        <div class="reels-track" id="reelsTrack">
            <?php
            // Add YouTube Shorts video IDs here
            // Example: 'dQw4w9WgXcQ' is the part after youtube.com/shorts/
            $youtube_reels = array(
                // Add your YouTube Shorts IDs below:
                // 'VIDEO_ID_1',
                // 'VIDEO_ID_2',
            );

            if (!empty($youtube_reels)) :
                // Duplicate for seamless loop
                $all_reels = array_merge($youtube_reels, $youtube_reels);
                foreach ($all_reels as $video_id) :
            ?>
            <div class="reel-item">
                <div class="reel-embed">
                    <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?rel=0&modestbranding=1" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <?php
                endforeach;
            else :
                // Placeholder reels
                for ($i = 0; $i < 10; $i++) :
            ?>
            <div class="reel-item">
                <div class="reel-placeholder">
                    <div class="reel-play-icon">&#9654;</div>
                    <span>IRF Short #<?php echo $i + 1; ?></span>
                    <small>Add YouTube ID</small>
                </div>
            </div>
            <?php
                endfor;
            endif;
            ?>
        </div>
    </div>
</section>


<!-- ============================================================
     SECTION 9: CALL TO ACTION
     ============================================================ -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content reveal">
            <h2 class="cta-title">Ready to Start Your Government Job Journey?</h2>
            <p class="cta-subtitle">Join 5,000+ students who trusted IRF and got selected. Your turn is next.</p>
            <div class="cta-actions">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-white">Enroll Now &rarr;</a>
                <a href="tel:+919876543210" class="btn btn-outline">📞 Call Us Now</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
