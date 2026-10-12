#!/usr/bin/env python3
"""
Static export of the local WordPress site, for hosting on Vercel (which cannot run PHP).

    python tools/static-export.py

Crawls http://localhost/tecknotrove/ and writes two ready-to-deploy folders:
  static-export/fan       homepage with the 4-card sector fan  (WP page "/")
  static-export/carousel  homepage with the Framer carousel    (WP page "/home-carousel/")
Both contain the same inner pages (sectors, product, about, careers, news, contact).
Needs the local XAMPP site running.
"""
import json
import os
import re
import shutil
import sys
import urllib.parse
import urllib.request

BASE = "http://localhost/tecknotrove/"
OUT = os.path.join(os.path.dirname(os.path.abspath(__file__)), "..", "static-export")
INNER = ["defence/", "aviation/", "automobile/", "oesd/", "about/", "careers/", "news/", "contact/", "products/tank-driving-simulator/"]
VARIANTS = {"fan": "", "carousel": "home-carousel/"}

ASSET_RE = re.compile(r'''(?:src|href|data-src|poster)=["']([^"']+)["']|url\(\s*["']?([^"')]+)["']?\s*\)|@import\s+["']([^"']+)["']''')


def fetch(url):
    req = urllib.request.Request(url, headers={"User-Agent": "tt-static-export"})
    with urllib.request.urlopen(req, timeout=60) as r:
        return r.read(), r.headers.get_content_type()


def to_local(url):
    """Map a localhost URL to a path relative to the site root, or None if external."""
    url = url.split("#")[0]
    if not url.startswith(BASE):
        return None
    rel = url[len(BASE):].split("?")[0]
    return rel


def clean_html(html):
    # Drop jQuery / Elementor runtime scripts: the exported page is static and needs neither.
    html = re.sub(r'<script[^>]+src=["\'][^"\']*(?:plugins/elementor|wp-includes/js/jquery|jquery-migrate|wp-emoji)[^"\']*["\'][^>]*></script>\s*', "", html)
    html = re.sub(r'<script[^>]*id=["\'](?:elementor|jquery)[^"\']*["\'][^>]*>.*?</script>\s*', "", html, flags=re.S)
    html = re.sub(r"<script[^>]*>[^<]*(?:elementorFrontendConfig|elementorWebCfg|wpemoji)[^<]*</script>\s*", "", html, flags=re.S)
    html = re.sub(r'<link[^>]+rel=["\'](?:https://api\.w\.org/|EditURI|alternate|shortlink)[^>]*>\s*', "", html)
    # Contact form: there is no PHP backend on Vercel.
    html = re.sub(r'(<form[^>]*?)action="[^"]*admin-post\.php"', r'\1action="#" onsubmit="alert(\'This is a static preview: the contact form is disabled.\');return false;"', html)
    return html


def localise(text):
    text = text.replace(BASE, "/").replace(BASE.replace("/", "\\/"), "\\/")
    text = text.replace("http://localhost/tecknotrove", "")
    return text


def main():
    pages_cache = {}
    assets = {}

    def page(path):
        if path not in pages_cache:
            body, _ = fetch(BASE + path)
            pages_cache[path] = body.decode("utf-8", "replace")
        return pages_cache[path]

    def collect(text, base_url):
        found = []
        for m in ASSET_RE.finditer(text):
            u = next(g for g in m.groups() if g)
            found.append(u)
        # any quoted localhost asset URL (import maps, inline JSON, escaped slashes)
        quoted = r"""["'](http:\\?/\\?/localhost\\?/tecknotrove\\?/[^"'\s]+?\.(?:js|css|json|png|jpe?g|webp|svg|woff2?|ttf))"""
        for m in re.finditer(quoted, text):
            found.append(m.group(1).replace("\\/", "/"))
        for m in re.finditer(r'srcset=["\']([^"\']+)["\']', text):
            for part in m.group(1).split(","):
                found.append(part.strip().split(" ")[0])
        out = []
        for u in found:
            if u.startswith(("data:", "mailto:", "tel:", "javascript:", "#")):
                continue
            full = urllib.parse.urljoin(base_url, u.replace("&#038;", "&"))
            rel = to_local(full)
            if rel and "." in os.path.basename(rel):
                out.append((full, rel))
        return out

    queue = []
    for key, home in VARIANTS.items():
        for p in [home] + INNER:
            html = page(p)
            queue += collect(html, BASE + p)

    seen = set()
    while queue:
        full, rel = queue.pop()
        if rel in seen or rel.endswith((".php",)):
            continue
        seen.add(rel)
        try:
            body, ctype = fetch(full)
        except Exception as e:  # noqa: BLE001
            print("skip", rel, e)
            continue
        assets[rel] = body
        if rel.endswith(".css"):
            queue += collect(body.decode("utf-8", "replace"), full)

    for key, home in VARIANTS.items():
        d = os.path.join(OUT, key)
        shutil.rmtree(d, ignore_errors=True)
        os.makedirs(d)
        for rel, body in assets.items():
            target = os.path.join(d, rel)
            os.makedirs(os.path.dirname(target), exist_ok=True)
            if rel.endswith((".css", ".js", ".json", ".svg")):
                body = localise(body.decode("utf-8", "replace")).encode("utf-8")
            with open(target, "wb") as f:
                f.write(body)
        for p, src in [("", home)] + [(i, i) for i in INNER]:
            html = localise(clean_html(page(src)))
            target = os.path.join(d, p, "index.html")
            os.makedirs(os.path.dirname(target), exist_ok=True)
            with open(target, "w", encoding="utf-8") as f:
                f.write(html)
        print(key, "->", d, len(assets), "assets")


if __name__ == "__main__":
    sys.exit(main())
