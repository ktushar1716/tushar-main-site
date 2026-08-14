<?php
/* ==========================================================================
   WISH.PHP — Page 6
   The cake. One candle per year, and she has to put every one of them out.
   The room dims as they go. When the last one dies, everything comes back
   at once.

   Set the number of candles in includes/head.php ($HER_AGE).
   ========================================================================== */
$page      = 'wish';
$pageTitle = 'Make a Wish';
require 'includes/head.php';
require 'includes/navbar.php';

$candles = max(1, min(40, (int) $HER_AGE));   // the cake stops looking like a
                                              // cake somewhere past forty
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="page-head">
    <p class="section__eyebrow reveal">Six</p>
    <h1 class="page-head__title reveal">Make a wish</h1>
    <p class="page-head__lede reveal">
        <?php echo $candles; ?> candles. I lit them all myself, which took a while.
        <span class="page-head__lede-soft">Tap each one to blow it out.</span>
    </p>
</section>

<!-- ==========================================================================
     THE CAKE
     --lit (0 → 1) is written by script.js as candles go out. Everything that
     dims — the glow, the icing, the room — reads that one number.
     ========================================================================== -->
<section class="section section--tight wish" id="wish" data-candles="<?php echo $candles; ?>">

    <div class="cake-stage reveal">

        <!-- He is standing there holding it. REPLACE: bubu-birthday-cake.webp -->
        <span class="sticker-box sticker-box--md cake-stage__bubu" aria-hidden="true">
            <img class="sticker" src="images/stickers/bubu-birthday-cake.webp" alt="">
        </span>

        <div class="cake" id="cake">
            <!-- Candles ---------------------------------------------------- -->
            <div class="cake__candles" id="cakeCandles">
                <?php for ($i = 0; $i < $candles; $i++): ?>
                    <button class="candle" type="button"
                            data-candle="<?php echo $i; ?>"
                            style="--n: <?php echo $i; ?>"
                            aria-label="Blow out candle <?php echo $i + 1; ?>">
                        <span class="candle__flame" aria-hidden="true"></span>
                        <span class="candle__smoke" aria-hidden="true"></span>
                        <span class="candle__wax"   aria-hidden="true"></span>
                    </button>
                <?php endfor; ?>
            </div>

            <!-- The cake itself, built in CSS ------------------------------ -->
            <div class="cake__body" aria-hidden="true">
                <span class="cake__icing"></span>
                <span class="cake__tier cake__tier--top"></span>
                <span class="cake__tier cake__tier--mid"></span>
                <span class="cake__tier cake__tier--base"></span>
                <span class="cake__plate"></span>
            </div>
        </div>

        <!-- Sits on the plate once every candle is out.
             REPLACE: bubu-birthday-dance.webp -->
        <span class="sticker-box sticker-box--md cake-stage__dance" id="cakeDance" aria-hidden="true" hidden>
            <img class="sticker" src="images/stickers/bubu-birthday-dance.webp" alt="">
        </span>
    </div>

    <!-- Counter + the two ways to blow them out ---------------------------- -->
    <div class="wish__bar reveal" id="wishBar">
        <p class="wish__count" role="status" aria-live="polite">
            <span id="wishOut">0</span> of <?php echo $candles; ?> out
        </p>

        <!-- Nothing is requested until she presses this. The level meter is
             there so it's obvious the page is actually hearing something. -->
        <button class="wish__mic" id="wishMic" type="button" aria-pressed="false">
            <span class="wish__mic-icon" aria-hidden="true"></span>
            <span class="wish__mic-label" id="wishMicLabel">or actually blow into your mic</span>
            <span class="wish__mic-level" aria-hidden="true"><i id="wishMicBar"></i></span>
        </button>
    </div>

    <p class="wish__mic-note" id="wishMicNote" role="status" aria-live="polite" hidden></p>

    <!-- ----------------------------------------------------------------------
         THE WISH
         Hidden until the last flame goes out.
         ---------------------------------------------------------------------- -->
    <div class="wish__done" id="wishDone" hidden>
        <p class="wish__done-eyebrow">and that&rsquo;s all of them</p>

        <h2 class="wish__done-title">
            Happy Birthday,<br><em><?php echo e($HER_NICKNAME); ?></em>
        </h2>

        <div class="wish__done-body">
            <p>
                There. That’s all of them. I would have lit a hundred more if it meant
                keeping you here a little longer.
            </p>
            <p>
                You’re not supposed to say a wish out loud, so I’ll write it down instead
                and call it a loophole: I wished for the boring version. Same city, same
                bed, no counting down to anything. Nothing dramatic. Just you, close enough
                to reach, on an ordinary evening with nothing planned.
            </p>
            <p>
                And one that has nothing to do with me: I want this to be the year the
                effort finally pays you back. That the thing you have been quietly working
                at works out, that you stop measuring yourself so harshly, and that someone
                takes care of you as well as you take care of everyone else. I’d like that
                someone to be me. But mostly I just want it to happen.
            </p>
        </div>

        <p class="wish__done-sign">— <?php echo e($YOUR_NAME); ?></p>

        <button class="btn btn--ghost wish__relight" id="wishRelight" type="button">
            Light them again
        </button>
    </div>

    <p class="wish__note reveal">
        If the map were kinder, I would be standing behind you right now with my hands
        over your eyes, holding this cake badly, and you would already be laughing at me.
    </p>
</section>

<?php
$nextPage = ['final-letter.php', 'One Last Thing'];
require 'includes/footer.php';
