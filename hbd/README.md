# Her birthday site — how to make it yours

Drop the folder on any PHP server and open `index.php`. It works as-is; everything
below is about replacing the placeholders.

## 1. The four lines that matter most

All in `includes/head.php`, right at the top:

```php
$HER_NICKNAME  = 'Abbbyyy shuuuuuu';         // what you call her
$YOUR_NAME     = 'Abbbyyy carrrr, always';   // how you sign off
$HER_AGE       = 16;                         // how many candles go on the cake
$DISTANCE_KM   = 2140;                       // how far apart you actually are
```

Change those and the whole site updates — hero, nav, letters, cake, game,
sign-off.

## 2. Where each bit of writing lives

| What                        | File                | Look for            |
|-----------------------------|---------------------|---------------------|
| The 16 reasons              | `index.php`         | `$reasons`          |
| The timeline                | `story.php`         | `$timeline`         |
| Photo captions & dates      | `memories.php`      | `$memories`         |
| The "open when" letters     | `letters.php`       | `$letters`          |
| The four milestone lines    | `game.php`          | `$milestones`       |
| What's in the way           | `game.php`          | `$obstacles`        |
| Game completion message     | `game.php`          | `.game__win-text`   |
| The birthday wish           | `wish.php`          | `.wish__done-body`  |
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
- **Music** → `audio/background.mp3`. Until that file exists the toggle simply
  does nothing. The track resumes from where it was as she moves between pages.

## 4. The three games

**The puzzle** (bottom of *Memories*). Put your favourite photo of the two of
you at `images/puzzle.jpg` — square-ish crops work best. She drags pieces onto
each other to swap them, or taps two pieces; keyboard works the same way.
When the last piece lands the seams close, the photo flashes and settles, then
your message appears with confetti. Change `data-size="3"` to `4` in
`memories.php` for a harder 4×4. Until you add the photo it falls back to
numbered gradient pieces, so it's playable right now.

**Bring me home** (*The Game*). Bubu runs the entire `$DISTANCE_KM` between you
and she taps, clicks or presses space to jump him over everything that has ever
got in the way — the labels on the obstacles are yours to write, in
`$obstacles`. Three tries. At four points along the way the world drops into
slow motion and one of your `$milestones` lines floats up over it, then it
speeds back up. Reach zero and the two of them walk toward each other, hug, and
your message appears. Her best run is remembered.

Two things worth knowing. The obstacle heights and the height of the jump are
both worked out from how tall the strip actually is, so it plays identically on
a phone and a laptop — don't put fixed pixel heights back into `.obs`. And the
whole thing is ordinary HTML moved with transforms rather than a canvas,
specifically so the GIFs keep animating while they move. That's also why the
runners are skipped in `initStickers`: they'd otherwise get the shared floating
animation on top of the game's own.

The difficulty lives in five numbers at the top of section 16 of `script.js` —
`SPEED_MIN`, `SPEED_MAX`, `LIVES`, `AIRTIME` and `APEX`. Raise `APEX` to make
jumping more forgiving; lower `SPEED_MAX` to make the back half less frantic.

**Find the hidden hearts.** Sixteen tiny glowing hearts are tucked into the
corners of things across all seven pages — four on the home page, three on the
story, two each on memories, letters and the game, one on the wish, two on
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
on each envelope, running and then hugging in the game, holding the cake on the
wish page — and dancing on it, but only once she's blown every candle out — and
walking together for the hug at the very end of the final letter.

Every one is a plain `<img class="sticker">` inside a `<span class="sticker-box">`.
The box handles size, entrance and floating; the image handles the hover. Swap
any GIF by changing its `src` — the sizing is all CSS.

The four that are choreographed by hand — the two runners and the hug in the
game, and the dancer on the cake — are listed in `OWN_CHOREOGRAPHY` in
`script.js` so the shared entrance doesn't fight them. If you add a sticker to
either of those scenes and it drifts around oddly, that's the list to add it to.

## 6. The hidden things

Four easter eggs, and a fifth if she finds all four:

1. Click the moon (bottom-left of every page).
2. Double-click the hero title on the home page (Enter works too, for keyboards).
3. Type the word `love` anywhere.
4. Click a star in the background — you have to actually hit one.

Their messages are in `script.js`, under **18. EASTER EGGS**.

## 7. The cake

`$HER_AGE` candles, and she has to put every one of them out. Tapping works,
dragging across them works, and there's an opt-in button that asks for the
microphone so she can actually blow at her phone. Nothing is requested until
she presses that button, and the stream is torn down the moment the last flame
goes out or she leaves the page.

The whole scene reads one number, `--lit`, which runs from 1 down to 0 as the
candles go — the glow, the cake and the page background all dim off it. When
the last one dies the room goes black for a beat, then everything comes back
with confetti and your message. "Light them again" resets it.

If the mic never triggers for her, the two thresholds are in section 17 of
`script.js`: `rms > 0.09` is how loud, `ratio > 0.34` is how much of that is
low rumble rather than voice. Lower either one to make it more sensitive.

## 8. Notes

- The intro plays once per browser session. Escape or "Skip intro" skips it.
- Everything respects `prefers-reduced-motion` — animations switch off entirely.
  The game doesn't run at all in that mode; it shows the milestone lines and the
  ending as plain text instead, so she never misses the writing.
- Pages are keyboard-navigable: skip link, focus rings, Escape closes modals,
  arrow keys move through the gallery, space jumps in the game.
- To reset the game's best score: `localStorage.removeItem('gameBest')`.
