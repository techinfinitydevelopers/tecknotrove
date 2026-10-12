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
