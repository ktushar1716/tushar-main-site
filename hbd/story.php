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

   'sticker' is optional. Only some moments get one on purpose — if every
   entry had a sticker they would stop meaning anything. Drop the GIF in
   images/stickers/ and put its filename here.
   -------------------------------------------------------------------------- */
$timeline = [
    [
        'date'  => 'March 2024',
        'title' => 'One floor above us',
        'body'  => 'She lived exactly one floor above us — a friend, a sister, depending on the day. I already knew that some friend of hers was coming over. I had no reason to think it mattered. It is still the most important thing that has ever happened in that building.',
    ],
    [
        'date'  => 'The same day',
        'title' => 'Trying very hard to look calm',
        'body'  => 'I walked in, saw you, and immediately started acting cool — which is exactly what I do when I am nervous, and I am nervous around anyone I do not know yet. We did the hi, the hello, the polite nothing. I said almost nothing worth keeping. I remember all of it anyway.',
        'sticker' => 'bubu-wave.webp',
    ],
    [
        'date'  => 'One of those nights',
        'title' => 'The balcony',
        'body'  => 'Drunk, in the balcony, somewhere past the hour where people stop performing. That was our first real conversation. You told me about your past, I told you about mine, and neither of us once made the other feel like they had said too much. I remember thinking that I had barely known you any time at all, and I had never been that un-careful with anyone.',
        'sticker' => 'dudu-laughter.webp',
    ],
    [
        'date'  => 'And then, the same night',
        'title' => 'The first time I fell asleep next to you',
        'body'  => 'We came in from the balcony still talking. A hug that was not quite a hug, until it was. We cuddled, we talked till we stopped making sense, and we slept. Nothing about it felt like a beginning at the time. It was the beginning.',
        'sticker' => 'hug1.webp',
    ],
    [
        'date'  => 'The next day',
        'title' => 'And then you left',
        'body'  => 'You were only in Gurgaon for two or three days, and then you went home. That was the first time I had to learn the thing I have been learning ever since — that you leaving does not mean you are gone, it just means I have to wait. The flat felt strangely large that evening and I did not have a single good reason for it.',
        'sticker' => 'bubu-waiting-walk.webp',
    ],
    [
        'date'  => 'A few days later',
        'title' => 'The test',
        'body'  => 'Out of nowhere you sent me a psychological test for your project — pages of it — and asked me to fill in the answers. Nobody had ever asked me those questions before. I sat with it far longer than the project needed, answering honestly, mostly because it was you asking.',
    ],
    [
        'date'  => 'And then the verdict',
        'title' => 'You read me back to myself',
        'body'  => 'You evaluated it and then you started telling me things. About my head, about the way I handle things, about patterns I had never once put into words. You were annoyingly accurate. You still are. Nobody had ever paid that much attention to what was actually going on inside me.',
        'sticker' => 'dudu-phone-call.webp',
    ],
    [
        'date'  => 'Somewhere in all of that',
        'title' => 'What I found in you',
        'body'  => 'Kindness, first — the real kind, the kind that costs something and never announces itself. And then the listening. You actually listen, all the way to the end, without waiting for your turn to speak. You understand people instead of judging them, and you understood me before I had explained myself properly. That is when it stopped being a nice few days and started being you.',
        'sticker' => 'dudu-consoling-bubu.webp',
    ],
    [
        'date'  => '27 July 2025',
        'title' => 'The day you said yes',
        'body'  => 'I had typhoid. I was in no condition to be anybody’s boyfriend. You showed up anyway — looked after me, kept checking on me, and helped me with money when I needed it and could not bring myself to ask. That is the day I stopped wondering what kind of person you are.',
        'sticker' => 'bubu-dudu-round-hug.webp',
    ],
    [
        'date'  => 'The honest part',
        'title' => 'What I still owe you',
        'body'  => 'There are days I do not take care of you the way you take care of me. I know it, and I am not going to explain it away. What I can tell you is that I am trying — harder than it probably looks from where you are standing — and I am going to keep getting better at it, for as long as you let me.',
    ],
    [
        'date'  => 'Right now',
        'title' => 'Today',
        'body'  => 'You, reading this, on your birthday. Me, pretending I am not watching your face while you do. This is the good part, and I do not want to miss it while it is happening.',
        'sticker' => 'bubu-birthday-cake.webp',
    ],
    [
        'date'  => 'Coming',
        'title' => 'What I want next',
        'body'  => 'Both of us steady. Money that is not a worry at the end of the month, careers we are genuinely proud of, the freedom to say yes to things. And underneath all of it, the ordinary miracle I actually care about: us, together, happy, on a completely unremarkable Tuesday.',
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
