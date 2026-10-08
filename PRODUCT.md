# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Stack
Custom WordPress PHP theme (`wordpress-theme/`) with Tailwind v4 (standalone CLI build to `assets/css/style.css`) and vanilla JS. Content is editable in wp-admin (Homepage options, Sector and Product custom post types). Deploys by git push, via GitHub Actions FTP, to shared hosting (host not yet bought). The original Next.js 16 build in `src/` is the legacy reference.

## Users
Business and institutional buyers and visitors:
- Defence procurement (armed forces, ministries, defence PSUs, integrators)
- Aviation and airports (airlines, airports, ground-support and flight-training buyers)
- Automotive and OEMs (driving, fleet, logistics training)
- Job seekers and press (careers, news, company information)

## Product Purpose
Corporate marketing site for Tecknotrove, a Mumbai-based simulation and training technology company (est. 2003). It must do three jobs at once: get visitors to enquire or request a demo, let them understand the product range across sectors and products, and build credibility through track record and certifications.

## Positioning
- All engineering in-house: motion platform, visuals, controls and instructor software ship as one integrated system.
- One company across four sectors: Defence, Aviation, Automobile, OESD.
- 20+ years of track record, ISO 9001:2015 certified.
- Convertible platforms: one simulator reconfigured across vehicle types (e.g. T-72 / T-90 / Arjun in under 20 minutes).

## Operating Context
Visitors arrive from search, referrals and expos, often evaluating several vendors. Site structure: homepage, four sector pages (`/defence`, `/aviation`, `/automobile`, `/oesd`), and product detail pages (`/products/<slug>`). The client edits content in wp-admin and developers push theme code through git.

## Capabilities and Constraints
- Custom PHP theme only, no page builder (client requirement).
- Sector and product content lives in the database, not git; theme code lives in git.
- Only one product page exists so far (Tank Driving Simulator, TDS-6F); other sector products are listed as text.
- Contact form and a public live URL are not set up yet.
- Terminology: sectors, simulators, 6-DOF motion platform, NVG, MIL-STD.

## Brand Commitments
- Name "Tecknotrove" with the existing logo (white and blue variants in `public/images/`; a diamond mark near the "E" of the wordmark).
- Company address: 505, Windfall, Sahar Plaza, Chakala, Andheri (East), Mumbai 400059.
- Brand book and brochures exist in the project root (`Tecknotrove Brand Book.pdf`, sector brochure folders); the visual identity decisions come from these and are not yet recorded here.

## Evidence on Hand
- Real brochures per sector, a brand book, wireframe spreadsheet, logos, and sector and news imagery.
- Stats used on the site: 20+ years in defence, 8 simulator platforms, 6-DOF, MIL-STD compliance, ISO 9001:2015.
- Not available: client logos and testimonials beyond what is already on the site; do not fabricate more.

## Product Principles
1. Show the engineering: precise specs and real systems over generic claims.
2. Serve several buyers without diluting any: each sector page speaks to its own audience.
3. Credibility before flourish: proof and certifications stay prominent.
4. Every page leads toward an enquiry.
5. Content stays editable by the client without developer help.

## Accessibility & Inclusion
No specific standard established; aim for readable contrast and keyboard-usable navigation. Open decision: confirm a target (e.g. WCAG AA) with the client.
