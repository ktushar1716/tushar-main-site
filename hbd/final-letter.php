<?php
/* ==========================================================================
   FINAL-LETTER.PHP — The ending
   Everything gets quieter here. No cards, no grids, no colour.
   Just type, space, and the letter.
   ========================================================================== */
$page      = 'final';
$pageTitle = 'One last thing';
require 'includes/head.php';
require 'includes/navbar.php';
?>

<!-- ==========================================================================
     THE LETTER
     Replace each paragraph. Keep them short — white space is doing work here.
     ========================================================================== -->
<article class="final">

    <header class="final__head">
        <p class="final__eyebrow reveal">The last page</p>
        <h1 class="final__title reveal">One last thing,<br><em><?php echo e($HER_NICKNAME); ?></em></h1>
        <span class="final__rule reveal" aria-hidden="true"></span>
    </header>

    <div class="final__body">
        <p class="final__lead reveal">
            Placeholder — open the way you would if she were sitting in front of you
            and you had already decided to say the whole thing out loud.
        </p>

        <p class="reveal">
            Placeholder — tell her what today means. Not birthdays in general. This one.
            The specific fact of her being born, and how strange and lucky it is that out
            of everything, the timing worked out enough for the two of you to find each other.
        </p>

        <p class="reveal">
            Placeholder — be honest about the distance. Say the hard part plainly: the calls
            that end too early, the timezones, the things you have missed. Do not pretend
            it is easy. She knows it isn’t, and pretending would cheapen the rest.
        </p>

        <p class="reveal">
            Placeholder — then turn it. Everything the distance has proven. That this was
            never propped up by convenience. That you have both chosen it, over and over,
            on days when it would have been easier not to.
        </p>

        <p class="reveal">
            Placeholder — the thank you. For patience. For the times she was kind when she
            had every reason not to be. For staying, in the small ordinary ways that nobody
            writes songs about.
        </p>

        <p class="reveal">
            Placeholder — what she has changed in you. Be specific and slightly unflattering
            about who you were before. That is what makes it land.
        </p>

        <p class="reveal">
            Placeholder — the promise. Not a grand one. A true one, small enough that you
            can keep it on your worst day.
        </p>

        <p class="reveal">
            Placeholder — and the future. One image of it. A morning, a kitchen, no plans,
            no flights booked, nothing to count down to.
        </p>

        <span class="final__rule final__rule--short reveal" aria-hidden="true"></span>

        <!-- ------------------------------------------------------------------
             The closing. These lines are the whole point — leave them be.
             ------------------------------------------------------------------ -->
        <div class="final__close">
            <p class="final__close-line reveal">Happy Birthday.</p>
            <p class="final__close-line reveal">Thank you for existing.</p>
            <p class="final__close-line final__close-line--soft reveal">
                Distance only changes where you are.
            </p>
            <p class="final__close-line final__close-line--soft reveal">
                It never changes what you mean to me.
            </p>

            <p class="final__signoff reveal">
                Love,<br>
                <span class="final__name"><?php echo e($YOUR_NAME); ?></span>
            </p>
        </div>
    </div>

    <!-- ----------------------------------------------------------------------
         THE FINALE
         Scrolls into view → Bubu walks toward Dudu → they hug → confetti,
         once → the last line fades in. Sequenced in script.js.
         REPLACE: bubu-walk.gif / dudu-wait.gif / hug.gif
         ---------------------------------------------------------------------- -->
    <section class="finale" id="finale" aria-label="A small goodbye">
        <div class="finale__stage" aria-hidden="true">
            <span class="sticker-box sticker-box--lg finale__bubu">
                <img class="sticker" src="images/stickers/bubu-walk.gif" alt="">
            </span>
            <span class="sticker-box sticker-box--lg finale__dudu">
                <img class="sticker sticker--flip" src="images/stickers/dudu-wait.gif" alt="">
            </span>
            <span class="sticker-box sticker-box--xl finale__hug">
                <img class="sticker" src="images/stickers/hug.gif" alt="">
            </span>
        </div>

        <p class="finale__line" id="finaleLine">
            One day, distance won’t matter anymore.
        </p>
    </section>

    <footer class="final__foot reveal">
        <a class="btn btn--ghost" href="index.php">Read it again from the start</a>
    </footer>
</article>

<?php
require 'includes/footer.php';
