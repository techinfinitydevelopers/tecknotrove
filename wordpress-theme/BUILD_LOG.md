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
