<?php
/* ==========================================================================
   GAME.PHP — Page 5
   "Bring me home" — a little runner. Bubu runs the whole distance between
   you two. She taps to jump. The progress bar is the actual distance, and
   the things in the way are the things that are actually in the way.

   Set the distance in includes/head.php ($DISTANCE_KM).
   ========================================================================== */
$page      = 'game';
$pageTitle = 'Bring Me Home';
require 'includes/head.php';
require 'includes/navbar.php';

/* --------------------------------------------------------------------------
   THE MILESTONES
   Every time she gets this far along, the world slows right down and one of
   these lines floats up over it. Four is the right number — more and they
   stop feeling like a reward. 'at' is a percentage of the total distance.
   -------------------------------------------------------------------------- */
$milestones = [
    ['at' => 20, 'line' => 'When I realised this was going to be long distance, my first thought was not “can we do this.” It was “I am not letting this go.”'],
    ['at' => 44, 'line' => 'There was a night it nearly got too heavy. You didn’t argue me out of it. You just stayed on the call and said you weren’t going anywhere, and that was enough.'],
    ['at' => 68, 'line' => 'Something I’ve never told you: while I wait for you to reply, I open the chat, read the last thing you sent, and close it. Repeatedly. Like an idiot.'],
    ['at' => 88, 'line' => 'This is a game, so it ends in a few minutes. In the real world it takes longer — but it ends the same way. I’m still running.'],
];

/* --------------------------------------------------------------------------
   THE THINGS IN THE WAY
   These are what she jumps over. Keep them short — two or three words —
   because they get printed on the obstacles themselves. Make them the real
   ones. It is funnier and it lands harder.

   'h' is how tall it is: 1 = easy hop, 2 = proper jump, 3 = the mean one.
   -------------------------------------------------------------------------- */
$obstacles = [
    ['label' => 'timezones',     'h' => 1],
    ['label' => '3 AM',          'h' => 1],
    ['label' => 'bad signal',    'h' => 2],
    ['label' => 'one bar',       'h' => 1],
    ['label' => 'left on read',  'h' => 2],
    ['label' => 'work call',     'h' => 1],
    ['label' => '“brb”',         'h' => 2],
    ['label' => 'flight prices', 'h' => 3],
    ['label' => 'her exams',     'h' => 2],
    ['label' => 'low battery',   'h' => 1],
    ['label' => 'the airport',   'h' => 3],
];
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="page-head">
    <p class="section__eyebrow reveal">Five</p>
    <h1 class="page-head__title reveal">Bring me home</h1>
    <p class="page-head__lede reveal">
        There are <?php echo number_format($DISTANCE_KM); ?> kilometres between us. Close them.
        <span class="page-head__lede-soft">Tap, click or press space to jump.</span>
    </p>
</section>

<!-- ==========================================================================
     THE GAME
     Everything inside #world is moved by script.js. The stickers are real
     <img> elements rather than canvas sprites, so the GIFs actually animate.
     ========================================================================== -->
<section class="section section--tight">
    <div class="game reveal" id="game" data-distance="<?php echo (int) $DISTANCE_KM; ?>">

        <!-- Milestone lines + obstacle labels, handed to script.js as JSON -->
        <script type="application/json" id="gameMilestones"><?php
            echo json_encode($milestones, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        ?></script>
        <script type="application/json" id="gameObstacles"><?php
            echo json_encode($obstacles, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        ?></script>

        <!-- ------------------------------------------------------------------
             HUD
             ------------------------------------------------------------------ -->
        <div class="game__hud">
            <p class="game__lives" id="gameLives" aria-label="Tries left">
                <i class="game__life"></i><i class="game__life"></i><i class="game__life"></i>
            </p>

            <p class="game__dist">
                <span class="game__dist-value" id="gameKm"><?php echo number_format($DISTANCE_KM); ?></span>
                <span class="game__dist-label">km to go</span>
            </p>

            <p class="game__best" id="gameBest" hidden>
                best <span id="gameBestVal">0</span>%
            </p>
        </div>

        <!-- Progress rail. The pips are the milestones; the heart is her. -->
        <div class="game__rail" id="gameRail">
            <span class="game__rail-fill" id="gameFill"></span>
            <span class="game__rail-pips" id="gamePips" aria-hidden="true"></span>
            <span class="game__rail-home" aria-hidden="true">♥</span>
        </div>

        <!-- ------------------------------------------------------------------
             THE WORLD
             ------------------------------------------------------------------ -->
        <div class="world" id="world">
            <div class="world__sky"    aria-hidden="true"></div>
            <div class="world__far"    id="worldFar"    aria-hidden="true"></div>
            <div class="world__ground" id="worldGround" aria-hidden="true"></div>
            <div class="world__obs"    id="worldObs"    aria-hidden="true"></div>

            <!-- Him, running. REPLACE: bubu-run.gif for a proper running loop -->
            <span class="sticker-box sticker-box--md world__bubu" id="worldBubu" aria-hidden="true">
                <img class="sticker" src="images/stickers/bubu-running.webp" alt="">
            </span>

            <!-- Her, waiting at the end. Hidden until the last stretch. -->
            <span class="sticker-box sticker-box--md world__dudu" id="worldDudu" aria-hidden="true" hidden>
                <img class="sticker sticker--flip" src="images/stickers/dudu-not-wave.webp" alt="">
            </span>

            <!-- The whole point. REPLACE: hug.gif -->
            <span class="sticker-box sticker-box--lg world__hug" id="worldHug" aria-hidden="true" hidden>
                <img class="sticker" src="images/stickers/bubu-dudu-round-hug.webp" alt="">
            </span>

            <p class="world__milestone" id="worldMilestone" role="status" aria-live="polite"></p>

            <!-- --- Start ---------------------------------------------------- -->
            <div class="game__panel" id="gameStart">
                <span class="sticker-box sticker-box--sm game__panel-sticker" aria-hidden="true">
                    <img class="sticker" src="images/stickers/bubu-wave.webp" alt="">
                </span>
                <h2 class="game__panel-title">Get me to you</h2>
                <p class="game__panel-text">
                    Jump over everything that has ever got in the way.
                    Three tries. That is more than we needed in real life.
                </p>
                <button class="btn btn--primary game__panel-btn" id="gameStartBtn" type="button">
                    Start running
                </button>
                <p class="game__panel-hint">space / tap to jump · you get one jump in the air</p>
            </div>

            <!-- --- Failed --------------------------------------------------- -->
            <div class="game__panel game__panel--over" id="gameOver" hidden>
                <span class="sticker-box sticker-box--sm game__panel-sticker" aria-hidden="true">
                    <img class="sticker" src="images/stickers/bubu-crying-walk.webp" alt="">
                </span>
                <h2 class="game__panel-title">Not this time.</h2>
                <p class="game__panel-text">
                    You got <strong><span id="gameOverKm">0</span> km</strong> of the way.
                    <span class="game__panel-soft">Which is further than most people would go.</span>
                </p>
                <button class="btn btn--primary game__panel-btn" id="gameRetryBtn" type="button">
                    Try again
                </button>
            </div>

            <!-- --- Made it -------------------------------------------------- -->
            <div class="game__panel game__panel--win" id="gameWin" hidden>
                <p class="game__win-eyebrow">0 km to go</p>
                <h2 class="game__panel-title game__win-title">You brought me home.</h2>
                <p class="game__panel-text game__win-text">
                    The distance was always going to be something we got through, not
                    something that got us. And you should know: you have been doing the
                    jumping too, this whole time, on your side of the map, without a
                    scoreboard and without ever making it my problem. This one was never
                    only my run.
                </p>
                <button class="btn btn--ghost game__panel-btn" id="gameAgainBtn" type="button">
                    Run it again
                </button>
            </div>

            <!-- --- No-motion fallback: the lines, without the running ------- -->
            <div class="game__panel game__panel--calm" id="gameCalm" hidden>
                <h2 class="game__panel-title">The short version</h2>
                <div class="game__calm-lines" id="gameCalmLines"></div>
            </div>
        </div>

        <p class="game__controls" aria-hidden="true">
            <kbd>space</kbd> or <kbd>↑</kbd> to jump · tap anywhere on the strip on a phone
        </p>
    </div>

    <p class="game__note reveal">
        I have played this more times than I would like to admit, and the airport still
        catches me. That feels about right.
    </p>
</section>

<?php
$nextPage = ['wish.php', 'Make a Wish'];
require 'includes/footer.php';
