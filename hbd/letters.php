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
   'label'   — what she reads on the closed envelope
   'note'    — small line under the label
   'sticker' — sits on the closed envelope (optional)
   'open'    — sticker revealed INSIDE the letter, only once she opens it (optional)
   'body'    — array of paragraphs (add as many as you like)
   'sign'    — the closing line
   -------------------------------------------------------------------------- */
$letters = [
    [
        'label' => 'Open when you miss me',
        'note'  => 'for the hours I’m not next to you',
        'sticker' => 'bubu-miss-you.gif',
        // He's missing her on the envelope; opening it hands her the phone.
        'open'  => 'bubu-phone-call.webp',
        'body'  => [
            'Whatever time it is right now, I miss you too. Not in a poetic way — in a boring, physical, where-are-you way. So don’t be brave about it. You’re allowed to miss me loudly.',
            'Think about the weight of my arm when you’re falling asleep, and the way you fit under it without either of us deciding to. That hasn’t gone anywhere. It’s just waiting for you.',
            'And this one is fixable, which is the best part. Call me. Even if it’s late, even if you have nothing to say, even if you just want to stay on the line while you do something else. I’ll pick up. I always pick up for you.',
        ],
        'sign'  => 'I miss you more. And I missed you first, every single time.',
    ],
    [
        'label' => 'Open when you’re sad',
        'note'  => 'no advice, promise',
        'sticker' => 'bubu-crying-walk.webp',
        // Sad on the outside, someone sitting with her on the inside.
        'open'  => 'dudu-consoling-bubu.webp',
        'body'  => [
            'You don’t have to be okay right now. Not for me, not for anyone. Nothing about how much I love you depends on you holding it together today.',
            'You have felt exactly this before. I know you can’t remember that at the moment, so I’ll remember it for you — it passed. It always passed. It didn’t take courage, it just took time.',
            'If I’m not there right now, here’s what I would be doing: sitting next to you, saying nothing, one hand on your head, asking no questions and fixing nothing. You can have that whenever you want it. Just say the word and I’ll come.',
        ],
        'sign'  => 'Sit here as long as you need. I’m not going anywhere.',
    ],
    [
        'label' => 'Open when you’re stressed',
        'note'  => 'read slowly, breathe first',
        'sticker' => 'bubu-waiting-walk.webp',
        'body'  => [
            'Stop for ten seconds. Actually stop. Breathe in properly, all the way down, and let it out slower than you took it in. I’ll wait — this letter isn’t going anywhere.',
            'Now think of everything you have already survived that looked exactly this unmanageable while you were inside it. All of it is behind you now. This is going to join that list too, and sooner than it feels.',
            'You’re allowed to do it badly. You’re allowed to do the bare minimum today and the rest tomorrow. You’re allowed to rest before you’ve earned it — you have been earning it for years.',
        ],
        'sign'  => 'It will get done. And if it doesn’t, you’ll still be enough.',
    ],
    [
        'label' => 'Open when you can’t sleep',
        'note'  => 'for 3am, when the ceiling is boring',
        'sticker' => 'phone-call.gif',
        'body'  => [
            'Hi. Quiet voice only. It’s late, and neither of us is going to solve anything at this hour, so let’s not try.',
            'Here’s what I’d rather you think about instead. A place that’s ours. Good work, no money worry sitting on the end of the month, a slow morning with nowhere to be. You’d sleep in. I’d let you. That’s the whole plan.',
            'Now close your eyes. Really. Put the phone face down and imagine I’m right behind you with my arm over you — because in every way that counts, I am.',
        ],
        'sign'  => 'Goodnight. I’ve got the worrying covered tonight.',
    ],
    [
        'label' => 'Open when you have a headache',
        'note'  => 'water first, argue later',
        // no sticker on the envelope — Dudu is the surprise waiting inside
        'open'  => 'dudu-hit-bubu.webp',
        'body'  => [
            'Before you read one more line: go and drink a full glass of water. Not a sip, not the last inch of whatever is on your desk. A full one. Nine times out of ten your head hurts because you have been running on chai, deadlines and almost no water since morning.',
            'Now the medicine. If it is the usual headache, take one. If it is the kind that starts in your stomach and climbs up, take something for the acidity instead — and eat something proper first, not a biscuit. You always know which one it is, and you always wait far too long before doing anything about it.',
            'Then: lights off, phone face down, twenty minutes of absolutely nothing. I am not asking. And if it is still there by tonight, you tell me — you look after me better than you look after yourself, and today I am returning the favour whether you like it or not.',
        ],
        'sign'  => 'Water. Medicine. Rest. In that order. Go.',
    ],
    [
        'label' => 'Open after a bad day',
        'note'  => 'the world was rude to you today',
        'sticker' => 'bubu-dudu-round-hug.webp',
        'body'  => [
            'Whoever it was, they were wrong, and I’m on your side. Completely, unfairly, without hearing the other version. Be angry first. I’ll be angry with you.',
            'Now the true part: today was one day. It doesn’t get to describe you, and it definitely doesn’t get to predict tomorrow.',
            'I love who you are when things go wrong, not just when they go right. You go quiet, and stubborn, and you keep going anyway. I have watched you do it up close. It is the most impressive thing about you.',
        ],
        'sign'  => 'Today was bad. You weren’t.',
    ],
    [
        'label' => 'Open when you need motivation',
        'note'  => 'in case you forgot who you are',
        'sticker' => 'bubu-running.webp',
        'body'  => [
            'You looked after a man with typhoid before you were even officially his. You carried things most people would have folded under, and then didn’t count a single one of them as an achievement. So let me count them for you.',
            'The thing I would steal from you if I could: you actually show up. Not in words — in doing. You did it for me when it cost you something, and you have never once held it over my head.',
            'I believe you. Not just in you — you. Whatever you have decided you’re going to do, go and do it. Your track record is far better than the version of it you keep in your head.',
        ],
        'sign'  => 'Now go. I’ll be here when you get back.',
    ],
    [
        'label' => 'Open when I’ve messed up',
        'note'  => 'because I will, and you deserve better than silence',
        'sticker' => 'hug1.webp',
        'body'  => [
            'If you’re reading this, I’ve probably been distant, or short with you, or just not there in the way you needed me to be. I’m not going to explain it away. You were right to feel it.',
            'It was never that I stopped caring. It’s that I’m still learning how to look after someone properly while my own head is loud. That’s my work to do, not yours to absorb.',
            'I am trying. I’ll keep trying, and I’ll keep getting better at this — not as a promise made in a good mood, but as the actual thing I’m working on. Tell me when I fall short. I would much rather hear it than lose you slowly.',
        ],
        'sign'  => 'Still yours, still learning. Don’t give up on me.',
    ],
    [
        'label' => 'Open on our anniversary',
        'note'  => '27th of July. Not to be opened early. I mean it.',
        'sticker' => 'bubu-birthday-dance.webp',
        'body'  => [
            '27 July 2025. I was ill, useless, and running on nothing, and that is somehow the day you decided to be mine. You took care of me, you helped me when I couldn’t ask for it, and you never once made it feel like charity. I have never understood the timing and I have never questioned it either.',
            'The honest bit: this year cost us something. Every real year does. But we are still here, and I know you now in a way I didn’t twelve months ago. I wouldn’t trade a single difficult week of it.',
            'And one small promise for the year ahead, because small ones are the ones people actually keep: I will take better care of you than I did this year. Not perfectly. Better. And the year after that, better again.',
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
                    <?php if (!empty($letter['open'])): ?>
                        <!-- Only shows up once the envelope is opened -->
                        <span class="sticker-box sticker-box--md letter__sticker" aria-hidden="true">
                            <img class="sticker"
                                 src="images/stickers/<?php echo e($letter['open']); ?>" alt="">
                        </span>
                    <?php endif; ?>

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
$nextPage = ['game.php', 'Bring Me Home'];
require 'includes/footer.php';
