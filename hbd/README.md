# Her birthday site — how to make it yours

Drop the folder on any PHP server and open `index.php`. It works as-is; everything
below is about replacing the placeholders.

## 1. The five lines that matter most

All in `includes/head.php`, right at the top:

```php
$HER_NICKNAME  = 'Sunshine';                 // what you call her
$YOUR_NAME     = 'Yours, always';            // how you sign off
$COUNTDOWN_TO  = '2026-12-24T18:00:00';      // the day you see her
$COUNTDOWN_WHY = 'Until I get to hold you again';
```

Change those and the whole site updates — hero, nav, letters, countdown, sign-off.

## 2. Where each bit of writing lives

| What                        | File                | Look for            |
|-----------------------------|---------------------|---------------------|
| The 16 reasons              | `index.php`         | `$reasons`          |
| The timeline                | `story.php`         | `$timeline`         |
| Photo captions & dates      | `memories.php`      | `$memories`         |
| The "open when" letters     | `letters.php`       | `$letters`          |
| Songs                       | `playlist.php`      | `$tracks`           |
| The long final letter       | `final-letter.php`  | the `<p>` tags      |
| Puzzle completion message   | `memories.php`      | `.puzzle__done`     |
| The 16 hidden-heart lines   | `script.js`         | `HEART_LINES`       |
| The secret page             | `secret.php`        | the `<p>` tags      |

Every placeholder starts with the word *Placeholder* — search for it to find
everything still left to write.

## 3. Media

- **Photos** → `images/`, named `memory-01.jpg` … `memory-12.jpg`.
  Any photo you haven't added yet shows a soft gradient card with its caption
  on it, so the layout never looks broken while you're collecting them.
- **Album art** → `images/`, named `cover-01.jpg` … `cover-08.jpg`.
- **Music** → `audio/background.mp3`. Until that file exists the toggle simply
  does nothing. The track resumes from where it was as she moves between pages.
- **Spotify** → paste a normal share link into `'link' => ''` in `$tracks`;
  it's converted into an embed automatically. Empty ones show a placeholder slot.

## 4. The two games

**The puzzle** (bottom of *Memories*). Put your favourite photo of the two of
you at `images/puzzle.jpg` — square-ish crops work best. She drags pieces onto
each other to swap them, or taps two pieces; keyboard works the same way.
When the last piece lands the seams close, the photo flashes and settles, then
your message appears with confetti. Change `data-size="3"` to `4` in
`memories.php` for a harder 4×4. Until you add the photo it falls back to
numbered gradient pieces, so it's playable right now.

**Find the hidden hearts.** Sixteen tiny glowing hearts are tucked into the
corners of things across all seven pages — four on the home page, three on the
story, two each on memories, letters and playlist, one on the countdown, two on
the final letter. Each one she clicks reveals *"One more reason I love you…"*
followed by a line from `HEART_LINES` in `script.js`. Progress is saved in the
browser, so she can find them over several days, and a small counter appears in
the bottom-left corner after the first one. All sixteen unlocks `secret.php` —
a page that doesn't appear in the navigation and can't be reached any other way.

To move a heart somewhere else, edit `HEART_SPOTS` in `script.js`: each entry is
`[id, css selector, corner]` where corner is `tl` `tr` `bl` `br` `cl` `cr`.
Avoid attaching one to an element that is itself a button.

To reset the hunt while testing, run `localStorage.removeItem('heartsFound')`
in the browser console.

## 5. Bubu & Dudu

See `images/stickers/README.txt` for the full list of filenames the site expects.
Anything you haven't added yet shows as a small dashed box labelled with the
filename it's waiting for, so you can see at a glance what's left.

They only appear where they mean something: waiting and hugging on the loading
screen, waving in the hero, beside five specific moments on the timeline, sitting
on each envelope, dancing on the playlist *only while the music is actually
playing*, standing either side of the countdown looking across at each other,
and walking together for the hug at the very end of the final letter.

Every one is a plain `<img class="sticker">` inside a `<span class="sticker-box">`.
The box handles size, entrance and floating; the image handles the hover. Swap
any GIF by changing its `src` — the sizing is all CSS.

## 6. The hidden things

Four easter eggs, and a fifth if she finds all four:

1. Click the moon (bottom-left of every page).
2. Double-click the hero title on the home page (Enter works too, for keyboards).
3. Type the word `love` anywhere.
4. Click a star in the background — you have to actually hit one.

Their messages are in `script.js`, under **17. EASTER EGGS**.

## 7. Notes

- The intro plays once per browser session. Escape or "Skip intro" skips it.
- Everything respects `prefers-reduced-motion` — animations switch off entirely.
- Pages are keyboard-navigable: skip link, focus rings, Escape closes modals,
  arrow keys move through the gallery.
