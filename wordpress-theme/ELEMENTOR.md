# Editing the site with Elementor

The theme ships custom Elementor widgets (category **Tecknotrove**), one per section, so every page is built visually while keeping the design and animations.

## Setup (once per WordPress install)
1. Install and activate the free **Elementor** plugin.
2. Activate this theme.
3. Run the content seeders (WP-CLI):
   ```
   TT_IMAGES=<path to public/images> wp eval-file wp-content/themes/tecknotrove/tools/seed.php
   wp eval-file wp-content/themes/tecknotrove/tools/seed-elementor.php
   ```
   This creates the sector + product records, and the Elementor pages: Home (set as front page), Defence, Aviation, Automobile, OESD, About, Careers, News, Contact, plus the Header and Footer layouts and the Tank Driving Simulator product page.

## Editing
- **Pages**: Pages > hover a page > *Edit with Elementor*. Click any section, edit its text, images, colours, repeaters in the left panel. Drag new sections in from the *Tecknotrove* widget group.
- **Header / Footer**: *Header / Footer* in the admin menu > edit "Site Header" / "Site Footer" with Elementor (the curved navbar and footer are widgets). Remove the layout post to fall back to the built-in PHP versions.
- **Product pages**: Products > open a product > *Edit with Elementor* (uses the *TT Product Page* widget; the product's specs/features are edited in the product's own fields).
- **New pages**: Pages > Add New > build with the Tecknotrove widgets (Page Hero, Text + Image, Card Grid, Contact + Form, News Cards, ...).

## Widgets
Home: TT Home Hero, Sector Cards, Split Showcase, News Cards, Partner/Careers Tiles, LinkedIn Posts, Orange CTA + Contact Card.
Sector: Hero, Stat Strip, Benefits, Products (auto list), Applications, Technology, Track Record, Closing CTA.
Generic: Page Hero, Text + Image, Card Grid, Contact + Form. Layout: Navbar, Footer. Product: Product Page.

## Notes
- Widgets are declared as data in `inc/elementor/definitions.php`; add a field there to add a control.
- Elementor's CSS is loaded in a cascade layer below Tailwind (see `inc/elementor/loader.php`) so theme utilities win.
- Page content lives in the database, not git. Deploys update theme code only.

## Framer carousel variant
`/home-carousel/` is a copy of Home where the sector fan is replaced by the Framer "Modern Carousel" component (widget **TT Framer Carousel**). The component loads React and framer-motion from esm.sh and the Framer module from framerusercontent.com at runtime (see `inc/elementor/framer-carousel.php`, `assets/js/framer-carousel.js`, `assets/js/framer-stub.js`). Needs internet access on the visitor's browser.
