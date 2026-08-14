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
            I have said all of this to you in pieces, badly, usually at the wrong hour.
            So here it is properly, in one go, the way I would say it if you were sitting
            right in front of me and I had already decided not to stop halfway.
        </p>

        <p class="reveal">
            Today is not about birthdays. It is about the fact that you exist at all —
            that on this date, a specific person got born, and out of every possible
            timing in the world, the timing worked out enough for that person to end up
            one floor above me for two or three days. I do not think about that too
            carefully, because it would be terrifying to realise how easily it might
            not have happened.
        </p>

        <p class="reveal">
            And I will not pretend the rest of it is easy. It isn’t. The calls end before
            either of us wants them to. There are days where the only version of you I get
            is text on a screen, and days where I know something is wrong and there is
            physically nothing I can do about it. I have missed things I should have been
            at. I hate that part, and I am not going to dress it up, because pretending it
            is fine would cheapen everything else on this page.
        </p>

        <p class="reveal">
            But here is what the distance has proved. Nothing about us is convenient.
            Nobody is bumping into anybody, nothing is happening by accident. Every single
            day, both of us have to choose this again — and we do, including on the days
            when it would have been so much easier not to. Most people never find out
            whether their thing would survive that. We already know.
        </p>

        <p class="reveal">
            Thank you. For the patience, which I have tested. For being kind to me on days
            when you had every reason not to be. For looking after me when I was ill and
            useless and could not even bring myself to ask, and for never once holding it
            over my head afterwards. For staying, in the small unremarkable ways nobody
            writes songs about.
        </p>

        <p class="reveal">
            You changed something in me, and I want to be specific about it. Before you,
            I was quietly convinced that being fully known by someone would end badly —
            so I stayed at arm’s length from everyone and called it being independent.
            Then you asked me actual questions, read me back to myself, and did not leave.
            You made honesty feel survivable. That is not a small edit to a person. That
            is the whole architecture.
        </p>

        <p class="reveal">
            So the promise is a small one, because small ones are the ones people actually
            keep. I will not go quiet on you. When my head gets loud I will tell you it is
            loud instead of disappearing and letting you guess. And I will keep getting
            better at taking care of you — not perfectly, not overnight, but genuinely,
            as the thing I am actually working on.
        </p>

        <p class="reveal">
            And the future I keep coming back to is not a grand one. It is a morning.
            A kitchen that is ours, both of us moving around it badly, no plans for the
            day, no flight booked, nothing to count down to. You are talking too fast
            about something you love. I am half listening and completely happy. That
            is it. That is the whole ambition.
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
         ---------------------------------------------------------------------- -->
    <section class="finale" id="finale" aria-label="A small goodbye">
        <div class="finale__stage" aria-hidden="true">
            <span class="sticker-box sticker-box--lg finale__bubu">
                <img class="sticker" src="images/stickers/bubu-waiting-walk.webp" alt="">
            </span>
            <span class="sticker-box sticker-box--lg finale__dudu">
                <img class="sticker sticker--flip" src="images/stickers/dudu-not-wave.webp" alt="">
            </span>
            <span class="sticker-box sticker-box--xl finale__hug">
                <img class="sticker" src="images/stickers/hug1.webp" alt="">
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
