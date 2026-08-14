<?php
/* ==========================================================================
   HEAD.PHP
   Shared document head + fixed page chrome (loader, starfield, cursor glow,
   scroll progress). Included at the top of every page.

   Each page sets these BEFORE including this file:
     $page       — slug used for <body> class + active nav state
     $pageTitle  — browser tab title
     $showLoader — true only on index.php (cinematic intro)
   ========================================================================== */

/* --------------------------------------------------------------------------
   ❤  YOUR SETTINGS — change these four lines and the whole site updates.
   -------------------------------------------------------------------------- */
$HER_NICKNAME  = 'Abbbyyy shuuuuuu';         // your nickname for her
$YOUR_NAME     = 'Abbbyyy carrrr, always';   // how you sign the letters
$HER_AGE       = 16;                         // how many candles go on the cake
$DISTANCE_KM   = 2140;                       // how far apart you actually are —
                                             // this is the game's finish line
$SITE_TITLE    = 'Happy Birthday, ' . $HER_NICKNAME;
/* -------------------------------------------------------------------------- */

$page       = $page       ?? 'home';
$pageTitle  = $pageTitle  ?? $SITE_TITLE;
$showLoader = $showLoader ?? false;

/** Small helper so we never echo raw user text into the markup. */
if (!function_exists('e')) {
    function e(string $value): string {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#08070c">
    <meta name="description" content="A birthday letter, written in code.">
    <meta name="robots" content="noindex, nofollow">

    <title><?php echo e($pageTitle); ?></title>

    <!-- Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🤍</text></svg>">
</head>

<body class="page-<?php echo e($page); ?>" data-page="<?php echo e($page); ?>">

<a class="skip-link" href="#content">Skip to content</a>

<?php if ($showLoader): ?>
<!-- ==========================================================================
     CINEMATIC LOADING SCREEN — only on the home page, once per visit
     ========================================================================== -->
<div class="loader" id="loader" role="status" aria-live="polite" aria-label="Loading">

    <!-- Bubu waits alone → Dudu arrives → they hug.
         REPLACE THESE THREE GIFs:
           bubu-wait.gif  — Bubu sitting/waiting by himself
           dudu-arrive.gif — Dudu walking in
           hug.gif        — the two of them hugging               -->
    <div class="loader__stage" aria-hidden="true">
        <span class="sticker-box sticker-box--lg loader__bubu">
            <img class="sticker" src="images/stickers/bubu-waiting-walk.webp" alt="">
        </span>
        <span class="sticker-box sticker-box--lg loader__dudu">
            <img class="sticker" src="images/stickers/dudu-running.webp" alt="">
        </span>
        <span class="sticker-box sticker-box--xl loader__hug">
            <img class="sticker" src="images/stickers/hug1.webp" alt="">
        </span>
    </div>

    <div class="loader__inner">
        <p class="loader__line" data-line="1">Someone made something<span class="loader__dots">...</span></p>
        <p class="loader__line" data-line="2">Just for you<span class="loader__dots">...</span></p>
        <p class="loader__line loader__line--final" data-line="3">Happy Birthday <span class="loader__heart">❤</span></p>
    </div>
    <button class="loader__skip" id="loaderSkip" type="button">Skip intro</button>
</div>
<?php endif; ?>

<!-- Reading progress bar (top of viewport) -->
<div class="progress-bar" id="progressBar" role="progressbar" aria-label="Page scroll progress" aria-hidden="true"></div>

<!-- Drifting starfield — pure canvas, sits behind everything -->
<canvas class="starfield" id="starfield" aria-hidden="true"></canvas>

<!-- Ambient gradient blooms for depth -->
<div class="ambient" aria-hidden="true">
    <span class="ambient__blob ambient__blob--purple"></span>
    <span class="ambient__blob ambient__blob--pink"></span>
</div>

<!-- Soft glow that follows the pointer (hidden on touch devices) -->
<div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>

<!-- 🌙 Easter egg #1 — she has to be curious enough to click it -->
<button class="moon" id="moon" type="button" aria-label="A little moon"></button>

<!-- Hidden-hearts scoreboard. Stays out of the way until she finds the first one. -->
<a class="hunt" id="hunt" href="secret.php" hidden
   aria-label="Hidden hearts found">
    <span class="hunt__icon" aria-hidden="true">♥</span>
    <span class="hunt__count"><span id="huntFound">0</span>/16</span>
</a>

<!-- Hidden message toast, populated by script.js -->
<div class="toast" id="toast" role="status" aria-live="polite"></div>

<!-- Everything below fades as one block during page transitions.
     navbar.php opens <main>, footer.php closes it. -->
<div class="page" id="page">
