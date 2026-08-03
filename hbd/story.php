<?php
/* ==========================================================================
   STORY.PHP — Page 2
   An interactive, scroll-revealed timeline of us.
   ========================================================================== */
$page      = 'story';
$pageTitle = 'Our Story';
require 'includes/head.php';
require 'includes/navbar.php';

/* --------------------------------------------------------------------------
   THE TIMELINE — edit date / title / body. Add or remove entries freely;
   the alternating layout and the connecting line adapt automatically.

   'sticker' is optional. Only five moments get one on purpose — if every
   entry had a sticker they would stop meaning anything. Drop the GIF in
   images/stickers/ and put its filename here.
   -------------------------------------------------------------------------- */
$timeline = [
    [
        'date'  => 'Day one',
        'title' => 'How we met',
        'body'  => 'Placeholder — the completely unremarkable way it started. The app, the group chat, the friend, the coincidence. Write it plainly, because the ordinariness of it is the best part.',
    ],
    [
        'date'  => 'That same week',
        'title' => 'Our first conversation',
        'body'  => 'Placeholder — what you talked about for far too long. The first message you re-read before sending. The moment you realised you were trying to be interesting.',
    ],
    [
        'date'  => 'Not long after',
        'title' => 'Our first call',
        'body'  => 'Placeholder — how nervous you were, how long it lasted, and the exact moment the nervousness quietly disappeared and never came back.',
        'sticker' => 'bubu-phone-call.webp',        // REPLACE: Bubu or Dudu on the phone
    ],
    [
        'date'  => 'Somewhere in there',
        'title' => 'The first time you made me laugh',
        'body'  => 'Placeholder — the joke, the timing, the fact that you laughed out loud alone in a room and had to explain yourself to someone.',
        'sticker' => 'dudu-laughter.webp',        // REPLACE: laughing / rolling sticker
    ],
    [
        'date'  => 'The first ache',
        'title' => 'The first “I miss you”',
        'body'  => 'Placeholder — who said it first, how long you had both been avoiding saying it, and what it changed.',
    ],
    [
        'date'  => 'The big one',
        'title' => 'The first “I love you”',
        'body'  => 'Placeholder — where you were, what time it was, and whether you had planned it. (You hadn’t.)',
        'sticker' => 'love-hug.gif',     // REPLACE: the heart / hug sticker
    ],
    [
        'date'  => 'Still my favourite',
        'title' => 'Our favourite memory',
        'body'  => 'Placeholder — the day you would live again exactly as it happened, without changing a single second of it.',
    ],
    [
        'date'  => 'The hard part',
        'title' => 'Distance',
        'body'  => 'Placeholder — be honest here. The timezones, the missed calls, the nights it felt unfair. And then: why it has never once felt like a reason to stop.',
        'sticker' => 'bubu-miss-you.gif',     // REPLACE: sad / longing sticker
    ],
    [
        'date'  => 'Right now',
        'title' => 'Today',
        'body'  => 'Placeholder — where you both are as she reads this, and what you would be doing if the map were kinder.',
        'sticker' => 'bubu-birthday-cake.webp',         // REPLACE: birthday cake sticker
    ],
    [
        'date'  => 'Coming',
        'title' => 'Our future',
        'body'  => 'Placeholder — the apartment, the airport, the ordinary Tuesday morning together. The version of this story where the distance is just a chapter, not the setting.',
    ],
];
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="page-head">
    <p class="section__eyebrow reveal">Two</p>
    <h1 class="page-head__title reveal">Our story</h1>
    <p class="page-head__lede reveal">
        Everything that had to happen, in the exact order it happened,
        for you to be reading this right now.
    </p>
</section>

<!-- ==========================================================================
     TIMELINE
     ========================================================================== -->
<section class="section section--tight">
    <ol class="timeline">
        <?php foreach ($timeline as $i => $item): ?>
            <li class="timeline__item reveal <?php echo $i % 2 === 0 ? 'timeline__item--left' : 'timeline__item--right'; ?>">
                <span class="timeline__marker" aria-hidden="true">
                    <span class="timeline__dot"></span>
                </span>

                <article class="timeline__card glass">
                    <div class="timeline__top">
                        <p class="timeline__date"><?php echo e($item['date']); ?></p>

                        <?php if (!empty($item['sticker'])): ?>
                            <!-- Sticker for this moment — filename comes from $timeline above -->
                            <span class="sticker-box sticker-box--sm timeline__sticker">
                                <img class="sticker"
                                     src="images/stickers/<?php echo e($item['sticker']); ?>" alt="">
                            </span>
                        <?php endif; ?>
                    </div>

                    <h2 class="timeline__title"><?php echo e($item['title']); ?></h2>
                    <p class="timeline__body"><?php echo e($item['body']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ol>

    <p class="timeline__end reveal">…and the rest of it hasn’t been written yet.</p>
</section>

<?php
$nextPage = ['memories.php', 'Memories'];
require 'includes/footer.php';
