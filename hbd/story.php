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
        'sticker' => 'bubu-dudu-sleeping-1.webp',
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
        'sticker' => 'dudu-writing.webp',
    ],
    [
        'date'  => 'And then the verdict',
        'title' => 'You read me back to myself',
        'body'  => 'You evaluated it and then you started telling me things. About my head, about the way I handle things, about patterns I had never once put into words. You were annoyingly accurate. You still are. Nobody had ever paid that much attention to what was actually going on inside me.',
    ],
    [
        'date'  => 'Somewhere in all of that',
        'title' => 'What I found in you',
        'body'  => 'Kindness, first — the real kind, the kind that costs something and never announces itself. And then the listening. You actually listen, all the way to the end, without waiting for your turn to speak. You understand people instead of judging them, and you understood me before I had explained myself properly. That is when it stopped being a nice few days and started being you.',
        'sticker' => 'dudu-consoling-bubu.webp',
    ],
    [
        'date'  => 'Later in 2024',
        'title' => 'And then you came back',
        'body'  => 'You moved back to Gurgaon and started teaching — a classroom of your own, with Teach For India. You would come home worn out and still talk about those kids like they were yours. I do not think you have ever looked more like yourself than you did that year.',
        'sticker' => 'dudu-running.webp',
    ],
    [
        'date'  => 'For a while',
        'title' => 'You were living with me',
        'body'  => 'Not visiting. Living. Both of us in the same small ordinary days — food, work, mess, nothing worth writing down. It was the best stretch of my life and I did not once say that out loud while it was happening.',
        'sticker' => 'bubu-dudu-under-sheets.webp',
    ],
    [
        'date'  => 'The part I got wrong',
        'title' => 'I never actually said it',
        'body'  => 'I let you see it. I acted like it. I let you work it out for yourself — and I never said the words. You told me how you felt, more than once, and every single time I gave you something less than an answer. Not because it was not true. Because I was a coward about it.',
    ],
    [
        'date'  => 'November 2024',
        'title' => 'You walked away, and you were right to',
        'body'  => 'You chose yourself. You decided your love was worth more than being kept somewhere without an answer, by someone who was not doing anything to deserve it. I understood it completely, even then. That does not mean it did not gut me. It was the worst stretch of that year and every bit of it was my own doing.',
        'sticker' => 'bubu-crying-walk.webp',
    ],
    [
        'date'  => 'Some time after',
        'title' => 'You told me you were seeing someone',
        'body'  => 'You had every right to. I had given up any claim to an opinion months earlier. I did not argue and I did not make it your problem — but that was the moment I finally understood, properly, exactly what I had let go of by saying nothing.',
    ],
    [
        'date'  => 'January 2025',
        'title' => 'After the new year',
        'body'  => 'We started meeting again. And by then there was nothing careful left in what I felt — it was the biggest thing in my life and I already knew it. No more waiting to be sure. I had been sure the entire time.',
        'sticker' => 'phone-call.gif',
    ],
    [
        'date'  => 'Said plainly',
        'title' => 'I wronged you',
        'body'  => 'I am not going to soften this one. I treated you badly. You gave and gave and I let you do it without giving you the one thing you were actually asking for. I know exactly what that cost you. There is no version of this where I was hard done by. I love you, and I say it now because I did not say it then.',
    ],
    [
        'date'  => 'Through the spring',
        'title' => 'Slowly, back to each other',
        'body'  => 'Nothing sudden. No grand scene. Just the two of us drifting back the way we came, a little closer every month, both of us pretending we did not know where it was going.',
    ],
    [
        'date'  => '27 June 2025',
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
        'sticker' => 'bubu-dudu-sitting-under-ac.webp',
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
