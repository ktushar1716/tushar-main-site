<?php
/* ==========================================================================
   NAVBAR.PHP
   Glass navigation. $page (set in head.php) drives the active link state.
   ========================================================================== */

/* Defaults, in case this include is ever reached without head.php */
$page         = $page         ?? '';
$HER_NICKNAME = $HER_NICKNAME ?? 'You';

$navLinks = [
    'home'    => ['index.php',        'Home'],
    'story'   => ['story.php',        'Our Story'],
    'memories'=> ['memories.php',     'Memories'],
    'letters' => ['letters.php',      'Open When'],
    'game'    => ['game.php',         'The Game'],
    'wish'    => ['wish.php',         'Make a Wish'],
    'final'   => ['final-letter.php', 'For You'],
];
?>
<header class="nav" id="nav">
    <a class="nav__brand" href="index.php" aria-label="Back to the beginning">
        <span class="nav__brand-dot" aria-hidden="true"></span>
        <span class="nav__brand-text">For <?php echo e($HER_NICKNAME); ?></span>
    </a>

    <button class="nav__toggle" id="navToggle" type="button"
            aria-expanded="false" aria-controls="navMenu" aria-label="Open menu">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
    </button>

    <nav class="nav__menu" id="navMenu" aria-label="Main">
        <ul class="nav__list">
            <?php foreach ($navLinks as $key => [$href, $label]): ?>
                <li>
                    <a class="nav__link<?php echo $page === $key ? ' is-active' : ''; ?>"
                       href="<?php echo e($href); ?>"
                       <?php echo $page === $key ? 'aria-current="page"' : ''; ?>>
                        <?php echo e($label); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<main id="content">
