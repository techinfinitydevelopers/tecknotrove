# Tecknotrove: project memory (knowledge base)

## What this is
Corporate marketing site for Tecknotrove (simulation and training, Mumbai, est. 2002). Built as a custom WordPress PHP theme (`wordpress-theme/`) with Tailwind v4, GSAP, and custom Elementor widgets. Original Next.js build in `src/` (legacy). Repo: techinfinitydevelopers/tecknotrove (main).

## Run locally
- XAMPP at `C:\xampp`, site `http://localhost/tecknotrove/`, admin `admin` / `admin123` (local only).
- Start Apache + MySQL from XAMPP Control Panel (they stop on restart).
- Theme folder is junction-linked from `wordpress-theme/` into `wp-content/themes/tecknotrove`.
- Rebuild CSS: `npm run build:css` in `wordpress-theme/`.
- Seed content: `tools/seed.php` (sectors/product), `tools/seed-elementor.php` (Elementor pages, header/footer).
- Push: plain `git push` fails (cached `millisheth1104` creds); use `git -c credential.helper= -c "credential.helper=!gh auth git-credential" push origin main` with `gh auth switch --user techinfinitydevelopers`.

## Decisions
- Custom theme + Elementor widgets (not page-builder-only). Widgets declared in `inc/elementor/definitions.php`.
- Header/Footer are `tt_layout` posts (Elementor-editable) with PHP fallbacks.
- Sector brand colours (brand book): Defence #355a17, Aviation #0091d1, Driving/Automobile #ae1857, OESD/Industrial #b87626.
- Headings italic Lato; navbar = one SVG curved shape that morphs on scroll (`assets/js/nav-morph.js`).
- Two homepage variants: `/` (sector fan) and `/home-carousel/` (Framer Modern Carousel).
- Elementor CSS is loaded in `@layer elementor` so Tailwind utilities win.
- No public hosting yet (shared hosting planned; deploy via `.github/workflows/deploy-wp-theme.yml`, see `wordpress-theme/DEPLOY.md`).

## Open items / gaps vs wireframe (tecknotrove_wireframe.xlsx)
See "Wireframe gap plan" in `wordpress-theme/BUILD_LOG.md`.

## Aviation hub structure (client doc "Aviation Hub Menu Layout", built 2026-10-21)
- Three levels: industry `/aviation/` (Elementor page #20) -> hub CPT `hub` at `/aviation/<slug>/` (GSE Simulators, Airside Driving Simulators, Aircraft Maintenance Training Solutions, Supported Technologies & Services) -> products at `/products/<slug>/` (8 aviation products, linked to a hub by meta `tt_hub_id`). Common pages `/digital-twins/`, `/istc/`.
- Code: `inc/aviation.php` (CPT, hub meta box on products, menu helpers), widgets `tt_av_*` in `inc/elementor/aviation-defs.php`, partials `template-parts/aviation/*`, `single-hub.php`. Sticky sector sub-menu = `tt_av_subnav` (built automatically from hubs + products).
- Seed: `wordpress-theme/tools/seed-aviation.php` (re-runnable; clears Elementor cache, which otherwise serves stale pages).
- Real content: only Cargo Loader (from `Aviation/BROCHURE/Cargo High Loader (1).pdf`, images cropped into `assets/images/aviation/`). All other aviation copy is DRAFT, pending client content.
- Doc typo: "Airside Driving Simulators" listed twice in Industry Hub line; Simulation Technologies section links Digital Twins/ISTC/TMS/Team Play (assumed).
- Gotcha: `definitions.php` reuses `$col` in the menu loop; `aviation-defs.php` redefines it.

## Client copy received 2026-10-27 (draft, not final)
- Files (Downloads): "Tecknotrove Aviation Pages (1).docx" (page map + Aviation industry page copy), "GSE Simulators.docx" (hub), "Cargo Loader & High Loader Simulator.docx" (product), "Aviation Hub Menu Layout (1).docx" (same tree as the first menu doc). Copy extracted to `C:\Users\milli\cg\docs\*.txt` (scratch).
- Copy proposes URLs `/industries/aviation/...` (we built `/aviation/...`); page map product list differs from menu doc (adds Boarding Bridge [confirm], Fuel Tanker, Ramp Safety VR, Walk-Around VR, AR/VR digitisation, Hangar add-on, 6 Supported Technologies items instead of Digital Twins/ISTC pages).
- Facts in copy conflict with homepage stats: 28 countries / 1,000+ projects vs 35+ / 1,500+; manufacturing in Gujarat vs Mumbai HQ. Warranty 1 yr + AMC, delivery 6-8 weeks, life ~5 yrs.
- Cargo video: https://www.youtube.com/watch?v=CNAXDgL6Se0. 13 gallery images named but files not supplied. Title tags + meta descriptions supplied per page; keyword table pending (SE Ranking).
- Only 3 of 6 pages have final-ish copy; other hubs/products still draft in `tools/seed-aviation.php`.

## Sector navbar (2026-10-29)
- Aviation is a site-within-a-site: `tecknotrove_is_aviation()` (inc/aviation.php) is true on /aviation/, hub pages and aviation products; `header.php` then renders `template-parts/layout/navbar-aviation.php` instead of the main navbar (wireframe "SECTOR NAV"). Digital Twins/ISTC keep the main nav.
- Aviation navbar: logo + "Aviation" | Home | 4 hubs (dropdown of products) | Tecknotrove.com | Enquire Now; hamburger panel below 1280px. The old sticky `tt_av_subnav` strip is removed from seeds (widget class still exists).
- Other sectors (Defence, Driving, OESD) will follow the same pattern: own navbar part + `is_<sector>()` check.
- aviation layout doc (2) is identical to (1).
