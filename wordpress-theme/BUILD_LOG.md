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
