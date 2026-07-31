<?php
/* ==========================================================================
   COUNTDOWN.PHP — Page 6
   The clock counting down to the next time we're in the same place.
   Change the target date in includes/head.php ($COUNTDOWN_TO).
   ========================================================================== */
$page      = 'countdown';
$pageTitle = 'The Countdown';
require 'includes/head.php';
require 'includes/navbar.php';
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="page-head">
    <p class="section__eyebrow reveal">Five</p>
    <h1 class="page-head__title reveal">The countdown</h1>
    <p class="page-head__lede reveal"><?php echo e($COUNTDOWN_WHY); ?></p>
</section>

<!-- ==========================================================================
     THE CLOCK
     data-target is read by script.js — it accepts any ISO date string.
     ========================================================================== -->
<section class="section section--tight countdown-wrap">

  <!-- Bubu on one side, Dudu on the other, both facing the clock between them.
       Remove the sticker--flip class if your GIFs already face the right way.
       REPLACE: bubu-look.gif / dudu-look.gif -->
  <div class="countdown-row">

    <span class="sticker-box sticker-box--lg countdown-row__left" aria-hidden="true">
        <img class="sticker" src="images/stickers/bubu-look.gif" alt="">
    </span>

    <div class="countdown glass reveal" id="countdown" data-target="<?php echo e($COUNTDOWN_TO); ?>">
        <div class="countdown__grid" id="countdownGrid" aria-live="polite" aria-atomic="true">
            <div class="unit">
                <span class="unit__value" id="cdDays">--</span>
                <span class="unit__label">Days</span>
            </div>
            <span class="unit__sep" aria-hidden="true">:</span>
            <div class="unit">
                <span class="unit__value" id="cdHours">--</span>
                <span class="unit__label">Hours</span>
            </div>
            <span class="unit__sep" aria-hidden="true">:</span>
            <div class="unit">
                <span class="unit__value" id="cdMinutes">--</span>
                <span class="unit__label">Minutes</span>
            </div>
            <span class="unit__sep" aria-hidden="true">:</span>
            <div class="unit">
                <span class="unit__value" id="cdSeconds">--</span>
                <span class="unit__label">Seconds</span>
            </div>
        </div>

        <!-- Shown when the timer reaches zero -->
        <div class="countdown__done" id="countdownDone" hidden>
            <p class="countdown__done-title">It’s today.</p>
            <p class="countdown__done-sub">Go and get your bag. I’m already on my way.</p>
        </div>

        <p class="countdown__caption">I can’t wait until this reaches zero.</p>
    </div>

    <span class="sticker-box sticker-box--lg countdown-row__right" aria-hidden="true">
        <img class="sticker sticker--flip" src="images/stickers/dudu-look.gif" alt="">
    </span>

  </div><!-- /.countdown-row -->

    <!-- Extra context: how long we've already managed -->
    <div class="countdown__facts">
        <div class="fact glass reveal" data-delay="0">
            <p class="fact__value" id="factSleeps">—</p>
            <p class="fact__label">nights left to get through</p>
        </div>
        <div class="fact glass reveal" data-delay="1">
            <p class="fact__value" id="factWeeks">—</p>
            <p class="fact__label">weekends until then</p>
        </div>
        <div class="fact glass reveal" data-delay="2">
            <p class="fact__value">∞</p>
            <p class="fact__label">reasons it’s worth the wait</p>
        </div>
    </div>

    <p class="countdown__note reveal">
        Placeholder — write what the first ten minutes will look like.
        The gate, the bag you will drop, the thing you will say first.
        Be embarrassingly specific. She will read this more than once.
    </p>
</section>

<?php
$nextPage = ['final-letter.php', 'One Last Thing'];
require 'includes/footer.php';
