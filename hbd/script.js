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
   16. The game ("Bring me home")
   17. Make a wish (the cake)
   18. Easter eggs
   19. Stickers
   20. Confetti
   21. Hidden hearts
   22. The puzzle
   23. The finale
   24. Secret page gate
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
            // The cake dancer picks up the tempo when there's a tempo to pick up
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
       16. THE GAME — "Bring me home"

       A DOM runner rather than a canvas one, on purpose: the characters are
       real <img> elements, so the animated GIFs keep animating while they
       move. Everything is positioned with transforms, so it stays cheap.

       Progress is a plain 0 → 1 fraction, mapped onto the real kilometres
       from $DISTANCE_KM, so the rail is the actual distance between them.
       ====================================================================== */
    const gameEl = $('#game');

    if (gameEl) (function initGame() {
        const world    = $('#world');
        const obsLayer = $('#worldObs');
        const groundEl = $('#worldGround');
        const farEl    = $('#worldFar');
        const bubuEl   = $('#worldBubu');
        const duduEl   = $('#worldDudu');
        const hugEl    = $('#worldHug');
        const msEl     = $('#worldMilestone');

        const kmEl     = $('#gameKm');
        const fillEl   = $('#gameFill');
        const pipsEl   = $('#gamePips');
        const livesEl  = $('#gameLives');
        const bestEl   = $('#gameBest');
        const bestVal  = $('#gameBestVal');

        const startPanel = $('#gameStart');
        const overPanel  = $('#gameOver');
        const winPanel   = $('#gameWin');
        const calmPanel  = $('#gameCalm');
        const overKmEl   = $('#gameOverKm');

        /* --- Tuning -------------------------------------------------------
           NOTHING in here is an absolute pixel value, and that's deliberate.
           Speed is in screen-widths per second, heights are fractions of the
           strip, gaps are in seconds. An obstacle therefore takes the same
           amount of TIME to cross the strip whether she's on a phone or a
           laptop — which is the whole point, because that time is how long
           she gets to react. Put a px value back in here and the game turns
           unfair on small screens. */
        const TOTAL_KM   = parseInt(gameEl.dataset.distance, 10) || 2000;
        const RUN_LENGTH = 21;         // total distance, in screen-widths
        const SPEED_MIN  = 0.30;       // screen-widths per second at the start
        const SPEED_MAX  = 0.46;       // …and by the time she's nearly there
        const LIVES      = 3;
        const AIRTIME    = 0.74;       // seconds off the ground, at any size
        const APEX       = 0.56;       // …reaching this much of the free height
        const OBS_H      = [0.20, 0.30, 0.39];   // the three obstacle sizes
        const GAP_MIN    = 1.5;        // seconds between obstacles, at minimum
        const GAP_VAR    = 0.9;        // …plus up to this much more
        const HIT_MERCY  = 1100;       // ms of blinking after a hit
        const MS_MS      = 3000;       // how long a milestone holds the world

        /* Reaction time, for reference: an obstacle appears at the right edge
           and has to travel (1 - runner-x) of the strip to reach him. At
           SPEED_MAX that's 0.85 / 0.46 ≈ 1.8 seconds, at SPEED_MIN ≈ 2.8. */

        const readJSON = (id) => {
            const tag = document.getElementById(id);
            if (!tag) return [];
            try { return JSON.parse(tag.textContent) || []; } catch (e) { return []; }
        };

        const MILESTONES = readJSON('gameMilestones');
        const OBSTACLES  = readJSON('gameObstacles');

        const best = {
            key: 'gameBest',
            get() {
                try { return parseInt(window.localStorage.getItem(this.key), 10) || 0; }
                catch (e) { return 0; }
            },
            set(v) {
                try { window.localStorage.setItem(this.key, String(v)); }
                catch (e) { /* ignore */ }
            }
        };

        /* --- State -------------------------------------------------------- */
        let state    = 'ready';   // ready | running | slow | ending | over | won
        let progress = 0;         // 0 → 1 along the whole distance
        let scrollPx = 0;         // only drives the parallax backgrounds
        let lives    = LIVES;
        let y        = 0;         // height above the ground, px
        let vy       = 0;
        let jumps    = 0;         // 0 = grounded, 1 = single jumped, 2 = spent
        let mercyTil = 0;
        let slowTil  = 0;
        let msDone   = [];
        let spawnIn  = 1.6;       // seconds until the next obstacle
        let obstacles = [];
        let lastT    = 0;
        let raf      = null;
        let visible  = true;

        // All written by measure()
        let width   = 800;
        let free    = 280;   // usable height above the ground
        let gravity = 2900;
        let jumpV   = 950;
        let runnerX = 0.15;
        let bubuBox = { x: 130, w: 50, h: 60 };

        /* --- Set-up ------------------------------------------------------- */
        function measure() {
            width = world.clientWidth || 800;

            const groundH = groundEl ? groundEl.offsetHeight : 46;
            free = Math.max(120, (world.clientHeight || 320) - groundH);

            // apex = v²/2g and airtime = 2v/g, solved for v and g
            const apex = free * APEX;
            jumpV   = (4 * apex) / AIRTIME;
            gravity = (8 * apex) / (AIRTIME * AIRTIME);

            // Where he stands is defined once, in CSS, and read back here so
            // the hitbox and the sprite can never drift apart.
            const declared = parseFloat(
                getComputedStyle(world).getPropertyValue('--runner-x'));
            runnerX = isNaN(declared) ? 0.15 : declared / 100;

            // Hitbox: the middle of him, not the whole sticker. Generous on
            // purpose — she should lose to the game, not to the maths.
            const bw = (bubuEl.offsetWidth  || 90) * 0.5;
            const bh = (bubuEl.offsetHeight || 90) * 0.62;
            bubuBox = { x: width * runnerX + bw * 0.5, w: bw, h: bh };
        }

        /** Current speed in px/s — derived from the strip's width every time. */
        function speedNow() {
            const base = (SPEED_MIN + (SPEED_MAX - SPEED_MIN) * progress) * width;
            return state === 'slow' ? base * 0.3 : base;
        }

        function showBest() {
            const b = best.get();
            if (!bestEl) return;
            bestEl.hidden = b <= 0;
            if (bestVal) bestVal.textContent = String(b);
        }

        // Milestone markers on the rail
        if (pipsEl) {
            MILESTONES.forEach((m) => {
                const pip = document.createElement('i');
                pip.className = 'game__pip';
                pip.style.left = clamp(Number(m.at) || 0, 0, 100) + '%';
                pipsEl.appendChild(pip);
            });
        }

        function setPanel(panel) {
            [startPanel, overPanel, winPanel, calmPanel].forEach((p) => {
                if (p) p.hidden = p !== panel;
            });
        }

        /* --- Reduced motion: no running, just the words ------------------- */
        if (prefersReducedMotion) {
            const lines = $('#gameCalmLines');
            if (lines) {
                MILESTONES.forEach((m) => {
                    const p = document.createElement('p');
                    p.className = 'game__calm-line';
                    p.textContent = m.line;
                    lines.appendChild(p);
                });
                const winText = winPanel && $('.game__win-text', winPanel);
                if (winText) {
                    const p = document.createElement('p');
                    p.className = 'game__calm-line game__calm-line--last';
                    p.textContent = winText.textContent.trim();
                    lines.appendChild(p);
                }
            }
            gameEl.classList.add('is-calm');
            setPanel(calmPanel);
            showBest();
            return;
        }

        /* --- Drawing ------------------------------------------------------ */
        function paintHud() {
            const pct  = clamp(progress, 0, 1);
            const left = Math.max(0, Math.round(TOTAL_KM * (1 - pct)));

            if (kmEl)   kmEl.textContent = left.toLocaleString();
            if (fillEl) fillEl.style.width = (pct * 100).toFixed(2) + '%';

            if (livesEl) {
                $$('.game__life', livesEl).forEach((el, i) => {
                    el.classList.toggle('is-gone', i >= lives);
                });
            }
        }

        function paintWorld() {
            // Ground and backdrop scroll at different rates for depth
            if (groundEl) groundEl.style.backgroundPositionX = -scrollPx + 'px';
            if (farEl)    farEl.style.backgroundPositionX    = -(scrollPx * 0.25) + 'px';

            bubuEl.style.transform =
                'translate3d(0,' + (-y).toFixed(1) + 'px,0)' +
                (y > 4 ? ' rotate(-6deg)' : '');

            obstacles.forEach((o) => {
                o.el.style.transform = 'translate3d(' + o.x.toFixed(1) + 'px,0,0)';
            });
        }

        /* --- Obstacles ---------------------------------------------------- */
        function spawn() {
            if (!OBSTACLES.length) return;

            const spec = OBSTACLES[Math.floor(Math.random() * OBSTACLES.length)];
            const h    = clamp(parseInt(spec.h, 10) || 1, 1, 3);

            const height = Math.round(free * OBS_H[h - 1]);

            const el = document.createElement('span');
            el.className = 'obs obs--h' + h;
            el.style.height = height + 'px';
            el.innerHTML = '<i class="obs__label"></i>';
            $('.obs__label', el).textContent = spec.label || '';
            obsLayer.appendChild(el);

            obstacles.push({
                el,
                x: width + 60,
                w: el.offsetWidth || 42,
                h: height,
                hit: false
            });
        }

        function clearObstacles(fade) {
            obstacles.forEach((o) => {
                if (fade) {
                    o.el.classList.add('is-gone');
                    setTimeout(() => o.el.remove(), 500);
                } else {
                    o.el.remove();
                }
            });
            obstacles = [];
        }

        /* --- Milestones --------------------------------------------------- */
        function checkMilestone() {
            const pct = progress * 100;

            for (let i = 0; i < MILESTONES.length; i++) {
                if (msDone[i]) continue;
                if (pct < (Number(MILESTONES[i].at) || 0)) continue;

                msDone[i] = true;
                state    = 'slow';
                slowTil  = performance.now() + MS_MS;

                clearObstacles(true);
                // Give her a clear run-up out of the slow-motion, rather than
                // an obstacle arriving the instant the world speeds back up
                spawnIn = (MS_MS / 1000) + 1.2;

                msEl.textContent = MILESTONES[i].line;
                msEl.classList.add('is-on');
                world.classList.add('is-slow');

                const pip = pipsEl && pipsEl.children[i];
                if (pip) pip.classList.add('is-hit');
                break;
            }
        }

        function endMilestone() {
            state = 'running';
            msEl.classList.remove('is-on');
            world.classList.remove('is-slow');
            setTimeout(() => {
                if (!msEl.classList.contains('is-on')) msEl.textContent = '';
            }, 600);
        }

        /* --- Collisions --------------------------------------------------- */
        function collide(now) {
            if (now < mercyTil) return;

            for (let i = 0; i < obstacles.length; i++) {
                const o = obstacles[i];
                if (o.hit) continue;

                // A few pixels of forgiveness on every side
                const overlapX = o.x + 5 < bubuBox.x + bubuBox.w - 5 &&
                                 o.x + o.w - 5 > bubuBox.x + 5;
                if (!overlapX) continue;
                if (y >= o.h - 5) continue;      // cleared it

                o.hit = true;
                takeHit(now, o);
                return;
            }
        }

        function takeHit(now, o) {
            lives -= 1;
            mercyTil = now + HIT_MERCY;

            o.el.classList.add('is-gone');
            setTimeout(() => o.el.remove(), 400);
            obstacles = obstacles.filter((x) => x !== o);

            world.classList.add('is-shaking');
            bubuEl.classList.add('is-hurt');
            setTimeout(() => world.classList.remove('is-shaking'), 420);
            setTimeout(() => bubuEl.classList.remove('is-hurt'), HIT_MERCY);

            paintHud();

            if (lives <= 0) gameOver();
        }

        /* --- Endings ------------------------------------------------------ */
        function gameOver() {
            state = 'over';
            cancelAnimationFrame(raf);
            raf = null;

            const pct = Math.round(clamp(progress, 0, 1) * 100);
            if (pct > best.get()) best.set(pct);
            showBest();

            if (overKmEl) {
                overKmEl.textContent = Math.round(TOTAL_KM * (pct / 100)).toLocaleString();
            }

            clearObstacles(true);
            world.classList.add('is-over');
            setPanel(overPanel);
        }

        function win() {
            state = 'ending';
            clearObstacles(true);
            best.set(100);
            showBest();

            progress = 1;
            paintHud();

            world.classList.add('is-ending');

            // She's been standing there the whole time, off screen right.
            // Unhide, force the layout, then add the class — doing it on a
            // frame callback instead would leave her invisible if the frame
            // never comes (background tab, throttled renderer).
            duduEl.hidden = false;
            void duduEl.offsetWidth;
            duduEl.classList.add('is-here');

            // Walk toward each other, meet, hug.
            setTimeout(() => {
                bubuEl.classList.add('is-meeting');
                duduEl.classList.add('is-meeting');
            }, 260);

            setTimeout(() => {
                bubuEl.classList.add('is-done');
                duduEl.classList.add('is-done');
                hugEl.hidden = false;
                void hugEl.offsetWidth;
                hugEl.classList.add('is-here');
                confetti(3400);
            }, 1500);

            setTimeout(() => {
                state = 'won';
                setPanel(winPanel);
            }, 2500);

            cancelAnimationFrame(raf);
            raf = null;
        }

        /* --- The loop ----------------------------------------------------- */
        function frame(now) {
            if (state !== 'running' && state !== 'slow') { raf = null; return; }

            const dt = Math.min((now - lastT) / 1000, 0.05);   // cap after a stall
            lastT = now;

            const speed = speedNow();

            // Progress is kept as a fraction, not a pixel count, so rotating
            // the phone mid-run doesn't teleport her up or down the rail.
            progress += (speed * dt) / (RUN_LENGTH * width);
            scrollPx += speed * dt;

            if (y > 0 || vy > 0) {
                vy -= gravity * dt;
                y  += vy * dt;
                if (y <= 0) { y = 0; vy = 0; jumps = 0; }
            }

            // Obstacles
            obstacles.forEach((o) => { o.x -= speed * dt; });
            obstacles = obstacles.filter((o) => {
                if (o.x > -width * 0.2) return true;
                o.el.remove();
                return false;
            });

            // Spawning is timed, not distance-based, so the gap between two
            // obstacles is the same number of seconds at any screen size.
            if (state === 'running' && progress < 0.94) {
                spawnIn -= dt;
                if (spawnIn <= 0) {
                    spawn();
                    spawnIn = GAP_MIN + Math.random() * GAP_VAR;
                }
            }

            if (state === 'running') collide(now);
            if (state === 'slow' && now >= slowTil) endMilestone();
            if (state === 'running') checkMilestone();

            paintWorld();
            paintHud();

            if (progress >= 1) { win(); return; }

            raf = requestAnimationFrame(frame);
        }

        function run() {
            if (raf) return;
            lastT = performance.now();
            raf = requestAnimationFrame(frame);
        }

        /* --- Controls ----------------------------------------------------- */
        function jump() {
            if (state !== 'running' && state !== 'slow') return;
            if (jumps >= 2) return;

            // The second jump is a little weaker, so it's a save and not a fly
            vy = jumps === 0 ? jumpV : jumpV * 0.82;
            jumps += 1;

            bubuEl.classList.remove('is-jumping');
            void bubuEl.offsetWidth;
            bubuEl.classList.add('is-jumping');
        }

        function start() {
            measure();

            progress = 0;
            scrollPx = 0;
            lives    = LIVES;
            y = 0; vy = 0; jumps = 0;
            mercyTil = 0;
            msDone = [];
            spawnIn = 2.2;      // a moment to settle before the first one

            clearObstacles(false);
            msEl.textContent = '';
            msEl.classList.remove('is-on');

            world.classList.remove('is-over', 'is-ending', 'is-slow');
            bubuEl.classList.remove('is-meeting', 'is-done', 'is-hurt');
            duduEl.classList.remove('is-here', 'is-meeting', 'is-done');
            hugEl.classList.remove('is-here');
            duduEl.hidden = true;
            hugEl.hidden = true;

            if (pipsEl) $$('.game__pip', pipsEl).forEach((p) => p.classList.remove('is-hit'));

            setPanel(null);
            paintHud();
            paintWorld();

            state = 'running';
            run();
        }

        $('#gameStartBtn').addEventListener('click', start);
        $('#gameRetryBtn').addEventListener('click', start);
        $('#gameAgainBtn').addEventListener('click', start);

        // Tapping the strip jumps — but not when a panel is asking for a click,
        // and never in a way that stops her scrolling past a game she isn't
        // playing.
        world.addEventListener('pointerdown', (ev) => {
            if (state !== 'running' && state !== 'slow') return;
            if (ev.target.closest('.game__panel')) return;
            ev.preventDefault();
            jump();
        });

        document.addEventListener('keydown', (ev) => {
            if (ev.key !== ' ' && ev.key !== 'Spacebar' &&
                ev.key !== 'ArrowUp' && ev.key !== 'w') return;

            // Don't steal the spacebar from buttons or from the rest of the page.
            // The target isn't always an element — it's the document itself when
            // nothing on the page has focus.
            if (state !== 'running' && state !== 'slow') return;

            const t = ev.target;
            if (t && t.closest && t.closest('button, a, input, textarea')) return;

            ev.preventDefault();
            jump();
        });

        // Stop the loop when the strip scrolls away or the tab is hidden —
        // otherwise she comes back to a game she has already lost.
        function pauseIfHidden() {
            if (state !== 'running' && state !== 'slow') return;
            if (visible && !document.hidden) {
                lastT = performance.now();
                run();
            } else {
                cancelAnimationFrame(raf);
                raf = null;
            }
        }

        document.addEventListener('visibilitychange', pauseIfHidden);

        if ('IntersectionObserver' in window) {
            new IntersectionObserver((entries) => {
                visible = entries[0].isIntersecting;
                pauseIfHidden();
            }, { threshold: 0.35 }).observe(world);
        }

        window.addEventListener('resize', onFrame(() => {
            measure();
            paintWorld();
        }));

        measure();
        showBest();
        paintHud();
    })();


    /* ======================================================================
       17. MAKE A WISH — the cake

       One candle per year. Tap them, or actually blow into the microphone
       if she lets the page listen. The whole scene dims as they go out and
       comes back all at once when the last one dies.
       ====================================================================== */
    const wishEl = $('#wish');

    if (wishEl) (function initWish() {
        const cake     = $('#cake');
        const candles  = $$('.candle', cake);
        const outEl    = $('#wishOut');
        const doneEl   = $('#wishDone');
        const danceEl  = $('#cakeDance');
        const relight  = $('#wishRelight');
        const micBtn   = $('#wishMic');
        const micNote  = $('#wishMicNote');
        const micLabel = $('#wishMicLabel');
        const micBar   = $('#wishMicBar');

        const TOTAL = candles.length;
        let out = 0;
        let finished = false;
        let mic = null;      // { ctx, stream, raf }

        // Written onto <html> rather than the section, so the fixed page
        // background — which isn't a descendant of anything here — dims too.
        function setLit() {
            const lit = TOTAL ? (TOTAL - out) / TOTAL : 0;
            document.documentElement.style.setProperty('--lit', lit.toFixed(3));
            if (outEl) outEl.textContent = String(out);
        }

        function blow(candle) {
            if (finished || !candle || candle.classList.contains('is-out')) return false;

            candle.classList.add('is-out');
            candle.disabled = true;
            out += 1;
            setLit();

            if (out >= TOTAL) finish();
            return true;
        }

        /** Blows out the leftmost candle still burning. Used by the mic. */
        function blowNext() {
            return blow(candles.find((c) => !c.classList.contains('is-out')));
        }

        function finish() {
            finished = true;
            stopMic();

            cake.classList.add('is-done');
            wishEl.classList.add('is-dark');

            // A beat of darkness, then everything comes back at once
            setTimeout(() => {
                wishEl.classList.remove('is-dark');
                wishEl.classList.add('is-done');

                // Unhide, force layout, then add the class. A frame callback
                // would be prettier and would also leave the whole message
                // stuck at opacity 0 if that frame never arrives.
                if (danceEl) {
                    danceEl.hidden = false;
                    void danceEl.offsetWidth;
                    danceEl.classList.add('is-here');
                }

                if (doneEl) {
                    doneEl.hidden = false;
                    void doneEl.offsetWidth;
                    doneEl.classList.add('is-in');
                }

                confetti(3800);

                try { window.localStorage.setItem('wishMade', '1'); } catch (e) { /* ignore */ }
            }, 900);
        }

        function relightAll() {
            finished = false;
            out = 0;

            candles.forEach((c) => {
                c.classList.remove('is-out');
                c.disabled = false;
            });

            cake.classList.remove('is-done');
            wishEl.classList.remove('is-done', 'is-dark');

            if (danceEl) { danceEl.classList.remove('is-here'); danceEl.hidden = true; }
            if (doneEl)  { doneEl.classList.remove('is-in');  doneEl.hidden  = true; }

            setLit();
            if (candles[0]) candles[0].focus();
        }

        candles.forEach((c) => {
            c.addEventListener('click', () => blow(c));
            // Dragging a finger across the cake blows out everything it touches
            c.addEventListener('pointerenter', (ev) => {
                if (ev.pressure > 0 || ev.buttons === 1) blow(c);
            });
        });

        if (relight) relight.addEventListener('click', relightAll);

        /* --- The microphone ----------------------------------------------
           Opt-in only: nothing is requested until she presses the button,
           and the stream is torn down the moment the last candle is out.

           Three things matter for this actually working:

           1. The audio constraints. Browsers default to noise suppression
              and auto gain, and noise suppression is *specifically* good at
              removing low-frequency wind noise — which is exactly the sound
              of someone blowing at a microphone. Leave them on and a real
              breath arrives as near-silence. All three are turned off below.

           2. Calibration instead of fixed thresholds. Microphones vary
              enormously, so the first three-quarters of a second is spent
              measuring the room and the trigger is set relative to that.

           3. Visible feedback. Without the level meter there's no way to
              tell "not listening" apart from "listening, not loud enough".
           ------------------------------------------------------------------ */
        function stopMic() {
            if (!mic) return;
            cancelAnimationFrame(mic.raf);
            clearTimeout(mic.nudge);
            mic.stream.getTracks().forEach((t) => t.stop());
            if (mic.ctx.state !== 'closed') mic.ctx.close();
            mic = null;

            if (micBtn) {
                micBtn.classList.remove('is-live');
                micBtn.setAttribute('aria-pressed', 'false');
            }
            if (micLabel) micLabel.textContent = 'or actually blow into your mic';
            if (micBar)   micBar.style.transform = 'scaleX(0)';
        }

        function say(text) {
            if (!micNote) return;
            micNote.textContent = text || '';
            micNote.hidden = !text;
        }

        async function startMic() {
            if (mic) { stopMic(); say(''); return; }
            if (finished) return;

            // getUserMedia only exists in a secure context. Opening the page
            // as a file:// or over plain http on a phone is the single most
            // likely reason this button does nothing, so say so plainly.
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                say(window.isSecureContext
                    ? 'This browser won’t let me listen. Tapping works just as well.'
                    : 'Microphones only work on https (or localhost). Open this page ' +
                      'over https and the button will work — tapping works either way.');
                return;
            }

            say('Asking for the microphone…');

            let stream;
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    audio: {
                        echoCancellation: false,   // all three of these would
                        noiseSuppression: false,   // filter out the breath
                        autoGainControl:  false
                    }
                });
            } catch (err) {
                const name = err && err.name;
                say(name === 'NotAllowedError' || name === 'SecurityError'
                        ? 'You said no to the microphone — which is fair. Tap the candles instead.'
                    : name === 'NotFoundError' || name === 'DevicesNotFoundError'
                        ? 'I can’t find a microphone on this device. Tapping is allowed too.'
                        : 'The microphone didn’t start. Tapping is allowed too.');
                return;
            }

            let ctx;
            try {
                const Ctx = window.AudioContext || window.webkitAudioContext;
                ctx = new Ctx();
                // Autoplay policy can hand back a suspended context even from
                // inside a click, so ask for it explicitly.
                if (ctx.state === 'suspended') await ctx.resume();
            } catch (err) {
                stream.getTracks().forEach((t) => t.stop());
                say('This browser can’t process audio. Tapping is allowed too.');
                return;
            }

            const node = ctx.createAnalyser();
            node.fftSize = 1024;
            node.smoothingTimeConstant = 0.35;
            ctx.createMediaStreamSource(stream).connect(node);

            const bins = new Float32Array(node.frequencyBinCount);
            const wave = new Uint8Array(node.fftSize);

            // Which bins hold what, worked out from the real sample rate
            const hzPerBin = ctx.sampleRate / node.fftSize;
            const lowTop   = Math.max(2, Math.round(400  / hzPerBin));
            const midTop   = Math.max(lowTop + 1, Math.round(4000 / hzPerBin));

            // The noise floor is tracked continuously rather than sampled once
            // at the start: if she opens this with music on, or a fan running,
            // a one-shot reading would set the bar permanently out of reach.
            // It drops quickly toward quiet and creeps up only very slowly, so
            // a long breath can't drag its own threshold up with it.
            //
            // The trigger is deliberately RELATIVE — some microphones are ten
            // times quieter than others, and a fixed level that feels right on
            // a laptop is simply unreachable on a quiet phone mic. TRIGGER_MIN
            // exists only to stop a silent or muted input firing on nothing,
            // so it's set far below any real breath. TRIGGER_MAX is the other
            // end: however loud the room is, a firm blow still counts.
            const WARMUP_MS   = 600;
            const TRIGGER_MIN = 0.005;
            const TRIGGER_MAX = 0.085;
            let audioAt = 0;           // when real audio first showed up
            let floor = -1;            // -1 until the first reading seeds it
            let threshold = TRIGGER_MIN;
            let ready = false;
            let lastBlow = 0, everBlew = false;

            mic = { ctx, stream, raf: 0, nudge: 0 };
            micBtn.classList.add('is-live');
            micBtn.setAttribute('aria-pressed', 'true');
            if (micLabel) micLabel.textContent = 'listening…';
            say('Hold on — listening to the room for a second.');

            // If nothing has registered after a while, she's probably too far
            // away rather than doing it wrong.
            mic.nudge = setTimeout(() => {
                if (mic && !everBlew) {
                    say('Nothing yet — get closer and blow straight at the mic, ' +
                        'short and hard. (Tapping still works.)');
                }
            }, 9000);

            (function listen() {
                if (!mic) return;
                mic.raf = requestAnimationFrame(listen);

                node.getFloatFrequencyData(bins);
                node.getByteTimeDomainData(wave);

                // How loud, overall
                let sum = 0;
                for (let i = 0; i < wave.length; i++) {
                    const v = (wave[i] - 128) / 128;
                    sum += v * v;
                }
                const rms = Math.sqrt(sum / wave.length);

                // How much of that is low rumble rather than clatter. This has
                // to be an ENERGY ratio, so the decibel figures the analyser
                // hands back get converted to linear power first — summing the
                // dB values directly makes near-silent bins look significant
                // and the ratio never moves.
                let low = 0, mid = 0;
                for (let i = 1; i <= midTop && i < bins.length; i++) {
                    const power = Math.pow(10, bins[i] / 10);
                    if (i <= lowTop) low += power; else mid += power;
                }
                const ratio = (low + mid) > 0 ? low / (low + mid) : 0;

                const now = performance.now();

                // A capture stream hands back digital silence for the first
                // moments while the device wakes up. Those frames must not
                // count: seed the floor from them and it anchors at zero, the
                // threshold pins to its minimum, and then ordinary room noise
                // reads as a blow for the rest of the session.
                if (rms <= 0) return;
                if (!audioAt) audioAt = now;

                // Warm-up converges fast and symmetrically, so the floor lands
                // on the real ambient level within the first few frames of
                // actual audio. After that it falls faster than it rises, so a
                // sustained blow can't drag its own threshold up behind it —
                // but not so fast that it settles at the bottom of the noise
                // instead of its average, which would leave steady hiss
                // sitting above its own threshold and firing continuously.
                if (floor < 0) floor = rms;
                else if (!ready) floor += (rms - floor) * 0.15;
                else floor += (rms - floor) * (rms < floor ? 0.03 : 0.002);

                // 3x the floor, chosen by sweeping the multiplier against
                // simulated rooms: at 2.5x and below, ordinary jittery room
                // noise starts firing on its own; above 3x a soft breath from
                // someone who isn't really committing stops registering.
                threshold = clamp(Math.max(floor * 3, floor + 0.004),
                                  TRIGGER_MIN, TRIGGER_MAX);

                // Meter: from the noise floor up to comfortably past the
                // trigger, so a real breath pins it and silence sits at zero.
                if (micBar) {
                    const level = clamp((rms - floor) / (threshold * 2.2 - floor), 0, 1);
                    micBar.style.transform = 'scaleX(' + level.toFixed(3) + ')';
                }

                // A moment to let the floor settle before anything can fire.
                // Timed from the first real audio, not from the click.
                if (!ready) {
                    if (now - audioAt < WARMUP_MS) return;
                    ready = true;
                    if (micLabel) micLabel.textContent = 'blow!';
                    say('Listening. Blow straight at it.');
                }




                if (rms > threshold && ratio > 0.35 && now - lastBlow > 110) {
                    lastBlow = now;
                    everBlew = true;
                    say('');
                    blowNext();
                    micBtn.classList.add('is-hit');
                    setTimeout(() => micBtn.classList.remove('is-hit'), 200);
                }
            })();
        }

        if (micBtn) micBtn.addEventListener('click', startMic);
        window.addEventListener('pagehide', stopMic);

        setLit();
    })();


    /* ======================================================================
       18. EASTER EGGS
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
       19. STICKERS
       Bubu & Dudu fade in with a small bounce the first time they scroll
       into view, then float gently. Any GIF that hasn't been added yet
       turns into a labelled dashed slot so you can see where it belongs.
       ====================================================================== */
    function initStickers() {
        // The loader, the finale, the two runners and the cake dancer all run
        // their own choreography — the shared float would fight every one of
        // them. Everything else on those pages (panel stickers included) still
        // gets the normal entrance.
        const OWN_CHOREOGRAPHY =
            '.world__bubu, .world__dudu, .world__hug, .cake-stage__dance';

        const boxes = $$('.sticker-box').filter((box) =>
            !box.closest('.loader__stage') &&
            !box.closest('.finale__stage') &&
            !box.matches(OWN_CHOREOGRAPHY)
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
       20. CONFETTI
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
       21. HIDDEN HEARTS
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
        game: [
            ['h12', '.page-head',                   'tr'],
            // not on the strip itself — she'd hit it mid-jump
            ['h13', '.game__note',                  'cl']
        ],
        wish: [
            ['h14', '.wish__note',                  'br']
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
       22. THE PUZZLE
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
       23. THE FINALE
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
       24. SECRET PAGE GATE
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
