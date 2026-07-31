/* ==========================================================================
   A BIRTHDAY LETTER — script.js
   --------------------------------------------------------------------------
   01. Helpers
   02. Toast (used by the easter eggs)
   03. Cinematic loader
   04. Reveal on scroll
   05. Scroll progress
   06. Smooth anchors + page transitions
   07. Navbar
   08. Cursor glow
   09. Starfield
   10. Parallax
   11. Background music
   12. Image fallbacks
   13. Reason cards (flip)
   14. Gallery lightbox
   15. Open-when letters
   16. Countdown
   17. Easter eggs
   ========================================================================== */

(function () {
    'use strict';

    /* ======================================================================
       01. HELPERS
       ====================================================================== */
    const $  = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

    const prefersReducedMotion =
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const isTouch = window.matchMedia('(hover: none)').matches;

    const clamp = (n, min, max) => Math.min(Math.max(n, min), max);

    /** requestAnimationFrame-throttled event handler. */
    function onFrame(handler) {
        let ticking = false;
        return function () {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(() => {
                handler();
                ticking = false;
            });
        };
    }

    /** Small safe wrapper around sessionStorage (private mode can throw). */
    const store = {
        get(key) {
            try { return window.sessionStorage.getItem(key); } catch (e) { return null; }
        },
        set(key, value) {
            try { window.sessionStorage.setItem(key, value); } catch (e) { /* ignore */ }
        }
    };


    /* ======================================================================
       02. TOAST — how every hidden message is delivered
       ====================================================================== */
    const toastEl = $('#toast');
    let toastTimer = null;

    function toast(message, label = 'you found something') {
        if (!toastEl) return;

        toastEl.innerHTML =
            '<span class="toast__label">' + label + '</span>' + message;
        toastEl.classList.add('is-on');

        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toastEl.classList.remove('is-on'), 6000);
    }


    /* ======================================================================
       03. CINEMATIC LOADER
       "Someone made something…" → "Just for you…" → "Happy Birthday ❤"
       Runs once per browser session, then never gets in the way again.
       ====================================================================== */
    const loader = $('#loader');
    const pageEl = $('#page');

    // Resolves once the page is allowed to start animating in.
    const pageReady = new Promise((resolve) => {
        const alreadySeen = store.get('introSeen') === '1';

        if (!loader || alreadySeen || prefersReducedMotion) {
            if (loader) loader.remove();
            resolve();
            return;
        }

        document.body.classList.add('is-locked');
        if (pageEl) pageEl.style.animationPlayState = 'paused';

        const lines   = $$('.loader__line', loader);
        const timers  = [];
        let finished  = false;

        // in / out timings for each line, in ms
        const script = [
            { el: lines[0], in: 300,  out: 2150 },
            { el: lines[1], in: 2500, out: 4350 },
            { el: lines[2], in: 4700, out: null }
        ];

        script.forEach((step) => {
            if (!step.el) return;
            timers.push(setTimeout(() => step.el.classList.add('is-in'), step.in));
            if (step.out !== null) {
                timers.push(setTimeout(() => step.el.classList.remove('is-in'), step.out));
            }
        });

        // Bubu waits alone → Dudu arrives → they hug, in time with the lines
        const stage = $('.loader__stage', loader);
        if (stage) {
            const bubu = $('.loader__bubu', stage);
            const dudu = $('.loader__dudu', stage);
            const hug  = $('.loader__hug',  stage);

            timers.push(setTimeout(() => bubu && bubu.classList.add('is-show'), 400));
            timers.push(setTimeout(() => {
                if (dudu) dudu.classList.add('is-show');
                stage.classList.add('is-paired');
            }, 2450));
            timers.push(setTimeout(() => {
                stage.classList.add('is-hugging');
                if (hug) hug.classList.add('is-show');
            }, 4650));
        }

        timers.push(setTimeout(finish, 7300));

        const skipBtn = $('#loaderSkip');
        if (skipBtn) skipBtn.addEventListener('click', finish);

        // Escape also skips — nobody should ever feel trapped by an intro.
        document.addEventListener('keydown', function onEsc(ev) {
            if (ev.key === 'Escape') {
                document.removeEventListener('keydown', onEsc);
                finish();
            }
        });

        function finish() {
            if (finished) return;
            finished = true;

            timers.forEach(clearTimeout);
            store.set('introSeen', '1');

            loader.classList.add('is-done');
            document.body.classList.remove('is-locked');
            if (pageEl) pageEl.style.animationPlayState = 'running';

            setTimeout(() => loader.remove(), 1000);
            resolve();
        }
    });


    /* ======================================================================
       04. REVEAL ON SCROLL
       ====================================================================== */
    function initReveal() {
        const items = $$('.reveal');
        if (!items.length) return;

        if (!('IntersectionObserver' in window) || prefersReducedMotion) {
            items.forEach((el) => el.classList.add('is-visible'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });

        items.forEach((el) => observer.observe(el));
    }

    // Wait for the intro so the hero doesn't animate behind the loading screen.
    pageReady.then(initReveal);


    /* ======================================================================
       05. SCROLL PROGRESS
       ====================================================================== */
    const progressBar = $('#progressBar');

    function updateProgress() {
        if (!progressBar) return;
        const max = document.documentElement.scrollHeight - window.innerHeight;
        const pct = max > 0 ? window.scrollY / max : 0;
        progressBar.style.transform = 'scaleX(' + clamp(pct, 0, 1) + ')';
    }


    /* ======================================================================
       06. SMOOTH ANCHORS + PAGE TRANSITIONS
       ====================================================================== */
    // In-page anchors (e.g. "Begin Our Journey →")
    $$('a[href^="#"]').forEach((link) => {
        link.addEventListener('click', (ev) => {
            const id = link.getAttribute('href');
            if (!id || id === '#') return;

            const target = document.querySelector(id);
            if (!target) return;

            ev.preventDefault();
            target.scrollIntoView({
                behavior: prefersReducedMotion ? 'auto' : 'smooth',
                block: 'start'
            });
            history.replaceState(null, '', id);
        });
    });

    // Fade the page out before following an internal link
    document.addEventListener('click', (ev) => {
        const link = ev.target.closest('a');
        if (!link || prefersReducedMotion) return;

        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('http') ||
            href.startsWith('mailto:') || href.startsWith('tel:')) return;
        if (link.target === '_blank' || link.hasAttribute('download')) return;
        if (ev.metaKey || ev.ctrlKey || ev.shiftKey || ev.button !== 0) return;

        ev.preventDefault();
        if (pageEl) pageEl.classList.add('is-leaving');
        document.body.style.pointerEvents = 'none';
        setTimeout(() => { window.location.href = href; }, 330);
    });

    // Coming back via the browser's back button should not show a faded page
    window.addEventListener('pageshow', (ev) => {
        if (ev.persisted && pageEl) {
            pageEl.classList.remove('is-leaving');
            document.body.style.pointerEvents = '';
        }
    });


    /* ======================================================================
       07. NAVBAR
       ====================================================================== */
    const nav       = $('#nav');
    const navToggle = $('#navToggle');
    const navMenu   = $('#navMenu');

    function updateNav() {
        if (nav) nav.classList.toggle('is-scrolled', window.scrollY > 20);
    }

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            const open = navToggle.getAttribute('aria-expanded') === 'true';
            navToggle.setAttribute('aria-expanded', String(!open));
            navToggle.setAttribute('aria-label', open ? 'Open menu' : 'Close menu');
            navMenu.classList.toggle('is-open', !open);
        });

        // Close the menu on Escape, for keyboard users
        document.addEventListener('keydown', (ev) => {
            if (ev.key === 'Escape' && navMenu.classList.contains('is-open')) {
                navToggle.setAttribute('aria-expanded', 'false');
                navMenu.classList.remove('is-open');
                navToggle.focus();
            }
        });
    }


    /* ======================================================================
       08. CURSOR GLOW
       ====================================================================== */
    const cursorGlow = $('#cursorGlow');

    if (cursorGlow && !isTouch && !prefersReducedMotion) {
        let targetX = window.innerWidth / 2;
        let targetY = window.innerHeight / 2;
        let currentX = targetX;
        let currentY = targetY;

        window.addEventListener('pointermove', (ev) => {
            if (ev.pointerType === 'touch') return;
            targetX = ev.clientX;
            targetY = ev.clientY;
            cursorGlow.classList.add('is-on');
        }, { passive: true });

        document.addEventListener('mouseleave', () => cursorGlow.classList.remove('is-on'));

        // Eased follow — the lag is what makes it feel soft rather than snappy
        (function loop() {
            currentX += (targetX - currentX) * 0.12;
            currentY += (targetY - currentY) * 0.12;
            cursorGlow.style.transform =
                'translate3d(' + currentX + 'px,' + currentY + 'px,0)';
            requestAnimationFrame(loop);
        })();
    }


    /* ======================================================================
       09. STARFIELD
       Slow-drifting, twinkling stars. Clicking one is an easter egg.
       ====================================================================== */
    const canvas = $('#starfield');
    let stars = [];

    if (canvas && !prefersReducedMotion) {
        const ctx = canvas.getContext('2d');
        let width  = 0;
        let height = 0;
        let dpr    = 1;
        let scrollOffset = 0;

        function sizeCanvas() {
            dpr    = Math.min(window.devicePixelRatio || 1, 2);
            width  = window.innerWidth;
            height = window.innerHeight;

            canvas.width  = width * dpr;
            canvas.height = height * dpr;
            canvas.style.width  = width + 'px';
            canvas.style.height = height + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            buildStars();
        }

        function buildStars() {
            // Density scales with the viewport, capped so phones stay smooth
            const count = clamp(Math.round((width * height) / 9000), 40, 190);
            stars = [];

            for (let i = 0; i < count; i++) {
                const depth = Math.random();              // 0 = far, 1 = near
                stars.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    r: 0.5 + depth * 1.5,
                    depth: depth,
                    drift: (0.02 + depth * 0.07) * (Math.random() > 0.5 ? 1 : -1),
                    fall: 0.01 + depth * 0.05,
                    twinkleSpeed: 0.004 + Math.random() * 0.012,
                    phase: Math.random() * Math.PI * 2,
                    pink: Math.random() > 0.78          // a few warm ones
                });
            }
        }

        function draw() {
            ctx.clearRect(0, 0, width, height);

            for (const s of stars) {
                s.x += s.drift;
                s.y += s.fall;
                s.phase += s.twinkleSpeed;

                // wrap around the edges
                if (s.x < -4) s.x = width + 4;
                if (s.x > width + 4) s.x = -4;
                if (s.y > height + 4) s.y = -4;

                const twinkle = 0.35 + Math.abs(Math.sin(s.phase)) * 0.65;
                const alpha   = twinkle * (0.25 + s.depth * 0.6);

                // parallax: near stars shift more with the scroll position.
                // drawY is kept on the star so the click easter egg can use it.
                const span = height + 8;
                const y = s.y - scrollOffset * s.depth * 0.06;
                s.drawY = ((y % span) + span) % span;

                ctx.beginPath();
                ctx.arc(s.x, s.drawY, s.r, 0, Math.PI * 2);
                ctx.fillStyle = s.pink
                    ? 'rgba(244, 182, 213, ' + alpha + ')'
                    : 'rgba(226, 222, 245, ' + alpha + ')';
                ctx.fill();

                // the brightest few get a soft halo
                if (s.depth > 0.86) {
                    ctx.beginPath();
                    ctx.arc(s.x, s.drawY, s.r * 3.5, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(167, 139, 250, ' + (alpha * 0.11) + ')';
                    ctx.fill();
                }
            }

            requestAnimationFrame(draw);
        }

        sizeCanvas();
        draw();

        window.addEventListener('resize', onFrame(sizeCanvas));
        window.addEventListener('scroll', onFrame(() => { scrollOffset = window.scrollY; }),
                                { passive: true });
    }


    /* ======================================================================
       10. PARALLAX — hero only, and only just enough to notice
       ====================================================================== */
    const heroInner = $('.hero__inner');

    function updateParallax() {
        if (!heroInner || prefersReducedMotion) return;
        const y = window.scrollY;
        if (y > window.innerHeight) return;
        heroInner.style.transform = 'translate3d(0,' + (y * 0.16) + 'px,0)';
        heroInner.style.opacity   = String(clamp(1 - y / (window.innerHeight * 0.75), 0, 1));
    }


    /* ======================================================================
       11. BACKGROUND MUSIC
       Remembers whether it was playing (and where) across page changes.
       ====================================================================== */
    const musicWrap = $('#music');
    const musicBtn  = $('#musicBtn');
    const audio     = $('#bgAudio');

    if (musicWrap && musicBtn && audio) {
        audio.volume = 0;
        let fadeTimer = null;

        /** Gentle fade so the music never slams in or out. */
        function fadeTo(target, done) {
            clearInterval(fadeTimer);
            fadeTimer = setInterval(() => {
                const diff = target - audio.volume;
                if (Math.abs(diff) < 0.02) {
                    audio.volume = target;
                    clearInterval(fadeTimer);
                    if (done) done();
                    return;
                }
                audio.volume = clamp(audio.volume + diff * 0.12, 0, 1);
            }, 40);
        }

        function setPlayingState(playing) {
            musicWrap.classList.toggle('is-playing', playing);
            // The playlist dancer only dances while there's something to dance to
            document.body.classList.toggle('music-playing', playing);
            musicBtn.setAttribute('aria-pressed', String(playing));
            musicBtn.setAttribute('aria-label', playing ? 'Pause background music' : 'Play background music');
            const label = $('.music__label', musicBtn);
            if (label) label.textContent = playing ? 'Playing' : 'Play our song';
        }

        function play() {
            const resumeAt = parseFloat(store.get('bgmTime') || '0');
            if (resumeAt > 0 && isFinite(resumeAt)) {
                try { audio.currentTime = resumeAt; } catch (e) { /* not seekable yet */ }
            }

            const attempt = audio.play();
            if (attempt && typeof attempt.then === 'function') {
                attempt.then(() => {
                    setPlayingState(true);
                    store.set('bgm', 'on');
                    fadeTo(0.35);
                }).catch(() => {
                    // Browser blocked it, or audio/background.mp3 isn't there yet
                    setPlayingState(false);
                    store.set('bgm', 'off');
                });
            }
        }

        function pause() {
            fadeTo(0, () => audio.pause());
            setPlayingState(false);
            store.set('bgm', 'off');
        }

        musicBtn.addEventListener('click', () => {
            if (audio.paused) play(); else pause();
        });

        // Keep the position so the track continues across pages
        ['pagehide', 'beforeunload'].forEach((evt) => {
            window.addEventListener(evt, () => {
                if (!audio.paused) store.set('bgmTime', String(audio.currentTime));
            });
        });

        // If it was on before this page loaded, try to resume it silently.
        if (store.get('bgm') === 'on') {
            pageReady.then(() => setTimeout(play, 400));
        }
    }


    /* ======================================================================
       12. IMAGE FALLBACKS
       Any photo that hasn't been added yet becomes a soft gradient card
       with its caption written across it, so the layout never breaks.
       ====================================================================== */
    function markMissing(img) {
        const holder = img.parentElement;
        if (!holder) return;
        img.classList.add('is-missing');
        holder.classList.add('is-empty');
        holder.setAttribute('data-empty', img.dataset.fallback || '');
    }

    $$('img[data-fallback]').forEach((img) => {
        img.addEventListener('error', () => markMissing(img));
        if (img.complete && img.naturalWidth === 0) markMissing(img);
    });


    /* ======================================================================
       13. REASON CARDS — click or Enter/Space to flip
       ====================================================================== */
    $$('.reason__card').forEach((card) => {
        card.addEventListener('click', () => {
            const flipped = card.classList.toggle('is-flipped');
            card.setAttribute('aria-pressed', String(flipped));
        });
    });


    /* ======================================================================
       14. GALLERY LIGHTBOX
       ====================================================================== */
    const lightbox = $('#lightbox');

    if (lightbox) {
        const shots     = $$('.shot__btn');
        const lbImg     = $('#lightboxImg');
        const lbMedia   = $('.lightbox__media', lightbox);
        const lbDate    = $('#lightboxDate');
        const lbCaption = $('#lightboxCaption');
        const lbDesc    = $('#lightboxDesc');
        const lbCount   = $('#lightboxCount');
        const lbClose   = $('#lightboxClose');
        const lbPrev    = $('#lightboxPrev');
        const lbNext    = $('#lightboxNext');

        let current = 0;
        let lastFocused = null;

        function show(index) {
            current = (index + shots.length) % shots.length;
            const data = shots[current].dataset;

            lbMedia.classList.remove('is-empty');
            lbImg.style.visibility = 'visible';
            lbImg.alt = data.caption || '';
            lbImg.src = data.src;

            lbDate.textContent    = data.date || '';
            lbCaption.textContent = data.caption || '';
            lbDesc.textContent    = data.desc || '';
            lbCount.textContent   = (current + 1) + ' / ' + shots.length;

            // Soft reveal for the swapped-in photo
            lbImg.animate(
                [{ opacity: 0, transform: 'scale(1.02)' }, { opacity: 1, transform: 'none' }],
                { duration: 420, easing: 'cubic-bezier(.16,1,.3,1)' }
            );
        }

        // Missing file → show the caption as a gradient card instead
        lbImg.addEventListener('error', () => {
            lbImg.style.visibility = 'hidden';
            lbMedia.classList.add('is-empty');
            lbMedia.setAttribute('data-empty', lbCaption.textContent || 'Photo coming soon');
        });

        function open(index) {
            lastFocused = document.activeElement;
            lightbox.hidden = false;
            document.body.classList.add('is-locked');
            show(index);
            requestAnimationFrame(() => lightbox.classList.add('is-open'));
            lbClose.focus();
        }

        function close() {
            lightbox.classList.remove('is-open');
            document.body.classList.remove('is-locked');
            setTimeout(() => { lightbox.hidden = true; }, 400);
            if (lastFocused) lastFocused.focus();
        }

        shots.forEach((btn, i) => btn.addEventListener('click', () => open(i)));

        lbClose.addEventListener('click', close);
        lbPrev.addEventListener('click', () => show(current - 1));
        lbNext.addEventListener('click', () => show(current + 1));
        $$('[data-close]', lightbox).forEach((el) => el.addEventListener('click', close));

        document.addEventListener('keydown', (ev) => {
            if (lightbox.hidden) return;
            if (ev.key === 'Escape')     close();
            if (ev.key === 'ArrowLeft')  show(current - 1);
            if (ev.key === 'ArrowRight') show(current + 1);
            // Keep focus inside the dialog
            if (ev.key === 'Tab') {
                const focusables = [lbClose, lbPrev, lbNext];
                const i = focusables.indexOf(document.activeElement);
                ev.preventDefault();
                focusables[(i + (ev.shiftKey ? -1 : 1) + focusables.length) % focusables.length].focus();
            }
        });
    }


    /* ======================================================================
       15. OPEN-WHEN LETTERS
       ====================================================================== */
    const letterModal = $('#letterModal');

    if (letterModal) {
        const letterTitle = $('#letterTitle');
        const letterBody  = $('#letterBody');
        const letterClose = $('#letterClose');
        let lastFocused   = null;

        function openLetter(envelope) {
            const label    = $('.envelope__label', envelope);
            const template = $('.envelope__content', envelope);

            letterTitle.textContent = label ? label.textContent.trim() : 'A letter';
            letterBody.innerHTML = '';
            if (template) letterBody.appendChild(template.content.cloneNode(true));

            // Paragraphs arrive one at a time, like someone reading aloud
            $$('p', letterBody).forEach((p, i) => {
                p.style.animationDelay = (180 + i * 220) + 'ms';
            });

            lastFocused = document.activeElement;
            letterModal.hidden = false;
            document.body.classList.add('is-locked');
            requestAnimationFrame(() => letterModal.classList.add('is-open'));
            letterClose.focus();
        }

        function closeLetter() {
            letterModal.classList.remove('is-open');
            document.body.classList.remove('is-locked');
            setTimeout(() => { letterModal.hidden = true; }, 500);
            if (lastFocused) lastFocused.focus();
        }

        $$('.envelope').forEach((envelope) => {
            envelope.addEventListener('click', () => openLetter(envelope));
        });

        letterClose.addEventListener('click', closeLetter);
        $$('[data-close]', letterModal).forEach((el) => el.addEventListener('click', closeLetter));

        document.addEventListener('keydown', (ev) => {
            if (!letterModal.hidden && ev.key === 'Escape') closeLetter();
        });
    }


    /* ======================================================================
       16. COUNTDOWN
       ====================================================================== */
    const countdownEl = $('#countdown');

    if (countdownEl) {
        const target = new Date(countdownEl.dataset.target).getTime();

        const fields = {
            days:    $('#cdDays'),
            hours:   $('#cdHours'),
            minutes: $('#cdMinutes'),
            seconds: $('#cdSeconds')
        };
        const grid       = $('#countdownGrid');
        const doneBlock  = $('#countdownDone');
        const factSleeps = $('#factSleeps');
        const factWeeks  = $('#factWeeks');

        const pad = (n) => String(n).padStart(2, '0');
        let timer = null;

        function setField(el, value) {
            if (!el || el.textContent === value) return;
            el.textContent = value;
            el.classList.add('is-tick');
            setTimeout(() => el.classList.remove('is-tick'), 320);
        }

        function tick() {
            if (isNaN(target)) return;

            const diff = target - Date.now();

            if (diff <= 0) {
                grid.hidden = true;
                doneBlock.hidden = false;
                clearInterval(timer);
                return;
            }

            const seconds = Math.floor(diff / 1000);
            const days    = Math.floor(seconds / 86400);
            const hours   = Math.floor((seconds % 86400) / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);

            setField(fields.days,    String(days));
            setField(fields.hours,   pad(hours));
            setField(fields.minutes, pad(minutes));
            setField(fields.seconds, pad(seconds % 60));

            if (factSleeps) factSleeps.textContent = String(days);
            if (factWeeks)  factWeeks.textContent  = String(Math.floor(days / 7));
        }

        tick();
        timer = setInterval(tick, 1000);
    }


    /* ======================================================================
       17. EASTER EGGS
       Four of them. Find all four and you get a fifth.
       ====================================================================== */
    const foundEggs = new Set();

    function foundEgg(name, message, label) {
        toast(message, label);

        if (foundEggs.has(name)) return;
        foundEggs.add(name);

        if (foundEggs.size === 4) {
            setTimeout(() => {
                toast(
                    'You found every single one. Of course you did — ' +
                    'you always were the one who paid attention. That’s reason seventeen.',
                    'all four found'
                );
            }, 6400);
        }
    }

    /* --- Egg 1: click the moon --------------------------------------------- */
    const moon = $('#moon');
    if (moon) {
        moon.addEventListener('click', () => {
            foundEgg('moon',
                'Same moon, you know. Whatever time it is where you are, ' +
                'that’s the one I look at too.',
                'the moon'
            );
            moon.animate(
                [{ transform: 'scale(1)' }, { transform: 'scale(1.5)' }, { transform: 'scale(1)' }],
                { duration: 700, easing: 'cubic-bezier(.16,1,.3,1)' }
            );
        });
    }

    /* --- Egg 2: double-click the hero title -------------------------------- */
    const heroTitle = $('#heroTitle');
    if (heroTitle) {
        const secret = () => foundEgg('title',
            'I rewrote this heading eleven times. None of them were big enough. ' +
            'This one will have to do.',
            'behind the title'
        );

        heroTitle.addEventListener('dblclick', secret);
        // Keyboard equivalent, so it isn't mouse-only
        heroTitle.addEventListener('keydown', (ev) => {
            if (ev.key === 'Enter') secret();
        });
    }

    /* --- Egg 3: type the word ---------------------------------------------- */
    let typed = '';
    document.addEventListener('keydown', (ev) => {
        if (ev.key.length !== 1) return;
        // Don't hijack typing inside form fields
        const tag = (ev.target.tagName || '').toLowerCase();
        if (tag === 'input' || tag === 'textarea') return;

        typed = (typed + ev.key.toLowerCase()).slice(-8);

        if (typed.endsWith('love')) {
            foundEgg('love',
                'You typed it. I’ve been trying to say it in about six different ways ' +
                'across seven pages, and you just went ahead and typed it.',
                'four letters'
            );
            typed = '';
        }
    });

    /* --- Egg 4: click a star ------------------------------------------------ */
    // The canvas sits behind the content, so we listen on the document and
    // check whether the click landed on empty space near an actual star.
    if (canvas) {
        document.addEventListener('click', (ev) => {
            if (ev.target.closest('a, button, input, textarea, [role="button"], .glass')) return;

            const hit = stars.some((s) => {
                const dx = s.x - ev.clientX;
                const dy = (s.drawY === undefined ? s.y : s.drawY) - ev.clientY;
                return Math.sqrt(dx * dx + dy * dy) < 18;
            });

            if (!hit) return;

            foundEgg('star',
                'I used to think wishing on stars was pointless. ' +
                'Then one of them worked.',
                'a star'
            );
        });
    }


    /* ======================================================================
       18. STICKERS
       Bubu & Dudu fade in with a small bounce the first time they scroll
       into view, then float gently. Any GIF that hasn't been added yet
       turns into a labelled dashed slot so you can see where it belongs.
       ====================================================================== */
    function initStickers() {
        // The loader and the finale run their own choreography — skip those.
        const boxes = $$('.sticker-box').filter(
            (box) => !box.closest('.loader__stage') && !box.closest('.finale__stage')
        );

        if (!('IntersectionObserver' in window) || prefersReducedMotion) {
            boxes.forEach((box) => box.classList.add('is-in'));
        } else {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('is-in');
                    observer.unobserve(entry.target);
                });
            }, { threshold: 0.2, rootMargin: '0px 0px -4% 0px' });

            boxes.forEach((box) => observer.observe(box));
        }
    }

    /** Show which GIF is missing, instead of a broken image icon. */
    function markStickerMissing(img) {
        const box = img.closest('.sticker-box');
        if (!box) return;

        const file = (img.getAttribute('src') || '').split('/').pop();
        img.classList.add('is-missing');
        box.classList.add('is-empty');
        box.setAttribute('data-empty', file || 'sticker.gif');
    }

    $$('img.sticker').forEach((img) => {
        img.addEventListener('error', () => markStickerMissing(img));
        if (img.complete && img.naturalWidth === 0) markStickerMissing(img);
    });

    pageReady.then(initStickers);


    /* ======================================================================
       19. CONFETTI
       A single soft burst. Draws itself, then removes its own canvas.
       ====================================================================== */
    function confetti(duration = 2600) {
        if (prefersReducedMotion) return;

        const cv  = document.createElement('canvas');
        cv.className = 'confetti';
        document.body.appendChild(cv);

        const c   = cv.getContext('2d');
        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        const w   = window.innerWidth;
        const h   = window.innerHeight;

        cv.width  = w * dpr;
        cv.height = h * dpr;
        cv.style.width  = w + 'px';
        cv.style.height = h + 'px';
        c.setTransform(dpr, 0, 0, dpr, 0, 0);

        const colours = ['#a78bfa', '#f472b6', '#fbcfe8', '#ffffff', '#8b5cf6'];
        const pieces  = [];
        const count   = clamp(Math.round(w / 9), 60, 150);

        for (let i = 0; i < count; i++) {
            pieces.push({
                x: w / 2 + (Math.random() - 0.5) * w * 0.5,
                y: h * 0.42 + (Math.random() - 0.5) * 90,
                vx: (Math.random() - 0.5) * 9,
                vy: -6 - Math.random() * 9,
                size: 4 + Math.random() * 6,
                colour: colours[Math.floor(Math.random() * colours.length)],
                spin: (Math.random() - 0.5) * 0.28,
                angle: Math.random() * Math.PI * 2,
                round: Math.random() > 0.55
            });
        }

        const started = performance.now();

        (function frame(now) {
            const elapsed = now - started;
            const life    = clamp(1 - elapsed / duration, 0, 1);

            c.clearRect(0, 0, w, h);

            pieces.forEach((p) => {
                p.vy += 0.22;            // gravity
                p.vx *= 0.992;           // drag
                p.x  += p.vx;
                p.y  += p.vy;
                p.angle += p.spin;

                c.save();
                c.translate(p.x, p.y);
                c.rotate(p.angle);
                c.globalAlpha = life;
                c.fillStyle = p.colour;

                if (p.round) {
                    c.beginPath();
                    c.arc(0, 0, p.size / 2, 0, Math.PI * 2);
                    c.fill();
                } else {
                    c.fillRect(-p.size / 2, -p.size / 4, p.size, p.size / 2);
                }
                c.restore();
            });

            if (elapsed < duration) {
                requestAnimationFrame(frame);
            } else {
                cv.remove();
            }
        })(started);
    }


    /* ======================================================================
       20. HIDDEN HEARTS
       Sixteen hearts, spread over the seven pages. Each one is dropped into
       the corner of an existing element, so they never land on top of text.
       Progress is kept in localStorage — she can find them over several days.
       ====================================================================== */
    const HEART_TOTAL = 16;

    // [ id, selector to attach to, corner ]
    const HEART_SPOTS = {
        home: [
            ['h01', '.hero',                        'bl'],
            ['h02', '.reasons .reason:nth-child(5)',  'tr'],
            ['h03', '.reasons .reason:nth-child(12)', 'bl'],
            ['h04', '.footer__inner',               'tr']
        ],
        story: [
            ['h05', '.page-head',                   'tr'],
            ['h06', '.timeline__item:nth-child(4)', 'br'],
            ['h07', '.timeline__end',               'cl']
        ],
        memories: [
            ['h08', '.page-head',                   'tl'],
            ['h09', '.gallery .shot:nth-child(7)',  'tr']
        ],
        letters: [
            ['h10', '.page-head',                   'br'],
            // the envelopes themselves are buttons — hang this one off the grid
            ['h11', '.envelopes',                   'tl']
        ],
        playlist: [
            ['h12', '.playlist-head__meta',         'tr'],
            ['h13', '.embeds .embed:nth-child(2)',  'tr']
        ],
        countdown: [
            ['h14', '.countdown',                   'tl']
        ],
        final: [
            ['h15', '.final__head',                 'tl'],
            ['h16', '.final__foot',                 'br']
        ]
    };

    // One line per heart, in order. Replace these with your own.
    const HEART_LINES = [
        'Placeholder — because you text me the boring parts of your day too.',
        'Placeholder — because you never once made me feel like too much.',
        'Placeholder — because of the face you make before you laugh.',
        'Placeholder — because you remember things I only said once.',
        'Placeholder — because you apologise properly, which almost nobody does.',
        'Placeholder — because you are kind to people who cannot do anything for you.',
        'Placeholder — because of the way you say goodnight.',
        'Placeholder — because you let me be quiet without asking what is wrong.',
        'Placeholder — because you got me through that week. You know the one.',
        'Placeholder — because you are the only person whose call I always answer.',
        'Placeholder — because you are braver than you give yourself credit for.',
        'Placeholder — because you make me want to be less of a coward.',
        'Placeholder — because your excitement about small things is my favourite thing.',
        'Placeholder — because you stayed, on the days it would have been easier not to.',
        'Placeholder — because somehow, out of everyone, it was you.',
        'Placeholder — because I ran out of hiding places before I ran out of reasons.'
    ];

    const hearts = {
        key: 'heartsFound',

        load() {
            try {
                return new Set(JSON.parse(window.localStorage.getItem(this.key) || '[]'));
            } catch (e) {
                return new Set();
            }
        },

        save(set) {
            try {
                window.localStorage.setItem(this.key, JSON.stringify(Array.from(set)));
            } catch (e) { /* ignore */ }
        }
    };

    (function initHearts() {
        const found  = hearts.load();
        const spots  = HEART_SPOTS[document.body.dataset.page] || [];
        const hud    = $('#hunt');
        const hudNum = $('#huntFound');

        function refreshHud() {
            if (!hud) return;
            const n = hearts.load().size;
            if (hudNum) hudNum.textContent = String(n);
            hud.hidden = n === 0;
            hud.classList.toggle('is-complete', n >= HEART_TOTAL);
            hud.setAttribute('aria-label',
                n >= HEART_TOTAL
                    ? 'All hearts found — open the secret page'
                    : n + ' of ' + HEART_TOTAL + ' hidden hearts found');
        }

        // Drop a heart into each spot on this page that hasn't been found yet
        spots.forEach(([id, selector, corner]) => {
            if (found.has(id)) return;

            const host = document.querySelector(selector);
            if (!host) return;

            host.classList.add('has-heart');

            const heart = document.createElement('button');
            heart.type = 'button';
            heart.className = 'heart-find heart-find--' + corner;
            heart.innerHTML = '♥';
            heart.dataset.heart = id;
            heart.setAttribute('aria-label', 'A hidden heart');

            heart.addEventListener('click', (ev) => {
                ev.stopPropagation();
                collect(heart, id);
            });

            host.appendChild(heart);
        });

        function collect(heart, id) {
            const set = hearts.load();
            if (set.has(id)) return;

            set.add(id);
            hearts.save(set);

            const index = parseInt(id.slice(1), 10) - 1;
            const line  = HEART_LINES[index] || '';
            const total = set.size;

            toast(
                line + '<span class="toast__meta">' + total + ' of ' + HEART_TOTAL + ' found</span>',
                'one more reason I love you'
            );

            heart.animate(
                [
                    { transform: 'scale(1)',   opacity: 1 },
                    { transform: 'scale(2.4)', opacity: 0 }
                ],
                { duration: 620, easing: 'cubic-bezier(.16,1,.3,1)' }
            ).onfinish = () => heart.remove();

            refreshHud();

            // All sixteen — unlock the secret page
            if (total >= HEART_TOTAL) {
                confetti(3200);
                setTimeout(() => {
                    toast(
                        'All sixteen. There’s a page I hid behind them — ' +
                        'tap the heart counter in the corner.',
                        'unlocked'
                    );
                }, 6200);
            }
        }

        // The counter is only a door once every heart is home
        if (hud) {
            hud.addEventListener('click', (ev) => {
                if (hearts.load().size >= HEART_TOTAL) return;   // let it navigate
                ev.preventDefault();
                ev.stopPropagation();
                toast(
                    'Not yet — ' + hearts.load().size + ' of ' + HEART_TOTAL +
                    '. They like corners.',
                    'still hiding'
                );
            });
        }

        refreshHud();
    })();


    /* ======================================================================
       21. THE PUZZLE
       Drag a piece onto another to swap them, or tap one then the other.
       Keyboard works the same way: Enter to pick up, Enter to place.
       ====================================================================== */
    const puzzleEl = $('#puzzle');

    if (puzzleEl) {
        const board   = $('#puzzleBoard');
        const done    = $('#puzzleDone');
        const movesEl = $('#puzzleMoves');
        const shuffleBtn = $('#puzzleShuffle');

        const cols  = parseInt(puzzleEl.dataset.size, 10) || 3;
        const count = cols * cols;
        const image = puzzleEl.dataset.image;

        let order     = [];      // order[slot] = which piece sits there
        let tiles     = [];
        let selected  = null;
        let moves     = 0;
        let solved    = false;

        board.style.setProperty('--cols', String(cols));
        puzzleEl.style.setProperty('--cols', String(cols));

        // If the photo isn't there yet, fall back to numbered pieces
        const probe = new Image();
        probe.onerror = () => puzzleEl.classList.add('is-fallback');
        probe.src = image;

        /** Fisher-Yates, re-rolled until it isn't accidentally solved. */
        function shuffledOrder() {
            const arr = Array.from({ length: count }, (_, i) => i);

            do {
                for (let i = arr.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [arr[i], arr[j]] = [arr[j], arr[i]];
                }
            } while (arr.every((piece, slot) => piece === slot));

            return arr;
        }

        function paint(tile, piece) {
            const row = Math.floor(piece / cols);
            const col = piece % cols;
            // percentage positioning across a board scaled to cols × cols
            const x = cols === 1 ? 0 : (col / (cols - 1)) * 100;
            const y = cols === 1 ? 0 : (row / (cols - 1)) * 100;

            tile.style.backgroundPosition = x + '% ' + y + '%';
            tile.dataset.piece = String(piece + 1);
            tile.setAttribute('aria-label', 'Piece ' + (piece + 1) + ' of ' + count);
        }

        function build() {
            board.innerHTML = '';
            board.style.setProperty('--img', 'url("' + image + '")');
            tiles = [];
            order = shuffledOrder();
            moves = 0;
            solved = false;
            selected = null;
            puzzleEl.classList.remove('is-solved');
            if (done) done.hidden = true;
            if (movesEl) movesEl.textContent = '0';

            order.forEach((piece, slot) => {
                const tile = document.createElement('button');
                tile.type = 'button';
                tile.className = 'puzzle__tile';
                tile.dataset.slot = String(slot);
                paint(tile, piece);
                attachDrag(tile);
                tile.addEventListener('click', () => {
                    // A finished drag also fires a click — ignore that one
                    if (tile.dataset.dragged === '1') {
                        delete tile.dataset.dragged;
                        return;
                    }
                    select(slot);
                });
                board.appendChild(tile);
                tiles.push(tile);
            });
        }

        function select(slot) {
            if (solved) return;

            if (selected === null) {
                selected = slot;
                tiles[slot].classList.add('is-selected');
                return;
            }

            if (selected === slot) {
                tiles[slot].classList.remove('is-selected');
                selected = null;
                return;
            }

            swap(selected, slot);
            tiles[selected].classList.remove('is-selected');
            selected = null;
        }

        function swap(a, b) {
            if (solved || a === b) return;

            [order[a], order[b]] = [order[b], order[a]];
            paint(tiles[a], order[a]);
            paint(tiles[b], order[b]);

            moves++;
            if (movesEl) movesEl.textContent = String(moves);

            check();
        }

        function check() {
            if (!order.every((piece, slot) => piece === slot)) return;

            solved = true;
            puzzleEl.classList.add('is-solved');
            tiles.forEach((t) => {
                t.classList.remove('is-selected');
                t.setAttribute('tabindex', '-1');
            });

            // photo animates first, then the message arrives
            setTimeout(() => {
                if (done) done.hidden = false;
                confetti(2800);
            }, 1200);
        }

        /* --- Dragging: pointer events, so mouse and touch behave the same --- */
        function attachDrag(tile) {
            let startX = 0;
            let startY = 0;
            let dragging = false;

            tile.addEventListener('pointerdown', (ev) => {
                if (solved || ev.button !== 0) return;

                startX = ev.clientX;
                startY = ev.clientY;
                dragging = false;
                tile.setPointerCapture(ev.pointerId);
            });

            tile.addEventListener('pointermove', (ev) => {
                if (!tile.hasPointerCapture(ev.pointerId) || solved) return;

                const dx = ev.clientX - startX;
                const dy = ev.clientY - startY;

                // Only start dragging once it's clearly a drag, not a tap
                if (!dragging && Math.hypot(dx, dy) < 7) return;

                dragging = true;
                tile.classList.add('is-dragging');
                tile.style.transform = 'translate(' + dx + 'px,' + dy + 'px) scale(1.06)';
            });

            tile.addEventListener('pointerup', (ev) => {
                if (!tile.hasPointerCapture(ev.pointerId)) return;
                tile.releasePointerCapture(ev.pointerId);

                if (!dragging) return;      // it was a tap — the click handler has it

                // Find what's underneath without hit-testing the dragged tile
                tile.style.pointerEvents = 'none';
                const under = document.elementFromPoint(ev.clientX, ev.clientY);
                tile.style.pointerEvents = '';

                tile.classList.remove('is-dragging');
                tile.style.transform = '';
                tile.dataset.dragged = '1';
                dragging = false;

                const target = under && under.closest('.puzzle__tile');
                if (!target || target === tile) return;

                if (selected !== null) {
                    tiles[selected].classList.remove('is-selected');
                    selected = null;
                }

                swap(parseInt(tile.dataset.slot, 10), parseInt(target.dataset.slot, 10));
            });

            tile.addEventListener('pointercancel', () => {
                tile.classList.remove('is-dragging');
                tile.style.transform = '';
                dragging = false;
            });
        }

        if (shuffleBtn) shuffleBtn.addEventListener('click', build);

        build();
    }


    /* ======================================================================
       22. THE FINALE
       Scrolls into view → they walk toward each other → hug → confetti,
       once → the last line fades in.
       ====================================================================== */
    const finale = $('#finale');

    if (finale) {
        let played = false;

        function playFinale() {
            if (played) return;
            played = true;

            if (prefersReducedMotion) {
                finale.classList.add('is-visible', 'is-hugging', 'is-done');
                return;
            }

            finale.classList.add('is-visible');
            setTimeout(() => finale.classList.add('is-walking'), 350);
            setTimeout(() => {
                finale.classList.add('is-hugging');
                confetti(3000);
            }, 3100);
            setTimeout(() => finale.classList.add('is-done'), 4200);
        }

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    playFinale();
                    observer.disconnect();
                });
            }, { threshold: 0.45 });

            observer.observe(finale);
        } else {
            playFinale();
        }
    }


    /* ======================================================================
       23. SECRET PAGE GATE
       ====================================================================== */
    if (document.body.dataset.page === 'secret') {
        const locked   = $('#secretLocked');
        const unlocked = $('#secretContent');
        const progress = $('#secretProgress');
        const total    = hearts.load().size;

        if (total >= HEART_TOTAL) {
            if (locked)   locked.hidden = true;
            if (unlocked) unlocked.hidden = false;
            pageReady.then(() => setTimeout(() => confetti(3400), 700));
        } else {
            if (progress) progress.textContent = String(total);
        }
    }


    /* ======================================================================
       SCROLL LOOP — one listener for everything that reacts to scrolling
       ====================================================================== */
    const onScroll = onFrame(() => {
        updateProgress();
        updateNav();
        updateParallax();
    });

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onFrame(updateProgress));
    updateProgress();
    updateNav();
})();
