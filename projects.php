<?php
// Tushar Khamparia - Projects Page
$PAGE       = 'projects';
$PAGE_TITLE = 'Projects | Tushar Khamparia — UI / Frontend Developer';
$PAGE_DESC  = 'Explore the complete portfolio of live client projects by Tushar Khamparia — landing pages, campaign microsites, admin dashboards, and performance optimization work.';
$PAGE_PATH  = '/projects.php';
$PAGE_CSS   = ['assets/css/projects.css'];
require 'includes/header.php';
?>
        <!-- HERO -->
        <section class="projects-page-hero">
            <div class="hero-grid-bg"></div>
            <div class="container z-index-content">
                <a href="index.php" class="back-link"><i class="ti ti-arrow-left"></i> BACK TO HOME</a>
                <h1 class="display-title" style="font-size: clamp(2rem, 6vw, 5rem);">ALL PROJECTS</h1>
                <p class="projects-count mt-3">20 LIVE CLIENT PROJECTS</p>
            </div>
        </section>

        <hr class="glow-separator">

        <!-- PROJECTS CONTENT -->
        <section class="py-8 section-glow">
            <div class="container">

                <!-- ==================== CENTRAL PARK ==================== -->
                <div class="client-group" data-group="central-park">
                    <div class="client-group-header">
                        <h2 class="client-group-name">Central Park Resorts</h2>
                        <span class="client-group-count">7 PROJECTS</span>
                    </div>

                    <div class="row">
                        <!-- Studioverse -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/studioverse.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Central Park Studioverse</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Luxury real estate showcase with immersive visual experience, smooth scroll-based animations, and premium UI design. Built from Figma designs with pixel-perfect responsiveness.</p>
                                    <ul class="project-detail-highlights">
                                        <li>GSAP ScrollTrigger parallax animations</li>
                                        <li>Swiper.js interactive galleries</li>
                                        <li>Fully responsive across all breakpoints</li>
                                        <li>Lead generation form with Google Sheets integration</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>JavaScript</span><span>GSAP</span><span>Swiper.js</span><span>Google Sheets</span>
                                    </div>
                                    <a href="https://www.centralpark.in/studioverse/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Studioverse Old -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/studioverse-old.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Studioverse (Legacy)</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Original Studioverse property page — earlier iteration with full responsive implementation. The foundation that led to the redesigned version.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Full responsive implementation from scratch</li>
                                        <li>Interactive UI components</li>
                                        <li>Cross-browser compatible</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>JavaScript</span><span>Responsive</span>
                                    </div>
                                    <a href="https://www.centralpark.in/studioverse-old/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Floral Vista -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/floral-vista.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Floral Vista 2026</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Figma to Code)</p>
                                    <p class="project-detail-desc">2026 luxury property landing page with elegant visuals, smooth animations, and lead capture forms with Google Sheets integration.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Figma design converted to pixel-perfect code</li>
                                        <li>Bootstrap grid layout system</li>
                                        <li>Lead capture form integration</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>Bootstrap</span><span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/floral-vista-2026/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Selene -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/selene.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Central Park Selene</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Theme-Based)</p>
                                    <p class="project-detail-desc">Theme-based luxury real estate landing page with high-end conversion-focused design. Custom Tailwind CSS implementation with unique visual identity.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Theme-based unique visual design</li>
                                        <li>Tailwind CSS utility framework</li>
                                        <li>Conversion-optimized CTA placements</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>Figma to Code</span><span>Tailwind CSS</span><span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/selene-lp/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Belanova -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/belanova.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Central Park Belanova</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Figma to Code)</p>
                                    <p class="project-detail-desc">Elegant property landing page with premium UI, gallery showcase, and lead capture. Converted from Figma designs with precise attention to detail.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Pixel-perfect Figma to HTML conversion</li>
                                        <li>Interactive gallery components</li>
                                        <li>Lead generation flow</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>Figma to Code</span><span>HTML5</span><span>CSS3</span><span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/belanova-lp/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Belaperla -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/belaperla.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Central Park Belaperla</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Figma to Code)</p>
                                    <p class="project-detail-desc">High-end property showcase with immersive hero visuals and conversion-optimized layout. Built with Bootstrap grid for consistent responsive behavior.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Immersive hero section design</li>
                                        <li>Bootstrap responsive grid</li>
                                        <li>Conversion-focused layout</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>Figma to Code</span><span>HTML5</span><span>CSS3</span><span>Bootstrap</span>
                                    </div>
                                    <a href="https://www.centralpark.in/belaperla/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- The Orchard -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/orchard.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">The Orchard</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Property landing page with nature-inspired visuals and responsive lead generation flow. Bootstrap-based layout with custom styling.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Nature-inspired visual design</li>
                                        <li>Responsive lead generation flow</li>
                                        <li>Bootstrap grid system</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>Bootstrap</span><span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/the-orchard-lp-test/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="glow-separator" style="margin-bottom: 5rem;">

                <!-- ==================== CHINTAMANI ==================== -->
                <div class="client-group" data-group="chintamani">
                    <div class="client-group-header">
                        <h2 class="client-group-name">Chintamani</h2>
                        <span class="client-group-count">3 PROJECTS</span>
                    </div>

                    <div class="row">
                        <!-- Chintamani Campaign Website -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/chintamani2.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Chintamani — Campaign Website</h3>
                                    <p class="project-role"><strong>Role:</strong> Full Stack Developer</p>
                                    <p class="project-detail-desc">Movie campaign microsite featuring interactive visual storytelling, GSAP scroll-driven animations, and immersive UI design. Connected to MongoDB for data storage and deployed on AWS EC2.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Interactive campaign microsite with scroll-based storytelling</li>
                                        <li>GSAP ScrollTrigger animations & parallax effects</li>
                                        <li>MongoDB cluster integration for data storage</li>
                                        <li>AWS EC2 deployment with Elastic IP</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>PHP</span><span>MongoDB</span><span>GSAP</span><span>AWS</span><span>JavaScript</span>
                                    </div>
                                    <a href="https://icubeswire.com/projects/chintamani2" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Chintamani Phase 2 Website -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/chintamani2-phase2.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Chintamani — Phase 2 Website</h3>
                                    <p class="project-role"><strong>Role:</strong> Full Stack Developer</p>
                                    <p class="project-detail-desc">Second phase of the Chintamani campaign — a separate microsite with enhanced interactive UI, advanced GSAP animations, and MySQL-backed data management.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Separate campaign microsite with refreshed design</li>
                                        <li>Enhanced GSAP ScrollTrigger animations</li>
                                        <li>MySQL database integration</li>
                                        <li>Responsive across all devices</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>PHP</span><span>MySQL</span><span>GSAP</span><span>JavaScript</span>
                                    </div>
                                    <a href="https://icubeswire.com/projects/chintamani2/phase-2" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Chintamani CRM/LMS Dashboard -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/chintamani-php-dashboard.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Chintamani — CRM/LMS Admin Dashboard</h3>
                                    <p class="project-role"><strong>Role:</strong> Full Stack Developer (PHP)</p>
                                    <p class="project-detail-desc">Unified real estate CRM & Lead Management dashboard powering both Chintamani campaign websites. Built entirely in PHP with AJAX-driven SPA-style navigation, complete lead lifecycle tracking, blog CMS, and role-based user management.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Shared admin panel for both Campaign & Phase 2 websites</li>
                                        <li>Lead lifecycle — follow-ups → site visits → booking with auto-assignment (Round Robin, Random, Manual)</li>
                                        <li>Blog CMS — list, add, edit posts with TinyMCE rich text editor</li>
                                        <li>User management with role-based login & access control</li>
                                        <li>AJAX-powered SPA-style dashboard — zero page refreshes</li>
                                        <li>Secure session handling, input sanitization & authentication</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>PHP</span><span>MySQL</span><span>AJAX</span><span>TinyMCE</span><span>CRM</span><span>Lead Management</span><span>Admin Panel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="glow-separator" style="margin-bottom: 5rem;">

                <!-- ==================== iCubesWire ==================== -->
                <div class="client-group" data-group="icubeswire">
                    <div class="client-group-header">
                        <h2 class="client-group-name">iCubesWire</h2>
                        <span class="client-group-count">6 PROJECTS</span>
                    </div>

                    <div class="row">
                        <!-- 15 Year Anniversary -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/icubeswire-15year.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">iCubesWire 15th Anniversary</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Celebratory milestone page with timeline-driven storytelling and branded animations. Heavy use of GSAP ScrollTrigger for scroll-based reveal sequences.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Complex GSAP ScrollTrigger timeline animations</li>
                                        <li>Timeline-driven storytelling UX</li>
                                        <li>Branded animation sequences</li>
                                        <li>Fully responsive across devices</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>GSAP</span><span>ScrollTrigger</span><span>JavaScript</span><span>CSS3</span>
                                    </div>
                                    <a href="https://www.icubeswire.com/15year/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- iCubesWire Corporate -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/icubeswire.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">iCubesWire Corporate</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Maintenance & Optimization</p>
                                    <p class="project-detail-desc">Corporate website UI maintenance, component optimization, and ongoing layout improvements on the WordPress-based platform.</p>
                                    <ul class="project-detail-highlights">
                                        <li>WordPress theme customization</li>
                                        <li>UI component optimization</li>
                                        <li>Ongoing layout improvements</li>
                                        <li>Cross-browser testing & fixes</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>WordPress</span><span>CSS3</span><span>JavaScript</span><span>Maintenance</span>
                                    </div>
                                    <a href="https://icubeswire.com" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- IIC 2023 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/iic23.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">India Influencer Conclave 2023</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Major influencer event platform with dynamic content sections, speaker showcase, and registration system. Multi-page responsive implementation.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Multi-page event platform</li>
                                        <li>Dynamic speaker showcase sections</li>
                                        <li>Registration system integration</li>
                                        <li>Bootstrap responsive framework</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>Bootstrap</span><span>JavaScript</span><span>Multi-page</span>
                                    </div>
                                    <a href="https://indiainfluencerconclave.com/iic23/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Conclave 2024 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/conclave24.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">India Influencer Conclave 2024</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Updated event platform with refreshed design, speaker showcase, agenda integration, and improved responsive experience.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Refreshed design for 2024 edition</li>
                                        <li>Agenda & speaker integration</li>
                                        <li>Improved mobile experience</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>Bootstrap</span><span>JavaScript</span><span>Responsive</span>
                                    </div>
                                    <a href="https://indiainfluencerconclave.com/conclave24/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- IIGC -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/iigc.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">IIGC</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Indian Influencer Governing Council — responsive governance platform with dynamic content sections and multi-page architecture.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Multi-page responsive platform</li>
                                        <li>Dynamic content sections</li>
                                        <li>Cross-browser compatibility</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>JavaScript</span><span>Responsive</span>
                                    </div>
                                    <a href="https://iigc.org" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Digital Market Survey -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/dms.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Digital Market Survey</h3>
                                    <p class="project-role"><strong>Role:</strong> Full Stack Developer</p>
                                    <p class="project-detail-desc">Full-stack survey platform with custom PHP admin dashboard panels for data management and analytics. Created complete backend system with database operations.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Custom PHP admin dashboard with data management</li>
                                        <li>MySQL database — table creation, data CRUD operations</li>
                                        <li>Survey form collection and analytics</li>
                                        <li>Secure admin authentication</li>
                                        <li>AWS S3 for file storage with public link access</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>PHP</span><span>MySQL</span><span>Admin Panel</span><span>AWS S3</span><span>JavaScript</span>
                                    </div>
                                    <a href="https://digitalmarketsurvey.com/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="glow-separator" style="margin-bottom: 5rem;">

                <!-- ==================== DAAWAT / LT FOODS ==================== -->
                <div class="client-group" data-group="daawat">
                    <div class="client-group-header">
                        <h2 class="client-group-name">Daawat / LT Foods</h2>
                        <span class="client-group-count">4 PROJECTS</span>
                    </div>

                    <div class="row">
                        <!-- Daawat Main -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/daawat.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Daawat.com</h3>
                                    <p class="project-role"><strong>Role:</strong> Performance Optimization</p>
                                    <p class="project-detail-desc">Performance optimization on Laravel-based site — improved PageSpeed scores from 20s–50s range to 90+ across all metrics (Performance, Accessibility, Best Practices, SEO).</p>
                                    <ul class="project-detail-highlights">
                                        <li>PageSpeed scores improved from 20s–50s to 90+ across all metrics</li>
                                        <li>Image optimization, lazy loading, and compression</li>
                                        <li>CSS/JS minification and critical path optimization</li>
                                        <li>Core Web Vitals improvements (LCP, CLS, FID)</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>Laravel</span><span>PageSpeed</span><span>Performance</span><span>SEO</span>
                                    </div>
                                    <a href="https://daawat.com/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Daawat Saffron Rice -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/saffron-rice.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Daawat Saffron Rice</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Premium product showcase website for Daawat's luxury Saffron Rice line. Immersive visual experience with cinematic hero video, scroll-driven storytelling, Swiper galleries, and a refined luxury aesthetic throughout.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Cinematic full-screen video hero with autoplay</li>
                                        <li>Premium luxury UI with AOS scroll animations</li>
                                        <li>Swiper.js product galleries & sticky scroll sections</li>
                                        <li>Request form modal with lead capture</li>
                                        <li>Fully responsive multi-page PHP site</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>PHP</span><span>Swiper.js</span><span>AOS</span><span>Bootstrap</span>
                                    </div>
                                    <a href="https://www.daawat.com/saffron-rice" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- RYA (Rice Your Awareness) -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/rya.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">RYA — Rice Your Awareness</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Interactive awareness campaign website for Daawat's #OnlyRiceNovember initiative. Features dynamic stats counters, myth-busting sections, FAQ accordions, influencer showcase sliders, and social sharing integration.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Campaign microsite with animated stat counters (67K+ challenges, 88M+ reach)</li>
                                        <li>Swiper.js influencer showcase carousel</li>
                                        <li>Interactive myth-busting cards & FAQ sections</li>
                                        <li>Social sharing integration (Facebook, LinkedIn, Twitter)</li>
                                        <li>Responsive Bootstrap 5 layout with custom design</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>Bootstrap 5</span><span>JavaScript</span><span>Swiper.js</span><span>Campaign</span>
                                    </div>
                                    <a href="https://www.daawat.com/rya/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Dream Ad with SRK -->
                        <div class="col-lg-6 col-md-6">
                            <div class="project-detail-card">
                                <div class="project-detail-image" style="background-image: url('assets/images/projects/dreamad-srk.png');"></div>
                                <div class="project-detail-body">
                                    <h3 class="project-detail-title">Dream Ad with SRK</h3>
                                    <p class="project-role"><strong>Role:</strong> UI Developer (Full Build)</p>
                                    <p class="project-detail-desc">Interactive campaign microsite for Daawat featuring celebrity-driven engagement and dynamic user flow. Built as a single-page experience.</p>
                                    <ul class="project-detail-highlights">
                                        <li>Celebrity-driven interactive campaign</li>
                                        <li>Dynamic user engagement flow</li>
                                        <li>Responsive microsite design</li>
                                    </ul>
                                    <div class="project-detail-tags">
                                        <span>HTML5</span><span>CSS3</span><span>JavaScript</span><span>Microsite</span>
                                    </div>
                                    <a href="https://dreamadwithsrk.daawat.com/" target="_blank" rel="noopener" class="project-detail-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="projects-footer">
                    <p class="text-muted mb-0">&copy; <?php echo date("Y"); ?> Tushar Khamparia. All rights reserved.</p>
                    <a href="index.php#contact" class="project-detail-link mt-3 d-inline-flex">Get in Touch <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>
        </section>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

    <!-- Animated Tech Grid Background -->
    <script>
        (function() {
            const canvas = document.getElementById('techGridCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let w, h, cols, rows;
            const cellSize = 60;
            const lines = [];
            const maxLines = 8;
            const accentColor = {
                r: 56,
                g: 189,
                b: 248
            };

            function resize() {
                w = canvas.width = window.innerWidth;
                h = canvas.height = window.innerHeight;
                cols = Math.ceil(w / cellSize);
                rows = Math.ceil(h / cellSize);
            }

            class GridLine {
                constructor() {
                    this.reset();
                }
                reset() {
                    this.horizontal = Math.random() > 0.5;
                    if (this.horizontal) {
                        this.row = Math.floor(Math.random() * rows);
                        this.pos = -cellSize * 2;
                        this.speed = 0.5 + Math.random() * 1.5;
                        this.length = cellSize * (3 + Math.floor(Math.random() * 5));
                    } else {
                        this.col = Math.floor(Math.random() * cols);
                        this.pos = -cellSize * 2;
                        this.speed = 0.3 + Math.random() * 1.2;
                        this.length = cellSize * (3 + Math.floor(Math.random() * 6));
                    }
                    this.opacity = 0.15 + Math.random() * 0.35;
                    this.width = 1 + Math.random() * 1.5;
                }
                update() {
                    this.pos += this.speed;
                    if (this.pos > (this.horizontal ? w : h) + this.length) this.reset();
                }
                draw() {
                    const {
                        r,
                        g,
                        b
                    } = accentColor;
                    const grad = this.horizontal ?
                        ctx.createLinearGradient(this.pos - this.length, 0, this.pos, 0) :
                        ctx.createLinearGradient(0, this.pos - this.length, 0, this.pos);
                    grad.addColorStop(0, `rgba(${r},${g},${b},0)`);
                    grad.addColorStop(0.3, `rgba(${r},${g},${b},${this.opacity * 0.3})`);
                    grad.addColorStop(0.8, `rgba(${r},${g},${b},${this.opacity})`);
                    grad.addColorStop(1, `rgba(${r},${g},${b},${this.opacity * 0.6})`);
                    ctx.strokeStyle = grad;
                    ctx.lineWidth = this.width;
                    ctx.beginPath();
                    if (this.horizontal) {
                        ctx.moveTo(this.pos - this.length, this.row * cellSize);
                        ctx.lineTo(this.pos, this.row * cellSize);
                    } else {
                        ctx.moveTo(this.col * cellSize, this.pos - this.length);
                        ctx.lineTo(this.col * cellSize, this.pos);
                    }
                    ctx.stroke();
                }
            }

            function drawGrid() {
                const {
                    r,
                    g,
                    b
                } = accentColor;
                ctx.strokeStyle = `rgba(${r},${g},${b},0.04)`;
                ctx.lineWidth = 0.5;
                for (let i = 0; i <= cols; i++) {
                    ctx.beginPath();
                    ctx.moveTo(i * cellSize, 0);
                    ctx.lineTo(i * cellSize, h);
                    ctx.stroke();
                }
                for (let j = 0; j <= rows; j++) {
                    ctx.beginPath();
                    ctx.moveTo(0, j * cellSize);
                    ctx.lineTo(w, j * cellSize);
                    ctx.stroke();
                }
                ctx.fillStyle = `rgba(${r},${g},${b},0.08)`;
                for (let i = 0; i <= cols; i++) {
                    for (let j = 0; j <= rows; j++) {
                        ctx.beginPath();
                        ctx.arc(i * cellSize, j * cellSize, 1.2, 0, Math.PI * 2);
                        ctx.fill();
                    }
                }
            }

            resize();
            for (let i = 0; i < maxLines; i++) {
                const line = new GridLine();
                line.pos = Math.random() * (w + h);
                lines.push(line);
            }
            (function animate() {
                ctx.clearRect(0, 0, w, h);
                drawGrid();
                lines.forEach(l => {
                    l.update();
                    l.draw();
                });
                requestAnimationFrame(animate);
            })();
            window.addEventListener('resize', resize);
        })();
    </script>

    <script src="assets/js/script.js"></script>

    <!-- Project card cursor hover (extends script.js cursor) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cursor = document.querySelector('.custom-cursor');
            const follower = document.querySelector('.custom-cursor-follower');
            const isTouchDevice = window.matchMedia("(pointer: coarse)").matches;
            if (isTouchDevice || !cursor || !follower) return;

            document.querySelectorAll('.project-detail-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    gsap.to(cursor, {
                        scale: 0.5,
                        opacity: 0.5,
                        duration: 0.3
                    });
                    gsap.to(follower, {
                        scale: 1.5,
                        borderColor: 'transparent',
                        backgroundColor: 'rgba(56, 189, 248, 0.1)',
                        duration: 0.3
                    });
                });
                card.addEventListener('mouseleave', () => {
                    gsap.to(cursor, {
                        scale: 1,
                        opacity: 1,
                        duration: 0.3
                    });
                    gsap.to(follower, {
                        scale: 1,
                        borderColor: '#38bdf8',
                        backgroundColor: 'transparent',
                        duration: 0.3
                    });
                });
            });
        });
    </script>

    <!-- Disable image dragging -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('img').forEach(img => {
                img.setAttribute('draggable', 'false');
            });
            document.querySelectorAll('.project-detail-image').forEach(el => {
                el.addEventListener('dragstart', e => e.preventDefault());
            });
        });
    </script>
</body>

</html>