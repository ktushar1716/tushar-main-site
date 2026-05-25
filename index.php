<?php
// Tushar Khamparia - Portfolio
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tushar Khamparia | Frontend Engineer & UI Architect</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Outfit:wght@400;600;800;900&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 (Grid only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="dark-theme">
    <div class="custom-cursor"></div>
    <div class="custom-cursor-follower"></div>

    <main class="smooth-scroll-wrapper">
        <!-- 1. HERO SECTION -->
        <section class="hero-section d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 z-index-content">
                        <p class="mono-accent mb-3 reveal-up">HELLO, I AM</p>
                        <h1 class="display-title split-text">TUSHAR KHAMPARIA<br>— FRONTEND ENGINEER <br>& UI ARCHITECT.</h1>
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
        </section>

        <!-- 2. PHILOSOPHY / INTRO SECTION -->
        <section class="philosophy-section py-8">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h2 class="philosophy-text">
                            <span class="scrub-word">Bridging</span> <span class="scrub-word">the</span> <span class="scrub-word">gap</span> <span class="scrub-word">between</span> <span class="text-accent scrub-word">pixel-perfect</span> <span class="text-accent scrub-word">design</span> <span class="text-accent scrub-word">systems</span> <span class="scrub-word">and</span> <span class="scrub-word">fluid</span> <span class="scrub-word">front-end</span> <span class="scrub-word">motion.</span> <span class="scrub-word">Orchestrating</span> <span class="scrub-word">modern</span> <span class="scrub-word">web</span> <span class="scrub-word">architectures</span> <span class="scrub-word">and</span> <span class="scrub-word">AI-driven</span> <span class="scrub-word">workflows</span> <span class="scrub-word">to</span> <span class="scrub-word">ship</span> <span class="scrub-word">interfaces</span> <span class="scrub-word">at</span> <span class="text-accent scrub-word">maximum</span> <span class="text-accent scrub-word">velocity.</span>
                        </h2>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. CORE EXPERTISE BLOCK -->
        <section class="expertise-section py-8">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h3 class="section-title reveal-up">01. / CORE EXPERTISE</h3>
                        <p class="mono-accent reveal-up">3 YEARS OF EXPERIENCE</p>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-md-4 expertise-col stagger-up">
                        <div class="expertise-card">
                            <i class="fa-solid fa-wand-magic-sparkles text-accent mb-4 fs-1"></i>
                            <h4 class="mb-3">Advanced Interactivity</h4>
                            <p>GSAP, ScrollTrigger, Swiper.js, Custom Micro-interactions.</p>
                        </div>
                    </div>
                    <div class="col-md-4 expertise-col stagger-up">
                        <div class="expertise-card">
                            <i class="fa-solid fa-layer-group text-accent mb-4 fs-1"></i>
                            <h4 class="mb-3">Architecture & Frameworks</h4>
                            <p>Vue.js/Vue 3, React UI, Bootstrap 5, Tailwind CSS, Semantics.</p>
                        </div>
                    </div>
                    <div class="col-md-4 expertise-col stagger-up">
                        <div class="expertise-card">
                            <i class="fa-solid fa-rocket text-accent mb-4 fs-1"></i>
                            <h4 class="mb-3">Modern Delivery</h4>
                            <p>Git/GitHub workflows, AWS Cloud deployments, Automated Pipelines, Google Apps Script APIs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. IMMERSIVE CASE STUDIES CAROUSEL -->
        <section class="work-section py-8">
            <div class="container-fluid px-0">
                <div class="container mb-5">
                    <h3 class="section-title reveal-up">02. / SELECTED WORKS</h3>
                </div>
                
                <!-- Swiper -->
                <div class="swiper work-swiper reveal-up">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=1200');">
                                    <div class="overlay"></div>
                                </div>
                                <div class="project-content">
                                    <h4 class="project-title">Daawat Rice</h4>
                                    <p class="project-desc">Saffron Rice & RYA Campaign Microsites</p>
                                    <div class="project-tags">
                                        <span>UI Development</span>
                                        <span>Micro-interactions</span>
                                        <span>High Velocity</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=1200');">
                                    <div class="overlay"></div>
                                </div>
                                <div class="project-content">
                                    <h4 class="project-title">Central Park Real Estate</h4>
                                    <p class="project-desc">Selerie LP</p>
                                    <div class="project-tags">
                                        <span>Figma to Code</span>
                                        <span>Conversion Focused</span>
                                        <span>High-End Luxury UI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1540317580384-e5d43867caa6?auto=format&fit=crop&q=80&w=1200');">
                                    <div class="overlay"></div>
                                </div>
                                <div class="project-content">
                                    <h4 class="project-title">Indian Influencer Conclave</h4>
                                    <p class="project-desc">IICC / IIGC Platforms</p>
                                    <div class="project-tags">
                                        <span>Responsive Infrastructure</span>
                                        <span>Campaign Delivery</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 4 -->
                        <div class="swiper-slide">
                            <div class="project-card">
                                <div class="project-image" style="background-image: url('https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&q=80&w=1200');">
                                    <div class="overlay"></div>
                                </div>
                                <div class="project-content">
                                    <h4 class="project-title">iCubesWire</h4>
                                    <p class="project-desc">Corporate Modules</p>
                                    <div class="project-tags">
                                        <span>Component Maintenance</span>
                                        <span>Layout Optimization</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination mt-5"></div>
                </div>
            </div>
        </section>

        <!-- 5. THE ENGINE (AI Workflows) -->
        <section class="engine-section py-8">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0 reveal-up">
                        <h3 class="section-title">03. / THE ENGINE</h3>
                        <h2 class="display-4 fw-bold mb-4 mt-4">AI-Driven <br>Workflow</h2>
                        <p class="lead text-light-gray" style="line-height: 1.8;">
                            Orchestrating modern AI tools like <span class="text-white fw-bold">Antigravity, Gemini, and ChatGPT</span> to not just write code, but to accelerate prototyping, automate pipeline deployments, and increase client delivery rates by <span class="text-accent fw-bold fs-4">3x</span>.
                        </p>
                    </div>
                    <div class="col-lg-5 offset-lg-1 reveal-up">
                        <div class="ai-stats-box">
                            <div class="stat-item">
                                <span class="stat-num text-accent">3x</span>
                                <span class="stat-label">Faster Prototyping</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-num text-accent">100%</span>
                                <span class="stat-label">Code Quality</span>
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

        <!-- 6. FOOTER & CONTACT -->
        <footer class="footer-section py-8">
            <div class="container">
                <div class="row justify-content-center text-center mb-5 reveal-up">
                    <div class="col-12">
                        <h2 class="footer-headline">Let's Build Something<br><span class="text-accent">Unforgettable.</span></h2>
                    </div>
                </div>
                <div class="row justify-content-center reveal-up">
                    <div class="col-lg-8">
                        <form class="custom-form" action="" method="POST" onsubmit="event.preventDefault();">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Name" required>
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Email" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="project" placeholder="Project Brief" style="height: 120px" required></textarea>
                                        <label for="project">Project Brief</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-5">
                                    <button type="submit" class="btn-custom">SEND MESSAGE <i class="fa-solid fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="row mt-8 pt-5 border-top border-dark align-items-center reveal-up">
                    <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                        <p class="mb-0 text-muted">&copy; <?php echo date("Y"); ?> Tushar Khamparia. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="social-links">
                            <a href="mailto:khampariatushar@gmail.com" class="social-link" target="_blank">Email</a>
                            <a href="https://linkedin.com/" class="social-link" target="_blank">LinkedIn</a>
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
    <script src="assets/js/script.js"></script>
</body>
</html>
