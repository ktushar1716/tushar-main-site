<?php
/* ==========================================================================
   LETTERS.PHP — Page 4
   "Open when…" envelopes. Click one, the flap lifts, the letter slides out.
   ========================================================================== */
$page      = 'letters';
$pageTitle = 'Open When…';
require 'includes/head.php';
require 'includes/navbar.php';

/* --------------------------------------------------------------------------
   THE LETTERS
   'label'  — what she reads on the closed envelope
   'note'   — small line under the label
   'body'   — array of paragraphs (add as many as you like)
   'sign'   — the closing line
   -------------------------------------------------------------------------- */
$letters = [
    [
        'label' => 'Open when you miss me',
        'note'  => 'for the nights the distance gets loud',
        'sticker' => 'miss-you.gif',   // REPLACE with your GIF
        'body'  => [
            'Placeholder — start by telling her you miss her too, right now, at whatever moment she is reading this. Do not be brave about it.',
            'Placeholder — remind her of something small and physical. The sound of your voice. A specific hug. The way she fits somewhere.',
            'Placeholder — end with the maths. The number of days, the plan, the plane ticket, the certainty. Missing someone is easier when it has an end date.',
        ],
        'sign'  => 'I miss you more. Always have.',
    ],
    [
        'label' => 'Open when you’re sad',
        'note'  => 'no advice, promise',
        'sticker' => 'comfort.gif',   // REPLACE with your GIF
        'body'  => [
            'Placeholder — do not fix anything here. Just tell her it is allowed. That she does not have to be okay to be loved.',
            'Placeholder — remind her of a time she felt like this before and it passed, because she will not remember that on her own right now.',
            'Placeholder — tell her exactly what you would do if you were there. Be specific. Specific is what makes it feel real.',
        ],
        'sign'  => 'Sit here as long as you need. I’m not going anywhere.',
    ],
    [
        'label' => 'Open when you’re stressed',
        'note'  => 'read slowly, breathe first',
        'sticker' => 'calm.gif',   // REPLACE with your GIF
        'body'  => [
            'Placeholder — tell her to put the phone down for ten seconds first. Actually mean it.',
            'Placeholder — remind her of everything she has already survived that once looked exactly this impossible.',
            'Placeholder — give her permission to do it badly. To do the minimum. To rest without earning it.',
        ],
        'sign'  => 'It will get done. And if it doesn’t, you’ll still be enough.',
    ],
    [
        'label' => 'Open when you can’t sleep',
        'note'  => 'for 3am, when the ceiling is boring',
        'sticker' => 'sleepy.gif',   // REPLACE with your GIF
        'body'  => [
            'Placeholder — write this one softly. Short sentences. Like you are actually whispering.',
            'Placeholder — tell her a slow, pointless, comforting story. The future apartment. The imaginary morning. The plan for a day you have not had yet.',
            'Placeholder — end by telling her to close her eyes. Then say goodnight properly.',
        ],
        'sign'  => 'Goodnight. I’ve got the worrying covered tonight.',
    ],
    [
        'label' => 'Open after a bad day',
        'note'  => 'the world was rude to you today',
        'sticker' => 'pat-head.gif',   // REPLACE with your GIF
        'body'  => [
            'Placeholder — let her be angry first. Take her side completely and unfairly.',
            'Placeholder — then remind her that today is one day, and it does not get to represent her.',
            'Placeholder — tell her what you love about who she is when things go wrong, not just when they go right.',
        ],
        'sign'  => 'Today was bad. You weren’t.',
    ],
    [
        'label' => 'Open when you need motivation',
        'note'  => 'in case you forgot who you are',
        'sticker' => 'cheer.gif',   // REPLACE with your GIF
        'body'  => [
            'Placeholder — list the things she has done that she does not give herself any credit for.',
            'Placeholder — name the exact quality of hers that you would steal if you could.',
            'Placeholder — tell her you believe her. Not in her — her. There is a difference and she will feel it.',
        ],
        'sign'  => 'Now go. I’ll be here when you get back.',
    ],
    [
        'label' => 'Open on our anniversary',
        'note'  => 'not to be opened early. I mean it.',
        'sticker' => 'cake.gif',   // REPLACE with your GIF
        'body'  => [
            'Placeholder — start with the date. Where you both were. Who you both were then.',
            'Placeholder — the honest part: what this year cost, what it taught you, what you would not trade.',
            'Placeholder — the promise for the next one. Keep it small and keep it real, because those are the ones you keep.',
        ],
        'sign'  => 'One more year of you. Selfishly, I want all of them.',
    ],
];
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="page-head">
    <p class="section__eyebrow reveal">Four</p>
    <h1 class="page-head__title reveal">Open when…</h1>
    <p class="page-head__lede reveal">
        Letters for the days I can’t be there. Which is most of them, for now.
        <span class="page-head__lede-soft">Only open the one you need.</span>
    </p>
</section>

<!-- ==========================================================================
     ENVELOPES
     ========================================================================== -->
<section class="section section--tight">
    <div class="envelopes">
        <?php foreach ($letters as $i => $letter): ?>
            <button class="envelope reveal" type="button"
                data-delay="<?php echo $i % 3; ?>"
                data-letter="<?php echo $i; ?>"
                aria-haspopup="dialog"
                aria-label="Open the letter: <?php echo e($letter['label']); ?>">
                <!-- A little companion sitting on top of the envelope.
                     Filename comes from $letters above — swap the GIFs freely. -->
                <?php if (!empty($letter['sticker'])): ?>
                    <span class="sticker-box sticker-box--sm envelope__sticker" aria-hidden="true">
                        <img class="sticker"
                             src="images/stickers/<?php echo e($letter['sticker']); ?>" alt="">
                    </span>
                <?php endif; ?>

                <!-- envelope body -->
                <span class="envelope__paper" aria-hidden="true"></span>
                <span class="envelope__flap" aria-hidden="true"></span>
                <span class="envelope__seal" aria-hidden="true"></span>

                <span class="envelope__text">
                    <span class="envelope__label"><?php echo e($letter['label']); ?></span>
                    <span class="envelope__note"><?php echo e($letter['note']); ?></span>
                </span>

                <!-- hidden content, read by script.js -->
                <template class="envelope__content">
                    <?php foreach ($letter['body'] as $para): ?>
                        <p><?php echo e($para); ?></p>
                    <?php endforeach; ?>
                    <p class="letter__sign"><?php echo e($letter['sign']); ?></p>
                    <p class="letter__from">— <?php echo e($YOUR_NAME); ?></p>
                </template>
            </button>
        <?php endforeach; ?>
    </div>
</section>

<!-- ==========================================================================
     LETTER MODAL (populated by script.js)
     ========================================================================== -->
<div class="letter-modal" id="letterModal" role="dialog" aria-modal="true"
    aria-labelledby="letterTitle" hidden>
    <div class="letter-modal__backdrop" data-close></div>

    <article class="letter glass" role="document">
        <button class="letter__close" id="letterClose" type="button" aria-label="Close letter">×</button>
        <p class="letter__eyebrow">A letter</p>
        <h2 class="letter__title" id="letterTitle"></h2>
        <div class="letter__body" id="letterBody"></div>
    </article>
</div>

<?php
$nextPage = ['playlist.php', 'Playlist'];
require 'includes/footer.php';
