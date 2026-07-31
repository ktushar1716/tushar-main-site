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
    ['src' => 'images/memory-01.jpg', 'date' => 'The first photo',   'caption' => 'The one that started the folder', 'desc' => 'Placeholder — the first picture of her you ever saved, and the slightly embarrassing reason you saved it.', 'tall' => true],
    ['src' => 'images/memory-02.jpg', 'date' => 'A random Tuesday',  'caption' => 'Nothing happening at all',        'desc' => 'Placeholder — a completely uneventful day that somehow became one of your favourites.'],
    ['src' => 'images/memory-03.jpg', 'date' => 'Late night',        'caption' => '3:14 AM, apparently',             'desc' => 'Placeholder — the screenshot of a call that went far too long and ended far too early.'],
    ['src' => 'images/memory-04.jpg', 'date' => 'That trip',         'caption' => 'You, laughing at me',             'desc' => 'Placeholder — what you had just said to cause that face.'],
    ['src' => 'images/memory-05.jpg', 'date' => 'Festival season',   'caption' => 'All dressed up',                  'desc' => 'Placeholder — how long she took, and how completely worth it it was.', 'tall' => true],
    ['src' => 'images/memory-06.jpg', 'date' => 'Sunday morning',    'caption' => 'Hair everywhere',                 'desc' => 'Placeholder — the unposed one she told you to delete. You did not delete it.'],
    ['src' => 'images/memory-07.jpg', 'date' => 'The airport',       'caption' => 'Before, or after',                'desc' => 'Placeholder — arrivals or departures. Both hurt in different ways.'],
    ['src' => 'images/memory-08.jpg', 'date' => 'Our spot',          'caption' => 'The usual place',                 'desc' => 'Placeholder — the café, the bench, the corner of a room that belongs to the two of you now.'],
    ['src' => 'images/memory-09.jpg', 'date' => 'Silly hour',        'caption' => 'Absolute nonsense',               'desc' => 'Placeholder — the photo that makes no sense to anyone else on earth.'],
    ['src' => 'images/memory-10.jpg', 'date' => 'Golden hour',       'caption' => 'The light liked you',             'desc' => 'Placeholder — the evening you took forty photos and every single one was good.', 'tall' => true],
    ['src' => 'images/memory-11.jpg', 'date' => 'Screenshot',        'caption' => 'The text I kept',                 'desc' => 'Placeholder — the message you screenshotted and still open sometimes.'],
    ['src' => 'images/memory-12.jpg', 'date' => 'Someday soon',      'caption' => 'Reserved',                        'desc' => 'Placeholder — this frame is deliberately empty. It is for the next time.'],
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
                <!-- REPLACE: hug.gif -->
                <img class="sticker" src="images/stickers/hug.gif" alt="">
            </span>
            <p class="puzzle__done-title">You put us back together.</p>
            <p class="puzzle__done-text">
                Placeholder — write the message she gets for finishing it. Something about
                how this is basically what the two of you have been doing all year: taking
                something scattered across a map and quietly fitting it back into place.
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
