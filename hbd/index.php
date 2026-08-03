<?php
/* ==========================================================================
   INDEX.PHP — Home
   Cinematic loader → fullscreen hero → the 16 reasons.
   ========================================================================== */
$page       = 'home';
$showLoader = true;
require 'includes/head.php';
require 'includes/navbar.php';

/* --------------------------------------------------------------------------
   THE 16 REASONS — replace the front/back text of each card.
   'front' is the teaser she sees. 'back' is what she gets for being curious.
   -------------------------------------------------------------------------- */
$reasons = [
    ['no' => '01', 'front' => 'The way you laugh',            'back' => 'Placeholder — write about the exact sound of it, and the fact that you can hear it in your head right now without trying.'],
    ['no' => '02', 'front' => 'You listen properly',          'back' => 'Placeholder — the way she remembers small things you mentioned once, months ago, in passing.'],
    ['no' => '03', 'front' => 'Your kindness is not loud',    'back' => 'Placeholder — a specific time she was gentle with someone when nobody was watching.'],
    ['no' => '04', 'front' => 'You are stupidly funny',       'back' => 'Placeholder — the joke of hers that still makes you laugh alone, badly, in public.'],
    ['no' => '05', 'front' => 'How hard you try',             'back' => 'Placeholder — something she works at relentlessly, and how it makes you want to be better.'],
    ['no' => '06', 'front' => 'Your voice at 2am',            'back' => 'Placeholder — the sleepy version of her voice, and why it is your favourite version.'],
    ['no' => '07', 'front' => 'You make ordinary days good',  'back' => 'Placeholder — a completely boring day that she somehow turned into a good memory.'],
    ['no' => '08', 'front' => 'The way you say my name',      'back' => 'Placeholder — how it sounds different from the way anyone else says it.'],
    ['no' => '09', 'front' => 'You are honest with me',       'back' => 'Placeholder — a time she told you something true that was hard to say.'],
    ['no' => '10', 'front' => 'Your excitement',              'back' => 'Placeholder — the thing she talks about too fast because she loves it too much.'],
    ['no' => '11', 'front' => 'You never made me feel small', 'back' => 'Placeholder — how safe it feels to be unimpressive around her.'],
    ['no' => '12', 'front' => 'How you handle hard days',     'back' => 'Placeholder — something difficult she carried, and carried well.'],
    ['no' => '13', 'front' => 'Your hands in photos',         'back' => 'Placeholder — a small physical detail you noticed early and never stopped noticing.'],
    ['no' => '14', 'front' => 'You choose me daily',          'back' => 'Placeholder — the quiet, unglamorous, everyday choosing that distance demands.'],
    ['no' => '15', 'front' => 'You feel like home',           'back' => 'Placeholder — the fact that home stopped being a place at some point this year.'],
    ['no' => '16', 'front' => 'And fifteen wasn’t enough',    'back' => 'Placeholder — the reason that would not fit in a card, so you built a whole website instead.'],
];
?>

<!-- ==========================================================================
     HERO
     ========================================================================== -->
<section class="hero" id="hero">

    <!-- They wave hello. On desktop they stand either side of the title;
         on phones they move above it so they never crowd the text.
         REPLACE: bubu-wave.gif / dudu-wave.gif -->
    <div class="hero__stickers" aria-hidden="true">
        <span class="sticker-box sticker-box--lg">
            <img class="sticker" src="images/stickers/bubu-wave.webp" alt="">
        </span>
        <span class="sticker-box sticker-box--lg">
            <img class="sticker sticker--flip" src="images/stickers/dudu-not-wave.webp" alt="">
        </span>
    </div>

    <div class="hero__inner">
        <p class="hero__eyebrow reveal" data-delay="0">Today, of all the days</p>

        <h1 class="hero__title reveal" data-delay="1" id="heroTitle" tabindex="0"
            title="Try double-clicking me">
            <span class="hero__title-line">Happy Birthday,</span>
            <span class="hero__title-name"><?php echo e($HER_NICKNAME); ?></span>
        </h1>

        <p class="hero__subtitle reveal" data-delay="2">
            This isn’t just a website.<br>
            It’s everything I wish I could hand to you in person.
        </p>

        <div class="hero__actions reveal" data-delay="3">
            <a class="btn btn--primary" href="#reasons" data-scroll>
                Begin Our Journey <span aria-hidden="true">→</span>
            </a>
        </div>
    </div>

    <div class="hero__scroll reveal" data-delay="4" aria-hidden="true">
        <span class="hero__scroll-line"></span>
        <span class="hero__scroll-text">scroll</span>
    </div>
</section>

<!-- ==========================================================================
     16 REASONS — click / Enter to flip
     ========================================================================== -->
<section class="section" id="reasons">
    <header class="section__head">
        <p class="section__eyebrow reveal">One</p>
        <h2 class="section__title reveal">16 reasons I love you</h2>
        <p class="section__lede reveal">
            There are more than sixteen. Sixteen is just where I ran out of room.
            <span class="section__lede-soft">Tap a card.</span>
        </p>
    </header>

    <div class="reasons">
        <?php foreach ($reasons as $i => $reason): ?>
            <article class="reason reveal" data-delay="<?php echo $i % 4; ?>">
                <button class="reason__card" type="button" aria-pressed="false"
                    aria-label="Reason <?php echo e($reason['no']); ?>: <?php echo e($reason['front']); ?>. Activate to read more.">
                    <!-- Front -->
                    <span class="reason__face reason__face--front">
                        <span class="reason__no"><?php echo e($reason['no']); ?></span>
                        <span class="reason__front-text"><?php echo e($reason['front']); ?></span>
                        <span class="reason__flip-hint" aria-hidden="true">tap</span>
                    </span>
                    <!-- Back -->
                    <span class="reason__face reason__face--back">
                        <span class="reason__back-text"><?php echo e($reason['back']); ?></span>
                    </span>
                </button>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php
$nextPage = ['story.php', 'Our Story'];
require 'includes/footer.php';
