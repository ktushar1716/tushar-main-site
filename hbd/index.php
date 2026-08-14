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

   Keep 'back' under roughly 230 characters. The card is a fixed box — both
   faces share it — so anything much longer starts scrolling inside the flip
   instead of simply being read.
   -------------------------------------------------------------------------- */
$reasons = [
    ['no' => '01', 'front' => 'The way you laugh',            'back' => 'It arrives before you mean it to — too loud, completely unguarded, ending in that small breath before the next one. I can hear it right now without trying, and I have embarrassed myself plenty of times just to get it out of you.'],
    ['no' => '02', 'front' => 'You listen properly',          'back' => 'You listen all the way to the end. No waiting for your turn, no fixing it before I have finished. And then weeks later you bring back something I mentioned once, in passing, at 2am.'],
    ['no' => '03', 'front' => 'Your kindness is not loud',    'back' => 'Kind in the way that costs something and never gets announced. To people who can do nothing for you, on days when nobody is watching. It is the rarest thing about you, and you think it is normal.'],
    ['no' => '04', 'front' => 'You are stupidly funny',       'back' => 'Not trying-to-be-funny funny. Casually, accidentally, devastatingly funny — usually in one line, usually while I am being serious. I still laugh at things you said months ago, alone, in public.'],
    ['no' => '05', 'front' => 'How hard you try',             'back' => 'You work at things long past the point most people would call it enough, and then you don’t count any of it. You have never once said “look what I did.” It makes me want to be less lazy about my own life.'],
    ['no' => '06', 'front' => 'Your voice at 2am',            'back' => 'Slower, lower, half of it swallowed, saying whatever comes into your head with nothing left in the way. That version only goes to people you feel safe with, and you give it to me.'],
    ['no' => '07', 'front' => 'You make ordinary days good',  'back' => 'Nothing happened. Neither of us had anything to report. We were both doing our own boring things with the call running in the background — and I remember it better than most days with plans in them.'],
    ['no' => '08', 'front' => 'The way you say my name',      'back' => 'You stretch it out until it stops being a name and turns into a whole sentence. Nobody else on earth calls me that. I did not know I wanted a name only one person uses until you started using it.'],
    ['no' => '09', 'front' => 'You are honest with me',       'back' => 'You tell me the true thing even when the polite thing would end the conversation faster. You have told me things about myself I did not enjoy hearing and needed to hear. I trust you because of it.'],
    ['no' => '10', 'front' => 'Your excitement',              'back' => 'When you love something you talk about it too fast, jumping three steps ahead because you cannot get it out quickly enough. I follow about half. I am not really listening to the words at that point.'],
    ['no' => '11', 'front' => 'You never made me feel small', 'back' => 'I have been unimpressive around you. Broke, ill, blank, in no state to be anybody’s anything. You never once used it or made me perform being okay. Do you know how rare it is to be allowed to be ordinary?'],
    ['no' => '12', 'front' => 'How you handle hard days',     'back' => 'You go quiet and stubborn and you keep going. You carried things this year that would have folded most people, without turning them into anyone else’s problem. I love who you are when things go wrong.'],
    ['no' => '13', 'front' => 'Your hands in photos',         'back' => 'A small thing I noticed embarrassingly early and never stopped noticing. In half the photos I have of you, you are doing something with your hands mid-sentence. You have no idea you do it.'],
    ['no' => '14', 'front' => 'You choose me daily',          'back' => 'Nothing about us is convenient. Nobody is bumping into anybody. Every day, from that distance, you have to decide again — and you keep deciding it. That is not romance, that is character.'],
    ['no' => '15', 'front' => 'You feel like home',           'back' => 'Somewhere along the way home stopped being a place and became a person, and now every city I am in is just somewhere I am waiting. I do not feel far from a house. I feel far from you.'],
    ['no' => '16', 'front' => 'And fifteen wasn’t enough',    'back' => 'This one would not fit on a card, and it would not fit in a message either. So I built you an entire website instead — and even that is not big enough. It is just the biggest thing I know how to make.'],
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
