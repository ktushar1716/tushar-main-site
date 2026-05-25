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
        const interactables = document.querySelectorAll('a, button, input, textarea');
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
        if(cursor) cursor.style.display = 'none';
        if(follower) follower.style.display = 'none';
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

    // Reveal staggered hero text
    tl.to('.split-text .word span', {
        y: '0%',
        duration: 1.2,
        stagger: 0.05,
        ease: 'power4.out'
    });

    // Reveal subheadings
    tl.fromTo('.hero-section .reveal-up', 
        { y: 30, opacity: 0 }, 
        { y: 0, opacity: 1, duration: 1, ease: 'power3.out' }, 
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
        }
    });

});
