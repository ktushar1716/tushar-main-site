<?php
/* ==========================================================================
   HEADER.PHP — shared document head + fixed chrome + navigation.

   Every page sets what it needs BEFORE including this file, then includes it:

     $PAGE       — slug identifying the page. Drives the active nav link and
                   whether the nav links are in-page anchors or jumps back to
                   the home page. 'home' is special; anything else is a
                   standalone page.
     $PAGE_TITLE — <title>.
     $PAGE_DESC  — meta description.
     $PAGE_CSS   — array of extra stylesheet paths, loaded after style.css so
                   they can override it. Use this for page-specific CSS
                   instead of an inline <style> block.
     $USE_SWIPER — true to pull in the Swiper stylesheet. Off by default so
                   pages without a carousel don't pay for it.
     $NAV_SOLID  — true gives the navbar its filled background immediately.
                   Defaults to true on every page except home, where the nav
                   is meant to sit transparent over the full-height hero
                   until you scroll.
     $MAIN_CLASS — class on the opening <main>.
     $HEAD_EXTRA — raw markup appended to <head>, for anything the above
                   doesn't cover.

   This file opens <main>. Close it in the page, or via includes/footer.php.

   To add a page: create it, set the variables above, include this, and add
   an entry to $NAV_ITEMS below if it belongs in the navigation.
   ========================================================================== */

/* Canonical origin. Every page on the site resolves against this, so the
   duplicate addresses ( /index.php, http://www..., and so on ) all point
   search engines at one preferred URL. */
const SITE_URL = 'https://tusharkhamparia.in';

$PAGE       = $PAGE       ?? 'home';
$PAGE_TITLE = $PAGE_TITLE ?? 'Tushar Khamparia | UI / Frontend Developer';
$PAGE_DESC  = $PAGE_DESC  ?? 'UI / Frontend Developer with 3 years of experience building responsive marketing websites, landing pages, and campaign microsites. Based in Gurugram, India.';
$PAGE_PATH  = $PAGE_PATH  ?? '/';        // canonical path, e.g. '/projects.php'
$PAGE_CSS   = $PAGE_CSS   ?? [];
$USE_SWIPER = $USE_SWIPER ?? false;
$NAV_SOLID  = $NAV_SOLID  ?? ($PAGE !== 'home');
$MAIN_CLASS = $MAIN_CLASS ?? '';
$HEAD_EXTRA = $HEAD_EXTRA ?? '';

$isHome = ($PAGE === 'home');

/** Escape helper — never echo raw text into markup. */
if (!function_exists('e')) {
    function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

/**
 * Local asset URL with its modified time appended, so browsers fetch a fresh
 * copy whenever the file changes instead of reusing a stale cached one.
 */
if (!function_exists('asset')) {
    function asset(string $path): string
    {
        $file = dirname(__DIR__) . '/' . $path;
        return e(is_file($file) ? $path . '?v=' . filemtime($file) : $path);
    }
}

/* --------------------------------------------------------------------------
   NAVIGATION

   'hash' is the section on the home page. 'page' + 'slug' mark an item that
   also exists as a standalone page — 'Work' is the only one today, being both
   the #work section on home and projects.php in full.

   Links are resolved per page so that in-page anchors stay anchors: on home
   they must remain bare '#about' for the smooth-scroll handler in script.js,
   which binds to a[href^="#"]. From anywhere else they need the 'index.php'
   prefix to get back there first.
   -------------------------------------------------------------------------- */
$NAV_ITEMS = [
    ['label' => 'About',      'hash' => '#about'],
    ['label' => 'Expertise',  'hash' => '#expertise'],
    ['label' => 'Work',       'hash' => '#work', 'page' => 'projects.php', 'slug' => 'projects'],
    ['label' => 'Skills',     'hash' => '#skills'],
    ['label' => 'Experience', 'hash' => '#experience'],
    ['label' => 'Contact',    'hash' => '#contact'],
];

/**
 * Resolves one nav item for the current page.
 * @return array{href:string, active:bool}
 */
function nav_target(array $item, string $page, bool $isHome): array
{
    if (!empty($item['slug']) && $page === $item['slug']) {
        return ['href' => $item['page'], 'active' => true];      // already here
    }
    if ($isHome) {
        return ['href' => $item['hash'], 'active' => false];     // in-page anchor
    }
    return ['href' => 'index.php' . $item['hash'], 'active' => false];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($PAGE_TITLE); ?></title>
    <meta name="description" content="<?php echo e($PAGE_DESC); ?>">

    <!-- Crawling / indexing.
         `/` and `/index.php` return byte-identical pages, and the site also
         answers on http://www., so without a canonical the same content sits
         at several addresses and search engines have to guess which one is
         the real page. -->
    <link rel="canonical" href="<?php echo e(SITE_URL . $PAGE_PATH); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">

    <!-- Link previews (social, chat apps, search result cards) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Tushar Khamparia">
    <meta property="og:title" content="<?php echo e($PAGE_TITLE); ?>">
    <meta property="og:description" content="<?php echo e($PAGE_DESC); ?>">
    <meta property="og:url" content="<?php echo e(SITE_URL . $PAGE_PATH); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($PAGE_TITLE); ?>">
    <meta name="twitter:description" content="<?php echo e($PAGE_DESC); ?>">
    <?php if ($isHome): ?>

        <!-- Tells search engines who this site is about, rather than leaving them
         to infer it from the copy. -->
        <script type="application/ld+json">
            <?php echo json_encode([
                '@context'    => 'https://schema.org',
                '@type'       => 'Person',
                'name'        => 'Tushar Khamparia',
                'url'         => SITE_URL,
                'jobTitle'    => 'UI / Frontend Developer',
                'email'       => 'khampariatushar@gmail.com',
                'worksFor'    => ['@type' => 'Organization', 'name' => 'iCubesWire'],
                'address'     => [
                    '@type'           => 'PostalAddress',
                    'addressLocality' => 'Gurugram',
                    'addressCountry'  => 'IN',
                ],
                'knowsAbout'  => [
                    'HTML5',
                    'CSS3',
                    'JavaScript',
                    'Vue.js',
                    'React',
                    'Swiper.js',
                    'Bootstrap',
                    'Tailwind CSS',
                    'WordPress',
                    'PHP'
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
        </script>
    <?php endif; ?>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6Y1YZSQ8YE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-6Y1YZSQ8YE');
    </script>

    <!-- Favicon: the navbar's "TK." mark. favicon.ico also sits at the site
         root, where browsers look for it even without these tags. -->
    <link rel="icon" href="favicon.ico" sizes="48x48">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo asset('assets/images/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset('assets/images/favicon/favicon-16x16.png'); ?>">
    <link rel="apple-touch-icon" href="<?php echo asset('assets/images/favicon/apple-touch-icon.png'); ?>">
    <link rel="manifest" href="site.webmanifest">
    <meta name="theme-color" content="#020617">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;800;900&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 (Grid only) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css" rel="stylesheet">

    <?php if ($USE_SWIPER): ?>
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <?php endif; ?>
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- Devicon (Tech Logos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo asset('assets/css/style.css'); ?>">
    <?php foreach ($PAGE_CSS as $sheet): ?>
        <link rel="stylesheet" href="<?php echo asset($sheet); ?>">
    <?php endforeach; ?>
    <?php echo $HEAD_EXTRA; ?>
</head>

<body class="dark-theme">
    <!-- Animated Tech Grid Background -->
    <canvas id="techGridCanvas"></canvas>

    <div class="custom-cursor"></div>
    <div class="custom-cursor-follower"></div>

    <!-- STICKY NAVBAR -->
    <nav class="site-nav<?php echo $NAV_SOLID ? ' scrolled' : ''; ?>" id="siteNav">
        <div class="container nav-inner">
            <a href="<?php echo $isHome ? '#' : 'index.php'; ?>" class="nav-logo">TK<span class="text-accent">.</span></a>
            <ul class="nav-links" id="navLinks">
                <?php foreach ($NAV_ITEMS as $item):
                    $t = nav_target($item, $PAGE, $isHome); ?>
                    <li><a href="<?php echo e($t['href']); ?>" class="nav-link<?php echo $t['active'] ? ' active' : ''; ?>"><?php echo e($item['label']); ?></a></li>
                <?php endforeach; ?>
            </ul>
            <a href="mailto:khampariatushar@gmail.com" class="nav-cta">Let's Talk <i class="ti ti-arrow-right ms-1"></i></a>
            <button class="nav-hamburger" id="navHamburger" aria-label="Open menu" aria-expanded="false" aria-controls="mobileNavOverlay">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- MOBILE NAV OVERLAY -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay">
        <ul class="mobile-nav-links">
            <?php foreach ($NAV_ITEMS as $item):
                $t = nav_target($item, $PAGE, $isHome); ?>
                <li><a href="<?php echo e($t['href']); ?>" class="mobile-nav-link"><?php echo e($item['label']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <main<?php echo $MAIN_CLASS ? ' class="' . e($MAIN_CLASS) . '"' : ''; ?>>