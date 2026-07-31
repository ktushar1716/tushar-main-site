<?php
/* ==========================================================================
   PLAYLIST.PHP — Page 5
   A Spotify-inspired record of the songs that belong to us.
   ========================================================================== */
$page      = 'playlist';
$pageTitle = 'Our Playlist';
require 'includes/head.php';
require 'includes/navbar.php';

/* --------------------------------------------------------------------------
   THE SONGS
   'cover' — artwork in /images (falls back to a gradient if missing)
   'why'   — the line that turns a song into a memory
   'link'  — paste the normal Spotify share link. It is converted into an
             embed automatically below. Leave it empty to show a placeholder.
   -------------------------------------------------------------------------- */
$tracks = [
    ['title' => 'Placeholder — our song',        'artist' => 'Artist Name',  'album' => 'Album',        'time' => '3:42', 'cover' => 'images/cover-01.jpg', 'why' => 'The one that plays in your head when you think about her.',        'link' => ''],
    ['title' => 'Placeholder — the first song',  'artist' => 'Artist Name',  'album' => 'Album',        'time' => '4:05', 'cover' => 'images/cover-02.jpg', 'why' => 'The first song you ever sent her, before you were brave.',        'link' => ''],
    ['title' => 'Placeholder — the call song',   'artist' => 'Artist Name',  'album' => 'Album',        'time' => '3:18', 'cover' => 'images/cover-03.jpg', 'why' => 'Played quietly in the background of a hundred late calls.',       'link' => ''],
    ['title' => 'Placeholder — the sad one',     'artist' => 'Artist Name',  'album' => 'Album',        'time' => '4:31', 'cover' => 'images/cover-04.jpg', 'why' => 'For the airport. You know the one.',                              'link' => ''],
    ['title' => 'Placeholder — the happy one',   'artist' => 'Artist Name',  'album' => 'Album',        'time' => '2:56', 'cover' => 'images/cover-05.jpg', 'why' => 'Impossible to hear without smiling like an idiot.',               'link' => ''],
    ['title' => 'Placeholder — her song',        'artist' => 'Artist Name',  'album' => 'Album',        'time' => '3:27', 'cover' => 'images/cover-06.jpg', 'why' => 'The one she overplayed until you loved it too.',                  'link' => ''],
    ['title' => 'Placeholder — the drive song',  'artist' => 'Artist Name',  'album' => 'Album',        'time' => '3:59', 'cover' => 'images/cover-07.jpg', 'why' => 'For the road trip you have not taken yet.',                       'link' => ''],
    ['title' => 'Placeholder — the last one',    'artist' => 'Artist Name',  'album' => 'Album',        'time' => '5:12', 'cover' => 'images/cover-08.jpg', 'why' => 'Saved for the day the countdown hits zero.',                      'link' => ''],
];

/**
 * Turn any Spotify share URL into its embeddable form.
 * https://open.spotify.com/track/ID?si=… → https://open.spotify.com/embed/track/ID
 */
function spotify_embed(string $link): string {
    if ($link === '') {
        return '';
    }
    if (strpos($link, '/embed/') !== false) {
        return $link;
    }
    return preg_replace('#open\.spotify\.com/(track|album|playlist|episode)/#',
                        'open.spotify.com/embed/$1/', strtok($link, '?'));
}

$totalMinutes = 31; // rough runtime, just for the header
?>

<!-- ==========================================================================
     PLAYLIST HEADER — album-page layout
     ========================================================================== -->
<section class="playlist-head">
    <div class="playlist-head__art reveal" aria-hidden="true">
        <div class="playlist-head__art-inner">
            <span class="playlist-head__note">♪</span>
        </div>
    </div>

    <!-- One of them dances. The CSS only lets the bop run while the
         background music is actually playing — see body.music-playing.
         REPLACE: dance.gif -->
    <span class="sticker-box sticker-box--md playlist-head__dancer" aria-hidden="true">
        <img class="sticker" src="images/stickers/dance.gif" alt="">
    </span>

    <div class="playlist-head__meta">
        <p class="playlist-head__kind reveal">Playlist</p>
        <h1 class="playlist-head__title reveal">Songs that are<br>secretly about you</h1>
        <p class="playlist-head__sub reveal">
            Made by me · <?php echo count($tracks); ?> songs · about <?php echo (int) $totalMinutes; ?> min
        </p>
        <p class="playlist-head__lede reveal">
            Every one of these has been ruined for me in the best possible way.
            I can’t hear them as songs anymore. I hear them as you.
        </p>
    </div>
</section>

<!-- ==========================================================================
     TRACK LIST
     ========================================================================== -->
<section class="section section--tight">
    <div class="tracks reveal" role="list" aria-label="Track list">
        <div class="tracks__head" aria-hidden="true">
            <span>#</span>
            <span>Title</span>
            <span class="tracks__head-album">Album</span>
            <span class="tracks__head-time">⏱</span>
        </div>

        <?php foreach ($tracks as $i => $t): ?>
            <div class="track reveal" role="listitem" data-delay="<?php echo $i % 3; ?>">
                <span class="track__index">
                    <span class="track__no"><?php echo str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT); ?></span>
                    <span class="track__eq" aria-hidden="true"><i></i><i></i><i></i></span>
                </span>

                <span class="track__main">
                    <span class="track__cover">
                        <img src="<?php echo e($t['cover']); ?>" alt=""
                             loading="lazy" decoding="async"
                             data-fallback="<?php echo e($t['title']); ?>">
                    </span>
                    <span class="track__text">
                        <span class="track__title"><?php echo e($t['title']); ?></span>
                        <span class="track__artist"><?php echo e($t['artist']); ?></span>
                        <span class="track__why"><?php echo e($t['why']); ?></span>
                    </span>
                </span>

                <span class="track__album"><?php echo e($t['album']); ?></span>
                <span class="track__time"><?php echo e($t['time']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ==========================================================================
     EMBEDS — paste a Spotify share link into $tracks['link'] to activate one
     ========================================================================== -->
<section class="section section--tight">
    <h2 class="section__subtitle reveal">Press play</h2>

    <div class="embeds">
        <?php foreach (array_slice($tracks, 0, 4) as $i => $t): ?>
            <?php $embed = spotify_embed($t['link']); ?>
            <div class="embed reveal glass" data-delay="<?php echo $i % 3; ?>">
                <?php if ($embed !== ''): ?>
                    <iframe class="embed__frame"
                            src="<?php echo e($embed); ?>"
                            width="100%" height="152" frameborder="0" loading="lazy"
                            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                            title="<?php echo e($t['title']); ?> on Spotify"></iframe>
                <?php else: ?>
                    <div class="embed__placeholder">
                        <span class="embed__icon" aria-hidden="true">♫</span>
                        <span class="embed__name"><?php echo e($t['title']); ?></span>
                        <span class="embed__hint">
                            Spotify embed slot — paste the song’s share link into
                            <code>$tracks</code> in <code>playlist.php</code>.
                        </span>
                        <span class="embed__wave" aria-hidden="true">
                            <i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <p class="embeds__foot reveal">
        If you ever want to know what I was listening to while building this —
        it was track one. On repeat. For hours.
    </p>
</section>

<?php
$nextPage = ['countdown.php', 'The Countdown'];
require 'includes/footer.php';
