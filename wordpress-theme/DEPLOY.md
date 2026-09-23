# Deploying to the live site

This theme auto-deploys to the live server whenever `wordpress-theme/` is
pushed to `main` on GitHub, via `.github/workflows/deploy-wp-theme.yml`.
No manual FTP upload needed once this is set up.

## One-time setup (do this once, after hosting is bought)

1. **Get FTP/SFTP credentials from the host.** Every shared host (Hostinger,
   GoDaddy, Bluehost, etc.) has this in its control panel — usually under
   "FTP Accounts" or "File Manager". You need:
   - Hostname (e.g. `ftp.yourdomain.com`)
   - Username
   - Password
   - The full server path to `wp-content/themes/` — e.g.
     `/public_html/wp-content/themes/tecknotrove/` (create the `tecknotrove`
     folder if it doesn't exist yet; the host's File Manager can do this).

2. **Add those as GitHub secrets.** In the GitHub repo:
   `Settings → Secrets and variables → Actions → New repository secret`,
   add each of these (exact names matter):
   - `FTP_SERVER` — the hostname
   - `FTP_USERNAME`
   - `FTP_PASSWORD`
   - `FTP_REMOTE_DIR` — the full path from step 1, ending in `/`

3. **Install WordPress on the live server** the normal way (most hosts have
   a 1-click WordPress installer), then in wp-admin activate the
   **Tecknotrove** theme once the first deploy has landed.

4. **Push to `main`.** That's it — GitHub rebuilds the CSS and uploads the
   theme automatically on every push that touches `wordpress-theme/`.

## What does NOT deploy automatically

- **Content** (Sectors, Products, Homepage text, images uploaded via Media
  Library) — that all lives in the live site's own MySQL database, separate
  from git entirely. Editing it in wp-admin on the live site is instant,
  same as it is locally.
- **WordPress core and plugins** — installed once via the host's WP
  installer, not part of this repo.

## If the host doesn't support FTP (rare) or you'd rather not use it

Some managed WordPress hosts (Kinsta, WP Engine, Cloudways, SiteGround) have
their own Git-based deploy feature built into their dashboard — if the host
turns out to be one of those, point it at this repo's `wordpress-theme`
folder instead of using the GitHub Action, and disable
`.github/workflows/deploy-wp-theme.yml`.
