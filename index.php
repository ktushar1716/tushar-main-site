<?php
// Tushar Khamparia - Portfolio
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tushar Khamparia | UI / Frontend Developer</title>
    <meta name="description" content="UI / Frontend Developer with 3 years of experience building responsive marketing websites, landing pages, and campaign microsites. Based in Gurugram, India.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;800;900&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 (Grid only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- Devicon (Tech Logos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="dark-theme">
    <!-- Animated Tech Grid Background -->
    <canvas id="techGridCanvas"></canvas>

    <div class="custom-cursor"></div>
    <div class="custom-cursor-follower"></div>

    <!-- STICKY NAVBAR -->
    <nav class="site-nav" id="siteNav">
        <div class="container nav-inner">
            <a href="#" class="nav-logo">TK<span class="text-accent">.</span></a>
            <ul class="nav-links" id="navLinks">
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#expertise" class="nav-link">Expertise</a></li>
                <li><a href="#work" class="nav-link">Work</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#experience" class="nav-link">Experience</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
            <a href="mailto:khampariatushar@gmail.com" class="nav-cta">Let's Talk <i class="ti ti-arrow-right ms-1"></i></a>
            <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- MOBILE NAV OVERLAY -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay">
        <ul class="mobile-nav-links">
            <li><a href="#about" class="mobile-nav-link">About</a></li>
            <li><a href="#expertise" class="mobile-nav-link">Expertise</a></li>
            <li><a href="#work" class="mobile-nav-link">Work</a></li>
            <li><a href="#skills" class="mobile-nav-link">Skills</a></li>
            <li><a href="#experience" class="mobile-nav-link">Experience</a></li>
            <li><a href="#contact" class="mobile-nav-link">Contact</a></li>
        </ul>
    </div>

    <main class="smooth-scroll-wrapper">
        <!-- 1. HERO SECTION -->
        <section class="hero-section d-flex align-items-center" id="hero">
            <div class="hero-grid-bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 z-index-content">
                        <p class="mono-accent mb-3 reveal-up">HELLO, I AM</p>
                        <h1 class="display-title split-text">TUSHAR KHAMPARIA<br>— UI / FRONTEND<br>DEVELOPER.</h1>
                        <div class="hero-meta reveal-up">
                            <span class="hero-tag"><i class="ti ti-map-pin"></i> Gurugram, India</span>
                            <span class="hero-tag"><i class="ti ti-briefcase"></i> 3 Years Experience</span>
                            <span class="hero-tag"><i class="ti ti-building"></i> iCubesWire</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-indicator">
                <span class="mono-accent">SCROLL TO DISCOVER</span>
                <div class="line"></div>
            </div>
            <!-- Parallax floating elements -->
            <div class="shape shape-1 parallax" data-speed="-2"></div>
            <div class="shape shape-2 parallax" data-speed="1.5"></div>
            <div class="shape shape-3 parallax" data-speed="1"></div>
        </section>

        <hr class="glow-separator">

        <!-- 2. PHILOSOPHY / ABOUT SECTION -->
        <section class="philosophy-section py-8 section-glow" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h2 class="philosophy-text">
                            <span class="scrub-word">UI</span> <span class="scrub-word">/</span> <span class="scrub-word">Frontend</span> <span class="scrub-word">Developer</span> <span class="scrub-word">with</span> <span class="text-accent scrub-word">3 years</span> <span class="scrub-word">of</span> <span class="scrub-word">experience</span> <span class="scrub-word">building</span> <span class="text-accent scrub-word">responsive</span> <span class="text-accent scrub-word">marketing</span> <span class="text-accent scrub-word">websites,</span> <span class="scrub-word">landing</span> <span class="scrub-word">pages,</span> <span class="scrub-word">and</span> <span class="scrub-word">campaign</span> <span class="scrub-word">microsites.</span> <span class="scrub-word">Skilled</span> <span class="scrub-word">in</span> <span class="scrub-word">converting</span> <span class="text-accent scrub-word">Figma</span> <span class="text-accent scrub-word">designs</span> <span class="scrub-word">into</span> <span class="scrub-word">pixel-perfect</span> <span class="scrub-word">web</span> <span class="scrub-word">interfaces.</span>
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. CORE EXPERTISE BLOCK -->
        <section class="expertise-section py-8" id="expertise">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="section-title reveal-up">01. / CORE EXPERTISE</h3>
                        <p class="mono-accent reveal-up">WHAT I BRING TO THE TABLE</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4 expertise-col stagger-up">
                        <div class="expertise-card">
                            <div class="card-glow"></div>
                            <i class="ti ti-code text-accent mb-4" style="font-size: 2.5rem;"></i>
                            <h4 class="mb-3">Responsive UI Development</h4>
                            <p>Pixel-perfect HTML5, CSS3 & JavaScript (ES6). Expert in Figma → Code conversion, mobile-first responsive layouts, and cross-browser compatibility.</p>
                        </div>
                    </div>
                    <div class="col-md-4 expertise-col stagger-up">
                        <div class="expertise-card">
                            <div class="card-glow"></div>
                            <i class="ti ti-layers-intersect text-accent mb-4" style="font-size: 2.5rem;"></i>
                            <h4 class="mb-3">Frameworks & Libraries</h4>
                            <p>Vue.js (Vue 3), React (UI Level), Bootstrap, Tailwind CSS. Building component-driven interfaces with modern JavaScript frameworks.</p>
                        </div>
                    </div>
                    <div class="col-md-4 expertise-col stagger-up">
                        <div class="expertise-card">
                            <div class="card-glow"></div>
                            <i class="ti ti-wand text-accent mb-4" style="font-size: 2.5rem;"></i>
                            <h4 class="mb-3">Animation & Interactivity</h4>
                            <p>GSAP, ScrollTrigger, Swiper.js — crafting scroll-triggered effects, sliders, and custom micro-interactions that bring interfaces to life.</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="row mt-5 pt-4">
                    <div class="col-12">
                        <div class="stats-strip reveal-up">
                            <div class="stat-block">
                                <span class="counter-num" data-target="20">0</span><span class="counter-suffix">+</span>
                                <span class="stat-block-label">Landing Pages Built</span>
                            </div>
                            <div class="stat-block">
                                <span class="counter-num" data-target="3">0</span><span class="counter-suffix">+</span>
                                <span class="stat-block-label">Years Experience</span>
                            </div>
                            <div class="stat-block">
                                <span class="counter-num" data-target="15">0</span><span class="counter-suffix">+</span>
                                <span class="stat-block-label">Live Projects</span>
                            </div>
                            <div class="stat-block">
                                <span class="counter-num" data-target="100">0</span><span class="counter-suffix">%</span>
                                <span class="stat-block-label">Mobile Responsive</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="glow-separator">

        <!-- 4. SELECTED WORKS CAROUSEL -->
        <section class="work-section py-8 section-glow" id="work">
            <div class="container-fluid px-0">
                <div class="container mb-5">
                    <h3 class="section-title reveal-up">02. / SELECTED WORKS</h3>
                    <p class="mono-accent reveal-up">LIVE CLIENT PROJECTS</p>
                </div>

                <!-- Swiper -->
                <div class="swiper work-swiper reveal-up">
                    <div class="swiper-wrapper">

                        <!-- Central Park Studioverse -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/studioverse.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Central Park Studioverse</h4>
                                    <p class="project-desc">Luxury real estate showcase with immersive visual experience and premium UI design.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>JavaScript</span>
                                        <span>GSAP</span>
                                        <span>Swiper.js</span>
                                    </div>
                                    <a href="https://www.centralpark.in/studioverse/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Daawat Main Site -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/daawat.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Daawat.com</h4>
                                    <p class="project-desc">Performance optimization on Laravel-based site — improved PageSpeed scores from 20s–50s range to 90+ across all metrics.</p>
                                    <div class="project-tags">
                                        <span>Laravel</span>
                                        <span>PageSpeed</span>
                                        <span>Performance</span>
                                        <span>SEO</span>
                                    </div>
                                    <a href="https://daawat.com/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Dream Ad with SRK -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/dreamad-srk.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Dream Ad with SRK</h4>
                                    <p class="project-desc">Interactive campaign microsite for Daawat featuring celebrity-driven engagement and dynamic user flow.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>JavaScript</span>
                                        <span>Microsite</span>
                                    </div>
                                    <a href="https://dreamadwithsrk.daawat.com/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Central Park Floral Vista -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/floral-vista.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Central Park Floral Vista</h4>
                                    <p class="project-desc">2026 luxury property landing page with elegant visuals and lead capture forms.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>Bootstrap</span>
                                        <span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/floral-vista-2026/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- iCubesWire 15 Year -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/icubeswire-15year.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">iCubesWire 15th Anniversary</h4>
                                    <p class="project-desc">Celebratory milestone page with timeline-driven storytelling and branded animations.</p>
                                    <div class="project-tags">
                                        <span>GSAP</span>
                                        <span>ScrollTrigger</span>
                                        <span>JavaScript</span>
                                        <span>CSS3</span>
                                    </div>
                                    <a href="https://www.icubeswire.com/15year/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Chintamani 2 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/chintamani2.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Chintamani</h4>
                                    <p class="project-desc">Movie campaign microsite with PHP blog dashboard, secure admin login, TinyMCE editor, and MongoDB integration.</p>
                                    <div class="project-tags">
                                        <span>PHP</span>
                                        <span>MongoDB</span>
                                        <span>TinyMCE</span>
                                        <span>Admin Panel</span>
                                    </div>
                                    <a href="https://icubeswire.com/projects/chintamani2" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Chintamani 2 Phase 2 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/chintamani2-phase2.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Chintamani — Phase 2</h4>
                                    <p class="project-desc">Extended campaign with CRUD blog system, secure authentication, and enhanced interactive UI features.</p>
                                    <div class="project-tags">
                                        <span>PHP</span>
                                        <span>MySQL</span>
                                        <span>GSAP</span>
                                        <span>JavaScript</span>
                                    </div>
                                    <a href="https://icubeswire.com/projects/chintamani2/phase-2" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Central Park Selene -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/selene.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Central Park Selene</h4>
                                    <p class="project-desc">Theme-based luxury real estate landing page with high-end conversion-focused design.</p>
                                    <div class="project-tags">
                                        <span>Figma to Code</span>
                                        <span>Tailwind CSS</span>
                                        <span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/selene-lp/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- IIC 2023 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/iic23.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">India Influencer Conclave 2023</h4>
                                    <p class="project-desc">Major influencer event platform with dynamic content sections and registration system.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>Bootstrap</span>
                                        <span>JavaScript</span>
                                        <span>Multi-page</span>
                                    </div>
                                    <a href="https://indiainfluencerconclave.com/iic23/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Conclave 2024 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/conclave24.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">India Influencer Conclave 2024</h4>
                                    <p class="project-desc">Updated event platform with refreshed design, speaker showcase, and agenda integration.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>Bootstrap</span>
                                        <span>JavaScript</span>
                                        <span>Responsive</span>
                                    </div>
                                    <a href="https://indiainfluencerconclave.com/conclave24/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Central Park Belanova -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/belanova.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Central Park Belanova</h4>
                                    <p class="project-desc">Elegant property landing page with premium UI, gallery showcase, and lead capture.</p>
                                    <div class="project-tags">
                                        <span>Figma to Code</span>
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/belanova-lp/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Central Park Belaperla -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/belaperla.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Central Park Belaperla</h4>
                                    <p class="project-desc">High-end property showcase with immersive hero visuals and conversion-optimized layout.</p>
                                    <div class="project-tags">
                                        <span>Figma to Code</span>
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>Bootstrap</span>
                                    </div>
                                    <a href="https://www.centralpark.in/belaperla/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Digital Market Survey -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/dms.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Digital Market Survey</h4>
                                    <p class="project-desc">Full-stack survey platform with custom PHP admin dashboard panels for data management and analytics.</p>
                                    <div class="project-tags">
                                        <span>PHP</span>
                                        <span>MySQL</span>
                                        <span>Admin Panel</span>
                                        <span>JavaScript</span>
                                    </div>
                                    <a href="https://digitalmarketsurvey.com/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- IIGC -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/iigc.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">IIGC</h4>
                                    <p class="project-desc">Indian Influencer Governing Council — responsive governance platform with dynamic content sections.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>JavaScript</span>
                                        <span>Responsive</span>
                                    </div>
                                    <a href="https://iigc.org" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Central Park Orchard -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/orchard.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Central Park The Orchard</h4>
                                    <p class="project-desc">Property landing page with nature-inspired visuals and responsive lead generation flow.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>Bootstrap</span>
                                        <span>Landing Page</span>
                                    </div>
                                    <a href="https://www.centralpark.in/the-orchard-lp-test/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- iCubesWire Main -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/icubeswire.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">iCubesWire</h4>
                                    <p class="project-desc">Corporate website UI maintenance, component optimization, and ongoing layout improvements.</p>
                                    <div class="project-tags">
                                        <span>WordPress</span>
                                        <span>CSS3</span>
                                        <span>JavaScript</span>
                                        <span>Maintenance</span>
                                    </div>
                                    <a href="https://icubeswire.com" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Central Park Studioverse Old -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('assets/images/projects/studioverse-old.png');"></div>
                                <div class="overlay"></div>
                                <div class="project-content">
                                    <h4 class="project-title">Studioverse (Legacy)</h4>
                                    <p class="project-desc">Original Studioverse property page — earlier iteration with full responsive implementation.</p>
                                    <div class="project-tags">
                                        <span>HTML5</span>
                                        <span>CSS3</span>
                                        <span>JavaScript</span>
                                        <span>Responsive</span>
                                    </div>
                                    <a href="https://www.centralpark.in/studioverse-old/" target="_blank" rel="noopener" class="project-link">Visit Live <i class="ti ti-external-link"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Navigation Arrows -->
                    <div class="swiper-nav-wrapper">
                        <button class="swiper-btn swiper-btn-prev"><i class="ti ti-arrow-left"></i></button>
                        <div class="swiper-pagination"></div>
                        <button class="swiper-btn swiper-btn-next"><i class="ti ti-arrow-right"></i></button>
                    </div>
                </div>
                <div class="container text-center mt-5 reveal-up">
                    <a href="projects.php" class="nav-cta" style="display: inline-flex; text-decoration: none;">View All Projects <i class="ti ti-arrow-right ms-2"></i></a>
                </div>
            </div>
        </section>

        <hr class="glow-separator">

        <!-- 5. THE ENGINE (AI Workflows) -->
        <section class="engine-section py-8 section-glow" id="engine">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0 reveal-up">
                        <h3 class="section-title">03. / THE ENGINE</h3>
                        <h2 class="display-4 fw-bold mb-4 mt-4">AI-Augmented<br>Workflow</h2>
                        <p class="lead text-light-gray" style="line-height: 1.8;">
                            I've always been a hands-on UI developer — writing every line of code myself, from pixel-perfect layouts to complex GSAP animations. Now, with AI agents like <span class="text-white fw-bold">Antigravity, Google Gemini, ChatGPT, Veo, Whisk & Stitch</span>, I use them as force multipliers — speeding up my workflow while keeping full creative control over the output. The craft stays mine, the <span class="text-accent fw-bold fs-4">speed just triples</span>.
                        </p>
                        <div class="ai-tools-list">
                            <span class="ai-tool-pill">Antigravity</span>
                            <span class="ai-tool-pill">Google Gemini</span>
                            <span class="ai-tool-pill">ChatGPT</span>
                            <span class="ai-tool-pill">Veo</span>
                            <span class="ai-tool-pill">Whisk</span>
                            <span class="ai-tool-pill">Stitch</span>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1 reveal-up">
                        <div class="ai-stats-box">
                            <div class="stat-item">
                                <span class="stat-num text-accent">3x</span>
                                <span class="stat-label">Faster Prototyping</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-num text-accent">20+</span>
                                <span class="stat-label">Pages Delivered</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-num text-accent">AI</span>
                                <span class="stat-label">Orchestration</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="glow-separator">

        <!-- 6. TECH STACK / SKILLS -->
        <section class="skills-section py-8 section-glow" id="skills">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="section-title reveal-up">04. / TECH STACK</h3>
                        <p class="mono-accent reveal-up">TOOLS & TECHNOLOGIES</p>
                    </div>
                </div>

                <div class="skills-grid reveal-up">
                    <div class="skill-category">
                        <h5 class="skill-cat-title">Frontend</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-html5-plain"></i> HTML5</span>
                            <span class="skill-pill"><i class="devicon-css3-plain"></i> CSS3</span>
                            <span class="skill-pill"><i class="devicon-javascript-plain"></i> JavaScript (ES6)</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">Frameworks</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-vuejs-plain"></i> Vue.js (Vue 3)</span>
                            <span class="skill-pill"><i class="devicon-react-original"></i> React (UI Level)</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">CSS Frameworks</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-bootstrap-plain"></i> Bootstrap</span>
                            <span class="skill-pill"><i class="devicon-tailwindcss-original"></i> Tailwind CSS</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">Animation & UI</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="ti ti-brand-gsap"></i> GSAP</span>
                            <span class="skill-pill"><i class="ti ti-carousel-horizontal"></i> Swiper.js</span>
                            <span class="skill-pill"><i class="ti ti-scroll"></i> ScrollTrigger</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">CMS</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-wordpress-plain"></i> WordPress</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">Backend & Cloud</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-php-plain"></i> PHP</span>
                            <span class="skill-pill"><i class="devicon-amazonwebservices-plain-wordmark"></i> AWS</span>
                            <span class="skill-pill"><i class="ti ti-server"></i> EC2 / S3</span>
                            <span class="skill-pill"><i class="ti ti-terminal-2"></i> PuTTY</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">Databases</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-mysql-plain"></i> MySQL</span>
                            <span class="skill-pill"><i class="devicon-mongodb-plain"></i> MongoDB</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">Tools & Platforms</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-vscode-plain"></i> VS Code</span>
                            <span class="skill-pill"><i class="devicon-git-plain"></i> Git / GitHub</span>
                            <span class="skill-pill"><i class="devicon-figma-plain"></i> Figma</span>
                            <span class="skill-pill"><i class="devicon-chrome-plain"></i> Chrome DevTools</span>
                            <span class="skill-pill"><i class="ti ti-sparkles"></i> Antigravity</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">Integrations</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="devicon-google-plain"></i> Form → Google Sheets</span>
                            <span class="skill-pill"><i class="devicon-google-plain"></i> Google Apps Script</span>
                            <span class="skill-pill"><i class="devicon-php-plain"></i> PHP Forms</span>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h5 class="skill-cat-title">AI Tools</h5>
                        <div class="skill-pills">
                            <span class="skill-pill"><i class="ti ti-brand-openai"></i> ChatGPT</span>
                            <span class="skill-pill"><i class="devicon-google-plain"></i> Google Gemini</span>
                            <span class="skill-pill"><i class="ti ti-video"></i> Veo</span>
                            <span class="skill-pill"><i class="ti ti-wand"></i> Whisk</span>
                            <span class="skill-pill"><i class="ti ti-needle"></i> Stitch</span>
                        </div>
                    </div>
                </div>

                <!-- Marquee Strip -->
                <div class="marquee-wrapper reveal-up">
                    <div class="marquee-track">
                        <div class="marquee-content">
                            <span>HTML5</span><span>CSS3</span><span>JavaScript</span><span>Vue.js</span><span>React</span><span>Bootstrap</span><span>Tailwind CSS</span><span>GSAP</span><span>Swiper.js</span><span>ScrollTrigger</span><span>WordPress</span><span>Git</span><span>Figma</span><span>PHP</span><span>MySQL</span><span>MongoDB</span><span>AWS</span><span>Google Apps Script</span><span>Antigravity</span><span>Gemini</span><span>ChatGPT</span>
                            <!-- Duplicate for seamless loop -->
                            <span>HTML5</span><span>CSS3</span><span>JavaScript</span><span>Vue.js</span><span>React</span><span>Bootstrap</span><span>Tailwind CSS</span><span>GSAP</span><span>Swiper.js</span><span>ScrollTrigger</span><span>WordPress</span><span>Git</span><span>Figma</span><span>PHP</span><span>MySQL</span><span>MongoDB</span><span>AWS</span><span>Google Apps Script</span><span>Antigravity</span><span>Gemini</span><span>ChatGPT</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="glow-separator">

        <!-- 7. EXPERIENCE TIMELINE -->
        <section class="experience-section py-8 section-glow" id="experience">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="section-title reveal-up">05. / EXPERIENCE</h3>
                        <p class="mono-accent reveal-up">PROFESSIONAL JOURNEY</p>
                    </div>
                </div>

                <div class="timeline">
                    <!-- Role 1 -->
                    <div class="timeline-item timeline-reveal">
                        <div class="timeline-marker">
                            <div class="marker-dot"></div>
                        </div>
                        <div class="timeline-card">
                            <div class="timeline-header">
                                <div>
                                    <h4 class="timeline-role">UI Developer</h4>
                                    <p class="timeline-company">iCubesWire <span class="timeline-location">· Gurugram, India</span></p>
                                </div>
                                <span class="timeline-period">Aug 2023 – Present</span>
                            </div>
                            <ul class="timeline-duties">
                                <li>Developed 20+ responsive landing pages and campaign microsites for marketing campaigns.</li>
                                <li>Converted Figma designs into pixel-perfect responsive websites using HTML, CSS, and JavaScript.</li>
                                <li>Implemented interactive UI components, sliders, and scroll-based animations using GSAP and Swiper.</li>
                                <li>Built and integrated lead-generation forms, sending user data to Google Sheets via Apps Script.</li>
                                <li>Created a secure PHP blog dashboard with TinyMCE editor, CRUD operations, and MongoDB integration for the Chintamani campaign.</li>
                                <li>Managed AWS infrastructure — EC2 instances, Elastic IPs, S3 bucket configuration, and server access via PuTTY.</li>
                                <li>Ensured cross-browser compatibility and mobile responsiveness across major devices and browsers.</li>
                                <li>Maintained and updated live client websites based on campaign updates and change requests.</li>
                                <li>Collaborated closely with designers and backend developers to deliver optimized UI implementations.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Role 2 -->
                    <div class="timeline-item timeline-reveal">
                        <div class="timeline-marker">
                            <div class="marker-dot"></div>
                        </div>
                        <div class="timeline-card">
                            <div class="timeline-header">
                                <div>
                                    <h4 class="timeline-role">Web Developer Intern</h4>
                                    <p class="timeline-company">iCubesWire <span class="timeline-location">· Gurugram, India</span></p>
                                </div>
                                <span class="timeline-period">May 2023 – Jul 2023</span>
                            </div>
                            <ul class="timeline-duties">
                                <li>Assisted in developing responsive web pages using HTML, CSS, and Bootstrap.</li>
                                <li>Converted design mockups into functional frontend layouts.</li>
                                <li>Supported UI debugging, responsiveness improvements, and frontend updates.</li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
        </section>

        <hr class="glow-separator">

        <!-- 8. FOOTER & CONTACT -->
        <footer class="footer-section py-8 section-glow" id="contact">
            <div class="container">
                <div class="row justify-content-center text-center mb-5 reveal-up">
                    <div class="col-lg-8">
                        <p class="mono-accent mb-3">06. / GET IN TOUCH</p>
                        <h2 class="footer-headline">Let's Build Something<br><span class="text-accent">Unforgettable.</span></h2>
                        <p class="text-light-gray mt-3" style="font-size: 1.1rem; line-height: 1.7;">Have a project in mind or want to discuss a collaboration? I'd love to hear from you. Drop me a message and I'll get back to you soon.</p>
                    </div>
                </div>

                <div class="row justify-content-center reveal-up">
                    <div class="col-lg-8">
                        <div class="contact-form-wrapper">
                            <form class="custom-form" action="" method="POST" onsubmit="event.preventDefault();">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="contact-name" class="form-label-custom">Your Name</label>
                                        <input type="text" class="form-input" id="contact-name" placeholder="John Doe" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-email" class="form-label-custom">Email Address</label>
                                        <input type="email" class="form-input" id="contact-email" placeholder="john@example.com" required>
                                    </div>
                                    <div class="form-group form-group-full">
                                        <label for="contact-subject" class="form-label-custom">Subject</label>
                                        <input type="text" class="form-input" id="contact-subject" placeholder="Project collaboration, freelance inquiry, etc.">
                                    </div>
                                    <div class="form-group form-group-full">
                                        <label for="contact-message" class="form-label-custom">Your Message</label>
                                        <textarea class="form-input form-textarea" id="contact-message" placeholder="Tell me about your project, timeline, and budget..." required></textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-custom">
                                        <span>SEND MESSAGE</span>
                                        <i class="ti ti-send ms-2 fs-4"></i>
                                    </button>
                                    <p class="form-hint">I typically respond within 24 hours.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-8 pt-5 border-top border-dark align-items-center reveal-up">
                    <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                        <p class="mb-0 text-muted">&copy; <?php echo date("Y"); ?> Tushar Khamparia. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="social-links">
                            <a href="mailto:khampariatushar@gmail.com" class="social-link" target="_blank">Email</a>
                            <a href="https://linkedin.com/in/tushar-khamparia-138432192" class="social-link" target="_blank">LinkedIn</a>
                            <a href="https://github.com/" class="social-link" target="_blank">GitHub</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
                    // Randomly choose horizontal or vertical
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
                    const limit = this.horizontal ? w + this.length : h + this.length;
                    if (this.pos > limit) this.reset();
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
                        const y = this.row * cellSize;
                        ctx.moveTo(this.pos - this.length, y);
                        ctx.lineTo(this.pos, y);
                    } else {
                        const x = this.col * cellSize;
                        ctx.moveTo(x, this.pos - this.length);
                        ctx.lineTo(x, this.pos);
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
                // Vertical lines
                for (let i = 0; i <= cols; i++) {
                    ctx.beginPath();
                    ctx.moveTo(i * cellSize, 0);
                    ctx.lineTo(i * cellSize, h);
                    ctx.stroke();
                }
                // Horizontal lines
                for (let j = 0; j <= rows; j++) {
                    ctx.beginPath();
                    ctx.moveTo(0, j * cellSize);
                    ctx.lineTo(w, j * cellSize);
                    ctx.stroke();
                }
                // Intersection dots
                ctx.fillStyle = `rgba(${r},${g},${b},0.08)`;
                for (let i = 0; i <= cols; i++) {
                    for (let j = 0; j <= rows; j++) {
                        ctx.beginPath();
                        ctx.arc(i * cellSize, j * cellSize, 1.2, 0, Math.PI * 2);
                        ctx.fill();
                    }
                }
            }

            function init() {
                resize();
                for (let i = 0; i < maxLines; i++) {
                    const line = new GridLine();
                    line.pos = Math.random() * (w + h); // stagger starting positions
                    lines.push(line);
                }
            }

            function animate() {
                ctx.clearRect(0, 0, w, h);
                drawGrid();
                lines.forEach(line => {
                    line.update();
                    line.draw();
                });
                requestAnimationFrame(animate);
            }

            window.addEventListener('resize', resize);
            init();
            animate();
        })();
    </script>

    <script src="assets/js/script.js"></script>
</body>

</html>