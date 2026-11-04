# WordPress theme — Build Log

## 2026-09-23 — Full homepage now editable from wp-admin

**Scope:** client asked to be able to edit "homepage and all pages" from WordPress, not just the Sector/Product CPTs. Added a "Homepage" top-level admin menu (`inc/homepage-options.php`) covering the content a marketing editor would realistically want to change: Hero (eyebrow/headline/subhead), Why Tecknotrove (headline/body), News (3-article repeater: title/meta/image URL), Partner/Careers (tile repeater: tag/title/desc/stat/CTA), LinkedIn (followers/countries + hashtag repeater + posts repeater), Callout (headline/body). Fixed visual-only constants (icons, gradients, card positioning, folder-card colours) stay in the template, cycled by array position, so editors change words and numbers without being able to break the layout.

**Storage:** `wp_options`, not a CPT/Page — the homepage has no post of its own since `front-page.php` renders unconditionally regardless of the Reading-settings static-page choice. Reused the existing post-meta repeater UI (`inc/repeater-field.php`) via a new `inc/repeater-option.php` that swaps `get_post_meta`/`update_post_meta` for `get_option`/`update_option`, same markup, same admin JS, no duplication.

**Every getter has a hardcoded fallback** matching the original design copy (`tecknotrove_home_hero_line1()` etc. in `inc/homepage-options.php`), so an empty/unconfigured option never breaks the page — confirmed by loading the homepage before touching the new admin page at all.

**Verified live end-to-end:** changed Hero line 1 to "Excellence today." via the new wp-admin page, confirmed it appeared on the public homepage immediately, then reverted it back — no code edit, no git push, matching the client's actual ask.

## 2026-09-23 — Sector pages + Product page (PDP) complete

**Scope:** `page-sector.php` (`/defence`, `/aviation`, `/automobile`, `/oesd`) and `single-product.php` (`/products/tank-driving-simulator`) ported from the Next.js `SectorHero`/`SectorStatStrip`/etc. and PDP components. `template-parts/sector/*.php` holds the reusable sector sections (hero, stats, benefits — only rendered if the sector has any, technology, trust — only if set, callout); News and LinkedIn are reused as-is from `template-parts/home/`. The Products section on each sector page queries the `product` CPT by `tt_sector_id` rather than a manually maintained list, so a new product posted in wp-admin appears automatically on its sector's page.

**Bug found and fixed — pre-existing WordPress core rewrite bug:** any `add_rewrite_rule()` call before `flush_rewrite_rules()` corrupted every subsequent pattern in the cached `rewrite_rules` option with a stray `C:/Program` prefix (breaking `/products/...` and everything after in the rules table, e.g. `Location: .../C:/Programproducts/tank-driving-simulator/`). Spent real effort isolating this: reproduced with a trivial no-alternation regex, reproduced with `env -i` (rules out shell/MSYS env pollution), reproduced with **zero theme code and the default Twenty Twenty-Five theme active** — confirmed not caused by anything in this project. Tried working around it by giving the `sector` CPT a flat empty rewrite slug instead (WordPress's documented way to get `/defence` instead of `/sector/defence`) — but WP core silently replaces an empty `rewrite.slug` with the post type name, so that path didn't work either. Settled on the practical fix: kept the working `add_rewrite_rule` + query-var + `template_include` approach (`inc/rewrite-fix.php`), and added a `rewrite_rules_array` filter that strips the `C:/Program` corruption from the array right before WordPress caches it. Verified clean with `curl -D -` showing `200 OK` on both routes after the fix.

**Verified:** all PHP linted clean, both templates screenshotted end-to-end (hero → quick specs → features → applications → convertible kits → TMS callout → specs → gallery → FAQ → related → callout → footer for the PDP; hero → stats → products → applications → technology → news → linkedin → callout for the sector page), zero console errors on either.

## 2026-09-23 — Homepage port complete

**Scope:** Full homepage ported from the Next.js site to the custom `tecknotrove` WP theme, section-for-section: Hero (radar rings, headline reveal) → Sector Grid (mouse-driven fan interaction) → Stat Strip (count-up) → Why Tecknotrove (scroll parallax) → News (folder-card hover) → Partner/Careers → LinkedIn → Callout → Footer.

**Icons:** rather than hand-copy 31 individual Phosphor SVGs, wrote a one-off Node script that parses the raw `d`/`opacity` path data straight out of `node_modules/@phosphor-icons/react/dist/defs/*.es.js` (the same package the Next.js site uses) and generates `inc/icons.php` (`tecknotrove_icon($name)`), so every icon shape is byte-identical to the original, not an approximation.

**Animation ports (vanilla JS, no React):**
- Sector card "fan" (mouse-position-driven card scatter/activate) — same activate/scatter math as the original GSAP version, using CSS transitions with an overshoot easing curve instead of pulling in GSAP.
- Count-up stats, scroll-reveal (`[data-reveal]`), parallax image scrub, FAQ accordion, magnetic button hover, mobile nav clip-path reveal — all reimplemented in `assets/js/main.js`.
- Considered loading GSAP from CDN for 1:1 physics parity; went vanilla instead to keep the theme dependency-free, and the visual result (confirmed by hovering a card in-browser) matches closely.

**Content model:** `Sector` and `Product` CPTs (scaffolded in the previous session) now hold real content — seeded all 4 sectors + the Tank Driving Simulator product via a one-off `wp eval-file` script mirroring the old `sectors.ts`/`products.ts` data, so the homepage, and later the sector/product templates, have real data to render end-to-end.

**Verified:** all new PHP linted clean (`php -l`), Tailwind CSS rebuilt, homepage loads with zero console errors, hero/sector-grid/news/stat-strip/footer all screenshotted and visually match the Next.js version, fan hover interaction confirmed working live.

**Known follow-ups:**
- Sector/Product single templates (`page-sector.php`, `single-product.php`) not yet built — CPT data exists and is ready to consume, this session ran out of scope before reaching them.
- Homepage sector-grid card body text currently reuses the sector's `h1` (long marketing headline) rather than the Next.js version's separate short card blurb — sectors.ts had two distinct strings per sector (a homepage card title + a full page H1); the WP content model only captured one. Minor content nuance, not a bug — flagging for a possible `tt_card_title` field later if the client wants it back.
- Mobile viewport wasn't pixel-checked in this session (relied on the responsive classes being copied unchanged from the already-mobile-verified Next.js site) — worth a real phone-width pass before launch.

## Local setup on second machine (2026-10-06)
- Installed XAMPP 8.2 via winget, WP + wp-cli, DB `tecknotrove`, junction theme -> `wordpress-theme/`, `.htaccess`, permalinks `/%postname%/`.
- Added `tools/seed.php` + `tools/seed-data.json` (sectors/product from old TS data). Run: `TT_IMAGES=<public/images> php wp-cli.phar eval-file wordpress-theme/tools/seed.php`.
- Local admin: http://localhost/tecknotrove/wp-admin (admin / admin123, local only).
- Start: XAMPP Control Panel -> Apache + MySQL.

## "Every subsystem. One source." revamp (2026-10-08)
- `template-parts/home/why.php` rebuilt as a 52/48 split: left = grid-paper column with Syne headline, body, CTA and the stat block (merged in); right = framed, crisp photo. Source: Stitch export `stitch_engineering_simulator_hero_redesign.zip`.
- `stat-strip` partial removed from `front-page.php` (file kept). Added Syne font, `.tt-why-*` styles. Dropped the mock's invented labels (REV/ARCH, FIG 04, "motion coupling active").
- Navbar restyled earlier (centre black tab); asset versions now use filemtime.
- `PRODUCT.md` created (impeccable init).

## GSAP text animation (2026-10-08)
- Bundled gsap 3.15 + ScrollTrigger + SplitText (free) in `assets/js/vendor/`, enqueued in `inc/theme-setup.php`; logic in `assets/js/text-anim.js`.
- Hooks: `data-split-title` (chars rise through line mask), `data-split-lines`, `data-anim-up`. Applied to hero and "Every subsystem" sections. Skipped under prefers-reduced-motion.
- Also: sector cards use brand-book colours + borders; news cards hover fixed; navbar redrawn as one SVG shape with scroll compaction.

## Elementor editing (2026-10-08)
- Client wants every page editable in Elementor. Kept the custom theme; added 22 Elementor widgets (`inc/elementor/`) wrapping the existing section partials, data-driven from `definitions.php`.
- Header/footer: `tt_layout` CPT + `tecknotrove_the_layout()`, Elementor-editable with PHP fallback. `page.php`, Elementor-aware `front-page.php`/`single-product.php`.
- Pages created by `tools/seed-elementor.php`: Home, Defence, Aviation, Automobile, OESD, About, Careers, News, Contact; sector URLs now resolve to those pages (CPT route is fallback). Contact form handler in `inc/contact-form.php`.
- Fixed Elementor-vs-Tailwind cascade (Elementor CSS loaded into `@layer elementor`). Verified in the Elementor editor: widgets listed, controls render, live preview updates.
- Guide: `ELEMENTOR.md`.

## Framer carousel variant (2026-10-09)
- New Elementor widget `tt_framer_carousel` mounting Framer's Modern Carousel via import map (react/framer-motion from esm.sh, local `framer` stub). Page `/home-carousel/` = Home with the sector fan swapped for it; `/` keeps the fan. Sector card labels moved beside the icon.

## Wireframe review (2026-10-09)
Read `tecknotrove_wireframe.xlsx` (7 sheets: legend, homepage, PDP, 4 sectors). Gap plan:
1. Sector nav (sector logo | Home, Products, Technology, TMS, Tecknotrove.com) on sector pages.
2. Products: 24 products across sectors (Defence 8, Aviation 6, Driving 5, OESD 5); only Tank Driving Simulator exists. Product cards need images.
3. PDP: sticky in-page sub-nav, breadcrumb, TMS callout, spec lead-gen panel, gallery of 5, related products.
4. Homepage: nav dropdowns, news tags, LinkedIn right panel, footer Software column + socials + Privacy/Terms bar.
5. Sector pages: per-sector news/social, applications/technology images, hero 100vh, "Explore other industries" band.
6. Content gaps: Aviation/Driving/OESD subheads, stats and trust copy are placeholders in the wireframe; follower count 12,400+ (wireframe) vs 9,232 (live).
7. Pages not in wireframe: TMS/Software, Privacy Policy, Terms (linked from nav/footer).

## Two variations + static export for Vercel (2026-10-12)
- `tools/static-export.py` crawls the local WP site into `static-export/fan` (homepage = sector fan) and `static-export/carousel` (homepage = Framer carousel). Vercel cannot run PHP/WordPress, so these static copies are what Vercel serves. Contact form is disabled in the static copies.
- Deploy: two Vercel projects, root directory `static-export/fan` and `static-export/carousel`, framework preset "Other", no build command.
- Vercel projects (account developers-8273): `tecknotrove-fan` (root `static-export/fan`) and `tecknotrove-carousel` (root `static-export/carousel`), deployed with `vercel deploy --prod` after `vercel link`. Re-export with `python tools/static-export.py` (keeps `.vercel`), then run `vercel deploy --prod --yes` in each folder. On Windows PowerShell use `vercel.cmd` (vercel.ps1 is blocked by execution policy).

## Hero per brand book (2026-10-13)
- Hero headline is now the Brand Essence unit (Brand Book p.9-11: stacked "Precise / today / Perfect / tomorrow", one colour, never broken or recoloured; white reverse on blue). Extracted from the PDF as `assets/images/brand-essence-white.png`; real text kept in an sr-only span for SEO. Subhead trimmed to the wireframe text only. Facility card in the orange CTA now white with dark text.

## CSS restore + logo hover icons (2026-10-14)
- My earlier navbar CSS edit accidentally deleted a block of base rules from `src/input.css` (mobile menu open state, `[data-reveal]` scroll reveal, FAQ accordion, `.mono-label`, `.grain`, spin/marquee/pulse keyframes, reduced-motion). Restored from commit 7213655. Mobile menu (hamburger) works again.
- Logos (navbar, footer, hero essence) are now background images on a span (role=img) instead of `<img>`, so browser image-hover buttons (Lens / more actions) don't appear on them.

## Mega menu from the supplied reference (2026-10-14)
- Full-screen menu uses the supplied reference CONTENT only (look and feel stays ours: black panel, Lato black headings, sector-colour dots); Products / Software & Tools / Company / Get in Touch; light Lato headings, hairline-divided link lists, Mumbai contact card. Data: `tecknotrove_navbar_defaults()['menu_columns']`; editable in the Elementor Navbar widget (links one per line as `Label | URL`). Many sub-links point to `#` until their pages exist. Phone shown is the reference's +91 22 6151 3000 (brand book/site use 6151 3002): confirm.

## 2026-10-21: Aviation hubs, hub pages, product pages
- Added `hub` CPT, 9 `tt_av_*` Elementor widgets (sub-menu, hero, hub sections, tiles, FAQ, key-features tabs, video, gallery, CTA), `single-hub.php`, 3 icons.
- Seeded: industry page, 4 hubs, 8 products, Digital Twins, ISTC. Cargo Loader uses real brochure copy/images; others are draft copy.
- Static export now includes the new URLs. Open: client copy/FAQs/videos, motion/spec details, final hub-to-tech page copy.

## 2026-10-27: Client copy applied (Aviation industry page, GSE hub, Cargo Loader product)
- `tools/seed-aviation-copy.php` (requires seed-aviation.php) writes the exact client copy for the 3 pages, plus title tag and meta description (new `inc/seo.php`, meta box on pages/hubs/products/sectors).
- New/changed widgets: tiles gain link label + badge ("Coming soon", non-clickable when no URL), `tt_av_notes` (equipment types / scenarios strip), `tt_av_related_content` (blogs/news/social), multi-paragraph hero intro, video anchor `#video`, 7 key-feature tabs.
- Client markers ([confirm offered], [Placeholder ...]) kept visible on purpose. Gallery still uses brochure crops (13 client images not supplied).
- Verified: rendered text of each page matches the docs (script in scratch), titles/descriptions output. Other hubs/products unchanged draft.

## 2026-10-29 Aviation sector navbar + aesthetic pass
- Aviation pages now use their own navbar (`navbar-aviation.php`) in place of the main one; sticky sub-menu strip removed from page data (seeds re-run).
- UI pass on aviation templates: shared section header (`head.php`), numbered hover-lift cards, FAQ cards, rounded gallery/CTA panel, hero gradient. Fixed sub-menu sticking inside its Elementor wrapper (moot now).
- Verified: aviation/hub/product pages show `#tt-av-nav`, other pages keep `#tt-nav`. Restarted Apache/MySQL (MySQL had stopped).

## 2026-10-29 Aviation scroll animations + lighter sections
- Hero image parallax + copy fade, accent scroll-progress line in the Aviation navbar, staggered reveals (`[data-stagger]` sets `--i`), scrolling ticker widget `tt_av_marquee` (industry + GSE hub), numbered "list" layout for tiles (`layout` = list) used by Why Choose, Advantage and Why Invest; card icons tilt on hover.
- Client copy is never truncated (line-clamp removed on purpose).

## 2026-11-02 Aviation UI pass 3
- Hub cards are photo-led (new `image` field on hub repeater; seeded with brochure crops as placeholders), clip-path image reveal on scroll.
- Sections stack as rounded "sheets" (`.tt-av-sheet`), hero text staggers in on load, headings use the existing `data-split-lines` mask animation.
- Tiles widget: layout `list` now has sticky left heading + scroll-focus rows (`data-av-focus`, `--f`); new layout `scroll` = pinned horizontal strip (GSAP ScrollTrigger, desktop only; plain swipe strip on mobile). Used for Simulation Technologies and Cargo modules.
- Hub photos are placeholders until client supplies real ones.

- 2026-11-03: Aviation hero restructured (headline + CTAs left, intro in glass card right, 100svh, lighter overlay, parallax scale 110%) so CTAs stay above the fold.

## 2026-11-03 Reference components
- Hero: lead sentence only, rest of client copy behind "Read more" (details).
- Tiles widget: new `image` field + layouts `featured` (big card + image cards) and `showcase` (numbered list, image swaps on hover/click). Used for Simulation Technologies, Cargo modules, GSE range, Related Simulators. Images are brochure-crop placeholders (map in seed-aviation-copy.php `$tile_img`).

- 2026-11-03: Aviation navbar rebuilt as centred-logo layout (Home + 3 hubs left | logo + AVIATION | last hub + Tecknotrove.com + Enquire right), per client reference image.

- 2026-11-03: Aviation hubs section = featured card (hub 01, image left, product list right) + 3 image cards with product chips (one-liners in title tooltips; full list on hub pages).

- 2026-11-03: Simulation Technologies set back to the horizontal scroll strip layout.

- 2026-11-03: Horizontal strip cards travel on an arc (per-frame perspective/rotateY/translateY/scale from card position, desktop only; wrapper `[data-av-arc]` so reveal transforms do not clash). Heading left-aligned (w-full on container).

- 2026-11-04: Simulation Technologies strip rewritten as a path animation (replaces the arc tilt): one row, pinned; cards rise from below the title (first 14% of scroll), then travel left to right along a curve (y = f(screen x), tilt = path tangent x0.7), first card leads on the right. Desktop only; mobile = swipe strip. Per-frame transforms in main.js `render()`.

- 2026-11-04: Why Choose / Advantage / Why Invest (tiles layout `list`) rebuilt as Framer "Progress Steps" cards: rounded-20 card, step number, 5px vertical bar whose fill slides down (translateY -100%->0) as the card rises through the viewport (eased rAF loop in main.js), title weight 500 / -0.02em. Local only, not deployed/committed.

- 2026-11-04: New sections + micro-interactions (local only). `tt_av_map` = interactive airside apron SVG (top-down aircraft, 6 hotspot vehicles, list<->map hover sync, autoplay when visible, dash/pulse/drift animation); `tt_av_index` = huge editorial rows with cursor-following preview image (used for Other Aviation Hubs on GSE hub). Global: cursor spotlight on cards/steps, magnetic hero CTA + nav Enquire, click ripple, scroll-velocity ticker (reverses with scroll direction).

## Hub showcase accordion (Aviation industry page)
- `tt_av_hub_sections` now renders a showcase accordion (template-parts/aviation/hub-sections.php): one hub open (full-bleed image + glass info card with label, title, intro, product pills, link), others slim strips (outlined number + vertical title). Row on >=1024px (flex-grow 1 vs 6), stacked column below.
- JS (main.js "showcase accordion"): click opens, arrow keys move, 6s autoplay with progress bar, runs only in view, pauses on hover/focus, stops after a click, off under reduced motion.
- CSS: `.tt-av-acc*` in src/input.css. Same Elementor fields (title, intro, products, url, link label, image); no reseed needed.
- Verified locally via JS geometry (144px strips / 867px open at 1440w; settled opacity states). Autoplay timing and mobile not visually verified (preview pane throttles transitions).
- Fix: hub section had no heading (only a tiny label) and large padding. Added label/heading/intro fields to `tt_av_hub_sections`, seeded draft heading "Four hubs. One connected training ecosystem." + intro, section padding py-32 -> pt-20/pb-24, eyebrow label 11px -> 13px semibold (all aviation section heads), removed `data-reveal` from the accordion so it can't stay hidden.

## FAQ flow (Aviation pages)
- `template-parts/aviation/faq.php` rebuilt: vertical rail with a node per question, accent line flows down to the open node, open question scales up, icon rotates into an accent circle, answer slides open with a delayed fade; counter "04 / 09" in the sticky left column. One open at a time, click open item to close; aria-expanded/controls.
- Own classes `.tt-av-faq*` (src/input.css) and JS block "FAQ flow" in main.js, so the old global `.tt-faq-*` script (product pages) is untouched.
- Verified line-to-node alignment via JS (items 1, 4, 6, 9). Transitions not visually verified (preview pane freezes them).
- Framer FAQ Flow page gave no layout detail, so this is my interpretation, not a copy.

## Simulation Technologies: riff carousel
- New `tt_av_tiles` layout `riff` ("Layered card carousel (riff)" in the widget); Simulation Technologies on the Aviation page switched from `scroll` (wavy strip) to `riff` in seed-aviation-copy.php. Wavy strip layout still selectable.
- Centre card in focus; neighbours overlap, rotate (5.5deg/step), scale down, drop and fade. Cards cycle 4 palettes (dark / accent blue / white / pale blue); first clause of each description is highlighted. Outlined number, icon chip, dot pager, "01 / 07" counter + round prev/next arrows.
- JS "riff carousel" in main.js: continuous position with lerp, infinite loop, arrows, drag/swipe (pointer events), horizontal wheel only (vertical keeps page scroll), arrow keys, click side card to focus, 5s autoplay only in view, paused on hover/focus/drag, off under reduced motion.
- Added `ArrowLeft`/`ArrowRight` to inc/icons.php.
- Verified via JS (rAF shimmed because the hidden preview pane blocks rAF): next 01->02, prev x2 loops to 07, 300px drag -> next, horizontal wheel -> next; screenshot at 1440w looks right.
- Riff fix (user: cards over navbar, carousel moving while page scrolls): stage now `isolation:isolate; z-index:0; overflow:hidden` so cards never paint over the fixed navbar or outside the section; removed wheel navigation and autoplay (moves only on arrows/drag/swipe/keys/click); softer fan (2.5deg/step, origin bottom, +24px base offset), stage height = tallest card + 110px. Verified all visible cards sit inside the stage (24px+ gaps).
- Hubs section fits one screen (>=1024px): section min-h-svh, centred; compact header (label + 2.6rem heading left, intro right-aligned on the same row); accordion height clamp(400px, 100svh - 290px, 640px); card intro clamped to 3 lines. Verified: section = viewport height at 1440x900 (accordion 610px) and 1366x768 (478px), open card fits with 16px bottom gap.

## Aviation navbar v2 (minimal + full-screen menu) and immersive sections
- navbar-aviation.php rewritten: logo + AVIATION tag left; Enquire Now + "Menu" pill (text flips to Close, two lines morph into X) right. Transparent gradient over hero, solid blurred dark after 40px, hides on scroll down past 320px, returns on scroll up. Scroll progress line kept.
- Full-screen overlay `#tt-av-menu`: circular clip-path reveal from the Menu button; 4 hubs as huge numbered rows sliding up in sequence (others dim on hover, arrow rotates, current hub in accent); right column shows hovered/focused hub's products (staggered) + Explore link; footer: Aviation home, Tecknotrove.com, Enquire Now. Esc closes, focus moves into menu and back, page scroll locked. Replaces old dropdowns + mobile panel (mobile shows hub list only).
- Immersive sections (main.js): every `.tt-av-sheet` rises 90px and scales 0.94 -> 1 as it enters (eased, scroll-linked); the section being covered fades to 45% and scales to 0.95 as it leaves (`--exit`). Skips pinned `[data-av-hscroll]`, off under reduced motion. Reveal observer now fires slightly earlier (rootMargin -6%).
- Verified (JS, rAF shimmed): menu open/close, aria-expanded, scroll lock, hub hover switches panel; nav solid/hidden/shown on scroll direction; entering sheet transform 71px/scale .96 -> none, exiting sheet --exit .5 / child opacity .725. GSE hub, Airside hub, Cargo Loader pages 200 with new menu, no PHP warnings.

## Why Choose Tecknotrove: story panel (Framer "Tab Sync Story Panel")
- New `tt_av_tiles` layout `story` ("Story panel (image + titles)"); Why Choose on the Aviation page switched from `list` to `story`.
- Left: large rounded image (sticky on desktop, height clamp(440px, 100svh-160px, 680px)); active image wipes in from the right with a slow zoom-out; bottom caption rolls up with the active title + "03 / 06" counter; label chip top-left. Right: heading + numbered titles; active one opens its text, arrow rotates to accent; others dimmed.
- Autoplay 6.5s with an accent progress line under the active title; only while on screen (rect check), pauses on hover/focus, stops after a click.
- Placeholder images for the 6 Why Choose titles added to `$tile_img` in seed-aviation-copy.php.
- Verified: click 3 -> image 3/caption/counter synced; autoplay progress 0.53 at 3.5s, advanced 01->02; after clicking 05 it stays on 05.

## Cutout hero (all Aviation heroes)
- template-parts/aviation/hero.php rebuilt: image sits in a rounded frame inset 10-12px from the page; page-coloured notches cut out of the bottom-left (CTA buttons, dark solid + outline) and bottom-right (lead sentence + Read more, desktop only), each with concave joins (`.tt-av-cut-l/-r` pseudo-elements with radial-gradient masks, radius 1.75rem). Headline larger (4.2rem), lead shown inside the image on mobile.
- Hero section has 3.5rem bottom padding so the next overlapping sheet doesn't cover the notches. Aviation navbar no longer draws its gradient over the hero (transparent until solid on scroll).
- Applies to industry, hub and product pages (same widget). Verified screenshot at 1440x900; mobile not checked.
- Blue, gradient-free backgrounds: airside map section #0b3254 (map panel #0f3d66, glow/grid overlays and SVG vignette removed); Why Choose story section #062440 (light variant #e3f1fb), glow/grid removed, image overlay gradient replaced by a solid #062440 caption plate, chip solid, dividers #1d4f7a, body text #b9d5ea. Verified no computed background-image gradients in either section.
- Light blue palette (user: ice blue, baby blue, powder blue): airside map section ice blue #e6f4fa with powder-blue map panel #b6dce6, dark text, darker stand/road/grid lines, white aircraft, navy vehicle labels; Why Choose story section baby blue #c3e2f5 (seed dark -> light), image frame powder blue, caption plate + chip ice blue with ink text, dividers #9cc8e2.

## Hero: more eye-catching
- Headline split at "for": "Aviation Training Simulators" at 6.2rem, rising line by line from a mask; "for Airports, Airlines and Ground Handlers" as ice-blue subhead (#bfe3f7).
- Photo: slow Ken Burns zoom (1.14 -> 1 over 14s), lighter navy-tinted overlay so the photo shows more.
- Rotating ice-blue badge (TRAIN · TEST · CERTIFY · AIRSIDE · SIMULATORS, accent plane core, links to #contact), desktop only.
- Right notch: cycling "Sim view" thumbnail (3 simulator screenshots crossfading, blinking live dot) beside the lead sentence.
- Frame bottom corners squared under the notches to remove the hairline seam. All motion off under reduced motion.
- Hero tweak (user: "not nice"): removed the rotating badge; headline bold not black, 6.2rem -> 4.4rem, tighter tracking; subline 2.2rem semibold -> 1.75rem medium.

## Highlighter headings + simulator bento
- `tecknotrove_av_heading()` (inc/aviation.php): highlights `*marked*` text, else the second sentence, else the last 1-2 words, in a `.tt-hl` baby-blue (#8fd3f7) marker bar that wipes in when the heading reaches 85% of the viewport (`[data-hl]`, JS in main.js). All aviation section h2s (head.php, hub sections) now 900 weight, tracking -0.045em, sized up; old line-split animation removed from them.
- Hero h1: "Aviation Training Simulators" white, "for Airports, Airlines and Ground Handlers" on the marker bar in navy, same size (4rem), 900 weight (user reference: "Create your ads. / With AI and a method.").
- Airside map replaced by a photo bento (template-parts/aviation/map.php, widget renamed "TT Aviation Simulator Bento (photos)"): 12-col grid, 250px rows (big 6x2, two 3s, 6, 5, 7); each card is a link with a full-bleed photo (4th field, else product featured image, else keyword placeholder), number chip, ice-blue plate with title + navy arrow; hover zooms photo, opens one-liner, arrow rotates to accent. Section ice blue. Heading "Every vehicle on the stand, *simulated.*", intro rewritten (no more "hover a vehicle").
- Verified: bento geometry at 1440w matches the planned grid, 6 images load; highlighted spans render in all 5 section headings; hero screenshot matches the reference style.
- Highlighter fix (user reference): bar now covers only the lower ~60% of each line (background-position 0.46em, size 0.62em, #7cc8f2), caps stick out above it, bar starts 0.14em left of the text; a highlighted second sentence starts on its own line. Hero: accent-blue bar with white text (navy text is unreadable over the photo).
- Highlighter made static (no wipe animation), per user.
- Highlighter bar moved lower (top 0.46em -> 0.58em, height 0.6em).
- Why Choose story fits one screen (>=1024px): section min-h-svh centred (pt-24/pb-10), image height clamp(420px, 100svh-140px, 660px), heading clamp(2.2rem, 3.4vw, 3.2rem), tighter rows (py clamp 0.6-1.1rem), smaller titles/desc. Verified section = viewport at 1440x900 and 1024x768.
- Padding above the bottom CTA reduced: CTA pt 24px (was 96px), FAQ pb 48px (was 112px); gap FAQ -> CTA card ~136px -> ~72px.
- Why Choose: titles column now matches the image height (grid stretch, heading top = image top, list bottom = image bottom; closed rows share spare space, open row auto). Image no longer sticky. Verified equal heights at 1440x900 (660px) and 1366x768 (628px) with first/middle/last item open.
- Why Choose caption plate: only the active caption takes space (others absolute), fixed 4.5/5.5rem height removed, caption 1.9rem, plate padding tightened. Plate 65px at 1440w (was ~110px).
