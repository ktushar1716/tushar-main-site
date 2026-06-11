// Initialize GSAP Plugins
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {

    /* ==========================================
       Lenis Smooth Scroll Setup
       ========================================== */
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smooth: true,
    });

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);

    /* ==========================================
       Navbar Scroll Behavior
       ========================================== */
    const siteNav = document.getElementById('siteNav');
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section[id], footer[id]');

    // Transparent → glassmorphic on scroll
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            siteNav.classList.add('scrolled');
        } else {
            siteNav.classList.remove('scrolled');
        }
    });

    // Active section highlighting
    const observerOptions = {
        root: null,
        rootMargin: '-20% 0px -60% 0px',
        threshold: 0
    };

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${id}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }, observerOptions);

    sections.forEach(section => sectionObserver.observe(section));

    /* ==========================================
       Mobile Hamburger Menu
       ========================================== */
    const hamburger = document.getElementById('navHamburger');
    const mobileOverlay = document.getElementById('mobileNavOverlay');
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');

    if (hamburger && mobileOverlay) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
            document.body.style.overflow = mobileOverlay.classList.contains('active') ? 'hidden' : '';
        });

        // Close on link click
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }

    /* ==========================================
       Custom Cursor Implementation
       ========================================== */
    const isTouchDevice = window.matchMedia("(pointer: coarse)").matches;
    const cursor = document.querySelector('.custom-cursor');
    const follower = document.querySelector('.custom-cursor-follower');

    if (!isTouchDevice) {
        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;
        let followerX = 0, followerY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        // Smooth follow using GSAP ticker
        gsap.ticker.add(() => {
            cursorX += (mouseX - cursorX) * 0.5;
            cursorY += (mouseY - cursorY) * 0.5;
            gsap.set(cursor, { x: cursorX, y: cursorY });
            
            followerX += (mouseX - followerX) * 0.15;
            followerY += (mouseY - followerY) * 0.15;
            gsap.set(follower, { x: followerX, y: followerY });
        });

        // Interactive Hover States
        const interactables = document.querySelectorAll('a, button, input, textarea, .skill-pill, .ai-tool-pill');
        interactables.forEach(el => {
            el.addEventListener('mouseenter', () => {
                gsap.to(cursor, { scale: 0.5, opacity: 0.5, duration: 0.3 });
                gsap.to(follower, { 
                    scale: 1.5, 
                    borderColor: 'transparent', 
                    backgroundColor: 'rgba(56, 189, 248, 0.1)', 
                    duration: 0.3 
                });
            });
            el.addEventListener('mouseleave', () => {
                gsap.to(cursor, { scale: 1, opacity: 1, duration: 0.3 });
                gsap.to(follower, { 
                    scale: 1, 
                    borderColor: '#38bdf8', 
                    backgroundColor: 'transparent', 
                    duration: 0.3 
                });
            });
        });

        // Exciting Project Card Hover
        const projectCards = document.querySelectorAll('.project-card');
        projectCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(cursor, { scale: 0, opacity: 0, duration: 0.3 });
                follower.innerHTML = '<span style="color:#020617; font-family:var(--font-mono); font-size:10px; font-weight:bold; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); pointer-events:none; letter-spacing:1px;">DRAG</span>';
                gsap.to(follower, { 
                    scale: 2.5, 
                    borderColor: 'transparent', 
                    backgroundColor: '#38bdf8', 
                    duration: 0.3 
                });
            });
            card.addEventListener('mouseleave', () => {
                gsap.to(cursor, { scale: 1, opacity: 1, duration: 0.3 });
                follower.innerHTML = '';
                gsap.to(follower, { 
                    scale: 1, 
                    borderColor: '#38bdf8', 
                    backgroundColor: 'transparent', 
                    duration: 0.3 
                });
            });
        });
    } else {
        // Touch device: hide custom cursor, restore default
        if(cursor) cursor.style.display = 'none';
        if(follower) follower.style.display = 'none';
        document.body.style.cursor = 'auto';
    }

    /* ==========================================
       Hero Text Splitting (Custom setup)
       ========================================== */
    const splitTextElements = document.querySelectorAll('.split-text');
    splitTextElements.forEach(el => {
        const htmlContent = el.innerHTML;
        const lines = htmlContent.split('<br>');
        el.innerHTML = '';
        
        lines.forEach((line, index) => {
            const words = line.trim().split(' ');
            words.forEach(word => {
                if(word !== '') {
                    const wordWrap = document.createElement('span');
                    wordWrap.classList.add('word');
                    const innerSpan = document.createElement('span');
                    innerSpan.innerHTML = word;
                    wordWrap.appendChild(innerSpan);
                    el.appendChild(wordWrap);
                }
            });
            if (index < lines.length - 1) {
                el.appendChild(document.createElement('br'));
            }
        });
    });

    /* ==========================================
       Initial Load Animations (Timeline)
       ========================================== */
    const tl = gsap.timeline();

    // Fade in navbar
    tl.fromTo('.site-nav',
        { y: -20, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.8, ease: 'power3.out' }
    );

    // Reveal staggered hero text
    tl.to('.split-text .word span', {
        y: '0%',
        duration: 1.2,
        stagger: 0.05,
        ease: 'power4.out'
    }, "-=0.4");

    // Reveal subheadings & hero meta
    tl.fromTo('.hero-section .reveal-up', 
        { y: 30, opacity: 0 }, 
        { y: 0, opacity: 1, duration: 1, ease: 'power3.out', stagger: 0.15 }, 
        "-=0.8"
    );
    
    // Reveal scroll indicator
    tl.fromTo('.scroll-indicator', 
        { opacity: 0 }, 
        { opacity: 1, duration: 1, ease: 'power2.out' }, 
        "-=0.5"
    );

    /* ==========================================
       ScrollTrigger Animations
       ========================================== */
    
    // 1. Hero Parallax Floating Elements
    gsap.utils.toArray('.parallax').forEach(layer => {
        const speed = layer.getAttribute('data-speed');
        gsap.to(layer, {
            y: () => (ScrollTrigger.maxScroll(window) * speed * 0.1),
            ease: "none",
            scrollTrigger: {
                trigger: '.hero-section',
                start: "top top",
                end: "bottom top",
                scrub: true
            }
        });
    });

    // 2. Philosophy Text Scrub Reveal
    gsap.to('.scrub-word', {
        opacity: 1,
        stagger: 0.1,
        scrollTrigger: {
            trigger: '.philosophy-section',
            start: 'top 80%',
            end: 'bottom 40%',
            scrub: 1
        }
    });

    // 3. General Elements Reveal Up
    gsap.utils.toArray('.reveal-up').forEach(elem => {
        // Skip hero ones (handled by initial timeline)
        if (elem.closest('.hero-section')) return;
        
        gsap.fromTo(elem, 
            { y: 50, opacity: 0 },
            {
                y: 0, opacity: 1, duration: 1, ease: 'power3.out',
                scrollTrigger: {
                    trigger: elem,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                }
            }
        );
    });

    // 4. Staggered Expertise Cards
    gsap.fromTo('.expertise-col', 
        { y: 50, opacity: 0 },
        {
            y: 0, opacity: 1, duration: 0.8, stagger: 0.2, ease: 'power3.out',
            scrollTrigger: {
                trigger: '.expertise-section',
                start: 'top 75%'
            }
        }
    );

    // 5. Counter Animations
    const counterNums = document.querySelectorAll('.counter-num');
    counterNums.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        
        ScrollTrigger.create({
            trigger: counter,
            start: 'top 85%',
            onEnter: () => {
                gsap.to(counter, {
                    innerText: target,
                    duration: 2,
                    ease: 'power2.out',
                    snap: { innerText: 1 },
                    onUpdate: function() {
                        counter.textContent = Math.round(parseFloat(counter.textContent));
                    }
                });
            },
            once: true
        });
    });

    // 6. Timeline Cards Staggered Reveal
    gsap.utils.toArray('.timeline-reveal').forEach((item, i) => {
        gsap.fromTo(item, 
            { x: -30, opacity: 0 },
            {
                x: 0, opacity: 1, duration: 0.8, ease: 'power3.out',
                scrollTrigger: {
                    trigger: item,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                },
                delay: i * 0.15
            }
        );
    });

    // 7. Skill Categories Staggered Reveal
    gsap.utils.toArray('.skill-category').forEach((cat, i) => {
        gsap.fromTo(cat, 
            { y: 30, opacity: 0 },
            {
                y: 0, opacity: 1, duration: 0.6, ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.skills-grid',
                    start: 'top 80%',
                },
                delay: i * 0.08
            }
        );
    });

    /* ==========================================
       Swiper.js Initialization
       ========================================== */
    const workSwiper = new Swiper('.work-swiper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        loop: true,
        speed: 800,
        coverflowEffect: {
            rotate: 20,
            stretch: 0,
            depth: 250,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-btn-next',
            prevEl: '.swiper-btn-prev',
        },
        // Better touch settings for mobile
        touchRatio: 1.5,
        simulateTouch: true,
    });

    /* ==========================================
       Smooth scroll for anchor links
       ========================================== */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
                lenis.scrollTo(targetEl, { offset: -72 }); // offset for navbar height
            }
        });
    });

});
