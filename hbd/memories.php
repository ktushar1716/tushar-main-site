<?php
/* ==========================================================================
   MEMORIES.PHP — Page 3
   Responsive masonry-ish gallery with a keyboard-navigable lightbox.
   ========================================================================== */
$page      = 'memories';
$pageTitle = 'Memories';
require 'includes/head.php';
require 'includes/navbar.php';

/* --------------------------------------------------------------------------
   THE GALLERY
   Drop your photos in /images and change 'src' below. Nothing else to do —
   if a file is missing the card falls back to a soft gradient placeholder,
   so the page never looks broken while you are still collecting pictures.

   'tall' => true  makes a card span two rows (use it for portrait shots).
   -------------------------------------------------------------------------- */
$memories = [
    ['src' => 'images/memory-01.jpg', 'date' => 'The first photo',   'caption' => 'The one that started the folder', 'desc' => 'The first picture of you I ever saved. I told myself it was for no reason. There is now a folder, and the folder has subfolders, so we both know how that went.', 'tall' => true],
    ['src' => 'images/memory-02.jpg', 'date' => 'A random Tuesday',  'caption' => 'Nothing happening at all',        'desc' => 'Nothing happened this day. No plan, no occasion, nothing to report to anyone. It is still one of my favourites, and I think that is the entire point of you.'],
    ['src' => 'images/memory-03.jpg', 'date' => 'Late night',        'caption' => '3:14 AM, apparently',             'desc' => 'A call that went on far too long and still ended far too early. Neither of us wanted to be the one to hang up, so we just kept finding new things to say.'],
    ['src' => 'images/memory-04.jpg', 'date' => 'That trip',         'caption' => 'You, laughing at me',             'desc' => 'I have no memory of what I said. I remember exactly what your face did afterwards. I would happily be the joke every single day for that reaction.'],
    ['src' => 'images/memory-05.jpg', 'date' => 'Festival season',   'caption' => 'All dressed up',                  'desc' => 'You took an absurd amount of time getting ready and then walked out and made the entire wait look like a rounding error. I did not say much. I did not really have anything.', 'tall' => true],
    ['src' => 'images/memory-06.jpg', 'date' => 'Sunday morning',    'caption' => 'Hair everywhere',                 'desc' => 'The unposed one you told me to delete. I did not delete it. This is you before you have decided to be anything for anyone, and it is my favourite version.'],
    ['src' => 'images/memory-07.jpg', 'date' => 'The airport',       'caption' => 'Before, or after',                'desc' => 'Arrivals or departures — I genuinely cannot tell any more, and both of them hurt in their own way. One day we will go to one of these and nobody will be leaving.'],
    ['src' => 'images/memory-08.jpg', 'date' => 'Our spot',          'caption' => 'The usual place',                 'desc' => 'A corner of the world that quietly became ours without either of us announcing it. Nobody else knows it means anything. That is what makes it ours.'],
    ['src' => 'images/memory-09.jpg', 'date' => 'Silly hour',        'caption' => 'Absolute nonsense',               'desc' => 'This one makes no sense to anyone else on earth and perfect sense to the two of us. Ninety per cent of what we have is this, and I would not trade it for anything more dignified.'],
    ['src' => 'images/memory-10.jpg', 'date' => 'Golden hour',       'caption' => 'The light liked you',             'desc' => 'I took about forty photos that evening and every single one of them was good, which had nothing to do with the light and everything to do with you.', 'tall' => true],
    ['src' => 'images/memory-11.jpg', 'date' => 'Screenshot',        'caption' => 'The text I kept',                 'desc' => 'You probably typed this without thinking twice and forgot it the same hour. I screenshotted it. I still open it on the bad days. You have no idea how much work this one message has done.'],
    ['src' => 'images/memory-12.jpg', 'date' => 'Someday soon',      'caption' => 'Reserved',                        'desc' => 'This frame is empty on purpose. It belongs to the next time — the one where I do not have to count down to it, and neither do you.'],
];
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="page-head">
    <p class="section__eyebrow reveal">Three</p>
    <h1 class="page-head__title reveal">Memories</h1>
    <p class="page-head__lede reveal">
        Proof. In case you ever forget how good this has been.
        <span class="page-head__lede-soft">Tap any photo to open it.</span>
    </p>
</section>

<!-- ==========================================================================
     GALLERY
     ========================================================================== -->
<section class="section section--tight">
    <div class="gallery" id="gallery">
        <?php foreach ($memories as $i => $m): ?>
            <figure class="shot reveal<?php echo !empty($m['tall']) ? ' shot--tall' : ''; ?>"
                data-delay="<?php echo $i % 3; ?>">
                <button class="shot__btn" type="button"
                    data-index="<?php echo $i; ?>"
                    data-src="<?php echo e($m['src']); ?>"
                    data-date="<?php echo e($m['date']); ?>"
                    data-caption="<?php echo e($m['caption']); ?>"
                    data-desc="<?php echo e($m['desc']); ?>"
                    aria-label="Open photo: <?php echo e($m['caption']); ?>">
                    <span class="shot__media">
                        <img src="<?php echo e($m['src']); ?>"
                            alt="<?php echo e($m['caption']); ?>"
                            loading="lazy" decoding="async"
                            data-fallback="<?php echo e($m['caption']); ?>">
                    </span>
                    <span class="shot__overlay" aria-hidden="true">
                        <span class="shot__date"><?php echo e($m['date']); ?></span>
                        <span class="shot__caption"><?php echo e($m['caption']); ?></span>
                    </span>
                </button>
                <figcaption class="shot__meta">
                    <span class="shot__meta-date"><?php echo e($m['date']); ?></span>
                    <span class="shot__meta-caption"><?php echo e($m['caption']); ?></span>
                </figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
</section>

<!-- ==========================================================================
     THE PUZZLE
     Put our favourite photo at images/puzzle.jpg (square-ish works best).
     Change data-size to 4 for a harder 4×4 version.
     Until the photo exists the pieces show numbered gradients, so the game
     is still playable while you're choosing which picture to use.
     ========================================================================== -->
<section class="section" id="puzzle-section">
    <header class="section__head">
        <p class="section__eyebrow reveal">A small game</p>
        <h2 class="section__title reveal">Put us back together</h2>
        <p class="section__lede reveal">
            Drag the pieces into place. It’s a picture of us — you’ll know it when you see it.
            <span class="section__lede-soft">Drag, or tap two pieces to swap them</span>
        </p>
    </header>

    <div class="puzzle reveal" id="puzzle"
         data-image="images/puzzle.jpg"
         data-size="3">

        <div class="puzzle__frame">
            <!-- tiles are generated by script.js -->
            <div class="puzzle__board" id="puzzleBoard" role="group"
                 aria-label="Photo puzzle. Select a piece, then select another to swap them."></div>

            <!-- the finished photo animates here before the message arrives -->
            <div class="puzzle__flash" id="puzzleFlash" aria-hidden="true"></div>
        </div>

        <div class="puzzle__bar">
            <p class="puzzle__status" id="puzzleStatus" role="status" aria-live="polite">
                <span id="puzzleMoves">0</span> moves
            </p>
            <button class="puzzle__shuffle" id="puzzleShuffle" type="button">Shuffle again</button>
        </div>

        <!-- Revealed only once every piece is home -->
        <div class="puzzle__done" id="puzzleDone" hidden>
            <span class="sticker-box sticker-box--md puzzle__done-sticker" aria-hidden="true">
                <img class="sticker" src="images/stickers/hug1.webp" alt="">
            </span>
            <p class="puzzle__done-title">You put us back together.</p>
            <p class="puzzle__done-text">
                Which is more or less what we have been doing all year, just with fewer
                pieces and a lot more patience. Something scattered across a map, quietly
                being fitted back into place, one small move at a time. You have been doing
                most of the moving. I noticed.
            </p>
        </div>
    </div>
</section>

<!-- ==========================================================================
     LIGHTBOX (populated by script.js)
     ========================================================================== -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true"
    aria-labelledby="lightboxCaption" hidden>
    <div class="lightbox__backdrop" data-close></div>

    <div class="lightbox__panel glass" role="document">
        <button class="lightbox__close" id="lightboxClose" type="button"
            aria-label="Close photo">×</button>

        <button class="lightbox__nav lightbox__nav--prev" id="lightboxPrev" type="button"
            aria-label="Previous photo">‹</button>
        <button class="lightbox__nav lightbox__nav--next" id="lightboxNext" type="button"
            aria-label="Next photo">›</button>

        <div class="lightbox__media">
            <img id="lightboxImg" src="" alt="">
        </div>

        <div class="lightbox__info">
            <p class="lightbox__date" id="lightboxDate"></p>
            <h2 class="lightbox__caption" id="lightboxCaption"></h2>
            <p class="lightbox__desc" id="lightboxDesc"></p>
            <p class="lightbox__count" id="lightboxCount"></p>
        </div>
    </div>
</div>

<?php
$nextPage = ['letters.php', 'Open When Letters'];
require 'includes/footer.php';
