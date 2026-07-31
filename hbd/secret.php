<?php
/* ==========================================================================
   SECRET.PHP
   Unlocked only after all 16 hidden hearts have been found. The gate is
   handled in script.js (it reads the saved progress) — until then she gets
   the locked panel instead.
   ========================================================================== */
$page      = 'secret';
$pageTitle = 'You found them all';
require 'includes/head.php';
require 'includes/navbar.php';
?>

<!-- ==========================================================================
     LOCKED — shown when the hearts haven't all been found yet
     ========================================================================== -->
<section class="secret-locked" id="secretLocked">
    <span class="sticker-box sticker-box--md" aria-hidden="true">
        <!-- REPLACE: peek.gif — one of them peeking around a corner -->
        <img class="sticker" src="images/stickers/peek.gif" alt="">
    </span>

    <h1 class="secret-locked__title">Not yet.</h1>
    <p class="secret-locked__text">
        There are <strong>16</strong> little hearts hidden across these pages.
        You’ve found <strong><span id="secretProgress">0</span></strong> so far.
    </p>
    <p class="secret-locked__hint">
        They’re small, and they glow a bit. Try the corners of things.
    </p>

    <a class="btn btn--ghost" href="index.php">Go back and look properly</a>
</section>

<!-- ==========================================================================
     UNLOCKED — the reward
     ========================================================================== -->
<article class="secret" id="secretContent" hidden>

    <header class="secret__head">
        <p class="secret__eyebrow">16 / 16</p>
        <h1 class="secret__title">You found<br><em>every single one</em></h1>
        <span class="final__rule" aria-hidden="true"></span>
    </header>

    <div class="secret__body">
        <p class="secret__lead">
            Placeholder — tell her you genuinely didn’t expect her to find all sixteen,
            and that of course she did.
        </p>

        <p>
            Placeholder — this page is the one nobody else was ever going to see.
            Write the thing you were slightly too shy to put on the main pages.
        </p>

        <p>
            Placeholder — a promise, a plan, or a confession. Whichever one you’ve been
            carrying around.
        </p>

        <p>
            Placeholder — and then something light, so she finishes smiling rather than
            crying. You know which story to use.
        </p>
    </div>

    <div class="secret__gift">
        <span class="sticker-box sticker-box--lg" aria-hidden="true">
            <!-- REPLACE: gift.gif — Bubu & Dudu with a present -->
            <img class="sticker" src="images/stickers/gift.gif" alt="">
        </span>
        <p class="secret__gift-text">
            Placeholder — if there’s a real present, this is where you tell her
            where to find it.
        </p>
    </div>

    <p class="secret__signoff">
        Still yours,<br>
        <span class="final__name"><?php echo e($YOUR_NAME); ?></span>
    </p>
</article>

<?php
require 'includes/footer.php';
