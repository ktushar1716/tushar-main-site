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
        <img class="sticker" src="images/stickers/bubu-waiting-walk.webp" alt="">
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
            I hid sixteen of these expecting you to find maybe nine and give up somewhere
            around the letters. You found all of them. Of course you did. You are the most
            stubbornly attentive person I have ever met, and I should have known better.
        </p>

        <p>
            So here is the page nobody else was ever going to see. Everything out there
            was written knowing you might read it in front of someone. This one wasn’t.
            The truth is I am completely, unreasonably in love with you, in the way that
            is slightly embarrassing to admit at full volume — the kind where I have
            genuinely built parts of my future around a person who is two thousand
            kilometres away and has no idea how much space she takes up in my head.
        </p>

        <p>
            And the confession underneath it: I am scared of being loved this well, because
            I have not always known what to do with it, and there have been stretches where
            I handled it badly. You have seen those stretches. You stayed anyway. I am not
            going to waste that. I am going to keep learning how to hold this properly,
            for as long as you will let me — and I intend that to be a very long time.
        </p>

        <p>
            Anyway. You just spent a genuinely unreasonable amount of time hunting tiny
            hearts around a website your boyfriend built instead of sleeping, which tells
            me everything about both of us. Sixteen out of sixteen. Certified obsessed.
            I win the argument about which one of us is worse.
        </p>
    </div>

    <div class="secret__gift">
        <span class="sticker-box sticker-box--lg" aria-hidden="true">
            <img class="sticker" src="images/stickers/bubu-dudu-round-hug.webp" alt="">
        </span>
        <p class="secret__gift-text">
            There is one more thing, and it is not on this website. Call me when you get
            to this page — I have been waiting all day to tell you where it is, and I am
            not going to let a screen do it for me.
        </p>
    </div>

    <p class="secret__signoff">
        Still yours,<br>
        <span class="final__name"><?php echo e($YOUR_NAME); ?></span>
    </p>
</article>

<?php
require 'includes/footer.php';
