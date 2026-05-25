// Initialize GSAP Plugins
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {

    /* ==========================================
       Custom Cursor Implementation
       ========================================== */
    const cursor = document.querySelector('.custom-cursor');
    const follower = document.querySelector('.custom-cursor-follower');

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
    const interactables = document.querySelectorAll('a, button, .project-card, input, textarea');
    interactables.forEach(el => {
        el.addEventListener('mouseenter', () => {
            gsap.to(cursor, { scale: 0.5, opacity: 0.5, duration: 0.3 });
            gsap.to(follower, { 
                scale: 1.5, 
                borderColor: 'transparent', 
                backgroundColor: 'rgba(203, 251, 69, 0.1)', 
                duration: 0.3 
            });
        });
        el.addEventListener('mouseleave', () => {
            gsap.to(cursor, { scale: 1, opacity: 1, duration: 0.3 });
            gsap.to(follower, { 
                scale: 1, 
                borderColor: '#cbfb45', 
                backgroundColor: 'transparent', 
                duration: 0.3 
            });
        });
    });

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
    window.addEventListener('load', () => {
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
    });

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
        slidesPerView: 1.1,
        spaceBetween: 20,
        centeredSlides: true,
        grabCursor: true,
        loop: true,
        speed: 800,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2.2,
                spaceBetween: 40,
                centeredSlides: false
            },
            1200: {
                slidesPerView: 2.5,
                spaceBetween: 50,
                centeredSlides: false
            }
        }
    });

});
