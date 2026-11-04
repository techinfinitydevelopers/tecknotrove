(function () {
  "use strict";

  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---------- Nav: shadow on scroll ---------- */
  var nav = document.getElementById("tt-nav");
  if (nav) {
    var onNavScroll = function () {
      nav.classList.toggle("tt-nav-scrolled", window.scrollY > 24);
    };
    window.addEventListener("scroll", onNavScroll, { passive: true });
    onNavScroll();
  }

  /* ---------- Aviation navbar: solid on scroll, hide on scroll down, full-screen menu ---------- */
  var avNav = document.getElementById("tt-av-nav");
  if (avNav) {
    var avToggle = document.getElementById("tt-av-toggle");
    var avMenu = document.getElementById("tt-av-menu");
    var avOpen = false, lastY = window.scrollY;
    var setOpen = function (open) {
      avOpen = open;
      avNav.classList.toggle("is-open", open);
      avToggle.setAttribute("aria-expanded", open ? "true" : "false");
      avToggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
      avMenu.setAttribute("aria-hidden", open ? "false" : "true");
      document.documentElement.style.overflow = open ? "hidden" : "";
      if (open) { var first = avMenu.querySelector("[data-av-menu-hub]"); if (first) setTimeout(function () { first.focus({ preventScroll: true }); }, 450); }
      else avToggle.focus({ preventScroll: true });
    };
    avToggle.addEventListener("click", function () { setOpen(!avOpen); });
    document.addEventListener("keydown", function (e) { if (e.key === "Escape" && avOpen) setOpen(false); });
    avNav.querySelectorAll("[data-av-menu-close]").forEach(function (a) { a.addEventListener("click", function () { if (avOpen) setOpen(false); }); });
    avMenu.querySelectorAll("a[href]").forEach(function (a) { a.addEventListener("click", function () { if (avOpen && a.getAttribute("href").charAt(0) === "#") setOpen(false); }); });
    // hovering/focusing a hub shows its products on the right
    var hubLinks = avMenu.querySelectorAll("[data-av-menu-hub]");
    var panels = avMenu.querySelectorAll("[data-av-menu-panel]");
    var showHub = function (k) {
      hubLinks.forEach(function (h) { h.classList.toggle("is-active", h.getAttribute("data-av-menu-hub") === k); });
      panels.forEach(function (p) { p.classList.toggle("is-on", p.getAttribute("data-av-menu-panel") === k); });
    };
    hubLinks.forEach(function (h) {
      var k = h.getAttribute("data-av-menu-hub");
      h.addEventListener("mouseenter", function () { showHub(k); });
      h.addEventListener("focus", function () { showHub(k); });
    });
    var onAvNavScroll = function () {
      var y = window.scrollY;
      avNav.classList.toggle("is-solid", y > 40);
      if (!avOpen) avNav.classList.toggle("is-hidden", y > 320 && y > lastY + 2 ? true : y < lastY - 2 ? false : avNav.classList.contains("is-hidden") && y > 320);
      lastY = y;
    };
    window.addEventListener("scroll", onAvNavScroll, { passive: true });
    onAvNavScroll();
  }

  /* ---------- Mobile menu toggle ---------- */
  var menuToggle = document.getElementById("tt-menu-toggle");
  var mobileMenu = document.getElementById("tt-mobile-menu");
  var iconOpen = document.getElementById("tt-menu-icon-open");
  var iconClose = document.getElementById("tt-menu-icon-close");
  if (menuToggle && mobileMenu) {
    var menuOpen = false;
    menuToggle.addEventListener("click", function () {
      menuOpen = !menuOpen;
      if (menuOpen) {
        mobileMenu.classList.add("tt-open");
        if (nav) nav.classList.add("tt-menu-open");
        setTimeout(function () {
          mobileMenu.classList.add("tt-menu-in");
          mobileMenu.style.transition = "clip-path 0.55s cubic-bezier(0.76,0,0.24,1)";
          mobileMenu.style.clipPath = "inset(0 0 0% 0)";
        }, 30);
        iconOpen.style.display = "none";
        iconClose.style.display = "block";
        document.body.style.overflow = "hidden";
      } else {
        mobileMenu.classList.remove("tt-menu-in");
        if (nav) nav.classList.remove("tt-menu-open");
        mobileMenu.style.clipPath = "inset(0 0 100% 0)";
        iconOpen.style.display = "block";
        iconClose.style.display = "none";
        document.body.style.overflow = "";
        setTimeout(function () {
          if (!menuOpen) mobileMenu.classList.remove("tt-open");
        }, 550);
      }
    });
    mobileMenu.querySelectorAll("a").forEach(function (a) {
      a.addEventListener("click", function () {
        menuOpen = false;
        mobileMenu.classList.remove("tt-menu-in");
        if (nav) nav.classList.remove("tt-menu-open");
        mobileMenu.style.clipPath = "inset(0 0 100% 0)";
        iconOpen.style.display = "block";
        iconClose.style.display = "none";
        document.body.style.overflow = "";
        setTimeout(function () {
          mobileMenu.classList.remove("tt-open");
        }, 550);
      });
    });
  }

  /* ---------- Enquire Now floating button ---------- */
  var enquireBtn = document.getElementById("tt-enquire-button");
  if (enquireBtn) {
    var onEnquireScroll = function () {
      var visible = window.scrollY > window.innerHeight * 0.7;
      enquireBtn.style.opacity = visible ? "1" : "0";
      enquireBtn.style.transform = visible ? "translateY(0) scale(1)" : "translateY(24px) scale(0.9)";
      enquireBtn.style.pointerEvents = visible ? "auto" : "none";
    };
    enquireBtn.style.transition = "opacity 0.35s cubic-bezier(0.16,1,0.3,1), transform 0.35s cubic-bezier(0.16,1,0.3,1)";
    window.addEventListener("scroll", onEnquireScroll, { passive: true });
    onEnquireScroll();
  }

  /* ---------- Magnetic buttons (.tt-btn) ---------- */
  if (!reduceMotion) {
    document.querySelectorAll(".tt-btn").forEach(function (btn) {
      var x = 0, y = 0, targetX = 0, targetY = 0, raf = null;

      function tick() {
        x += ( targetX - x ) * 0.18;
        y += ( targetY - y ) * 0.18;
        btn.style.transform = "translate(" + x.toFixed(2) + "px," + y.toFixed(2) + "px)";
        if (Math.abs(targetX - x) > 0.1 || Math.abs(targetY - y) > 0.1) {
          raf = requestAnimationFrame(tick);
        } else {
          raf = null;
        }
      }

      btn.addEventListener("mousemove", function (e) {
        var rect = btn.getBoundingClientRect();
        targetX = (e.clientX - rect.left - rect.width / 2) * 0.35;
        targetY = (e.clientY - rect.top - rect.height / 2) * 0.5;
        if (!raf) raf = requestAnimationFrame(tick);
      });

      btn.addEventListener("mouseleave", function () {
        targetX = 0;
        targetY = 0;
        if (!raf) raf = requestAnimationFrame(tick);
      });
    });
  }

  /* ---------- Aviation: stagger delays, hero parallax, scroll progress ---------- */
  document.querySelectorAll("[data-stagger]").forEach(function (group) {
    Array.prototype.forEach.call(group.querySelectorAll(":scope > [data-reveal]"), function (el, i) {
      el.style.setProperty("--i", String(i % 6));
    });
  });
  var avImg = document.querySelector("[data-av-parallax]");
  var avCopy = document.querySelector("[data-av-hero-copy]");
  var avBar = document.getElementById("tt-av-progress");
  if ((avImg || avBar) && !reduceMotion) {
    var avTick = false;
    var avUpdate = function () {
      avTick = false;
      var y = window.scrollY;
      if (avImg && y < window.innerHeight * 1.2) {
        avImg.style.transform = "translate3d(0," + (y * 0.18).toFixed(1) + "px,0)";
        if (avCopy) {
          var f = Math.min(1, y / (window.innerHeight * 0.7));
          avCopy.style.opacity = String(1 - f * 0.6);
          avCopy.style.transform = "translate3d(0," + (y * -0.06).toFixed(1) + "px,0)";
        }
      }
      if (avBar) {
        var max = document.documentElement.scrollHeight - window.innerHeight;
        avBar.style.transform = "scaleX(" + (max > 0 ? Math.min(1, y / max) : 0).toFixed(3) + ")";
      }
    };
    window.addEventListener("scroll", function () {
      if (!avTick) { avTick = true; requestAnimationFrame(avUpdate); }
    }, { passive: true });
    avUpdate();
  }

  /* ---------- Aviation: airside map, index preview, spotlight, magnetic, ripple, scroll-velocity marquee ---------- */
  document.querySelectorAll("[data-av-map]").forEach(function (sec) {
    var items = sec.querySelectorAll("[data-av-map-item]");
    var vehs = sec.querySelectorAll("[data-av-veh]");
    var cur = 0, timer = 0, userTouched = false, visible = false;
    var set = function (n) {
      cur = n;
      items.forEach(function (it, k) { it.setAttribute("aria-current", k === n ? "true" : "false"); });
      vehs.forEach(function (v, k) { v.classList.toggle("is-on", k === n); });
    };
    var tick = function () { if (!userTouched && visible && !reduceMotion) set((cur + 1) % items.length); };
    items.forEach(function (it, n) {
      ["mouseenter", "focus", "click"].forEach(function (ev) { it.addEventListener(ev, function () { userTouched = true; set(n); }); });
    });
    vehs.forEach(function (v, n) {
      ["mouseenter", "focus", "click"].forEach(function (ev) { v.addEventListener(ev, function () { userTouched = true; set(n); }); });
    });
    if ("IntersectionObserver" in window) {
      new IntersectionObserver(function (es) { visible = es[0].isIntersecting; }, { threshold: 0.3 }).observe(sec);
    } else { visible = true; }
    set(0);
    timer = setInterval(tick, 3200);
  });

  document.querySelectorAll("[data-av-index]").forEach(function (sec) {
    var pv = sec.querySelector("[data-av-ipv]");
    var imgs = sec.querySelectorAll("[data-av-ipv-img]");
    var rows = sec.querySelectorAll("[data-av-irow]");
    if (!pv || !window.matchMedia("(hover: hover) and (min-width: 1024px)").matches) return;
    var tx = 0, ty = 0, x = 0, y = 0, raf = 0, on = false;
    var loop = function () {
      x += (tx - x) * 0.14; y += (ty - y) * 0.14;
      pv.style.transform = "translate3d(" + (x + 28).toFixed(1) + "px," + (y - 110).toFixed(1) + "px,0) rotate(" + ((tx - x) * 0.04).toFixed(2) + "deg)";
      raf = on || Math.abs(tx - x) > 0.5 || Math.abs(ty - y) > 0.5 ? requestAnimationFrame(loop) : 0;
    };
    rows.forEach(function (row, n) {
      row.addEventListener("mouseenter", function (e) {
        on = true;
        if (!raf) { x = tx = e.clientX; y = ty = e.clientY; raf = requestAnimationFrame(loop); }
        imgs.forEach(function (im, k) { im.classList.toggle("is-on", k === n); });
        pv.classList.add("is-on");
      });
      row.addEventListener("mousemove", function (e) { tx = e.clientX; ty = e.clientY; });
      row.addEventListener("mouseleave", function () { on = false; pv.classList.remove("is-on"); });
    });
  });

  // Cursor spotlight on cards and step cards.
  document.addEventListener("pointermove", function (e) {
    var el = e.target.closest && e.target.closest(".tt-av-card, .tt-av-step");
    if (!el) return;
    var r = el.getBoundingClientRect();
    el.style.setProperty("--mx", (e.clientX - r.left) + "px");
    el.style.setProperty("--my", (e.clientY - r.top) + "px");
  }, { passive: true });

  if (!reduceMotion && window.matchMedia("(hover: hover)").matches) {
    // Magnetic pull on the two focal buttons only (hero primary CTA, navbar Enquire Now).
    var magnets = [];
    var heroBtn = document.querySelector("[data-av-hero-copy] a");
    if (heroBtn) magnets.push(heroBtn);
    var navBtn = document.querySelector('#tt-av-nav a[href="#contact"]');
    if (navBtn) magnets.push(navBtn);
    magnets.forEach(function (b) {
      b.setAttribute("data-av-magnet", "");
      b.addEventListener("pointermove", function (e) {
        var r = b.getBoundingClientRect();
        b.style.transform = "translate(" + ((e.clientX - r.left - r.width / 2) * 0.25).toFixed(1) + "px," + ((e.clientY - r.top - r.height / 2) * 0.35).toFixed(1) + "px)";
      });
      b.addEventListener("pointerleave", function () { b.style.transition = "transform .5s cubic-bezier(.16,1,.3,1)"; b.style.transform = ""; setTimeout(function () { b.style.transition = ""; }, 520); });
    });
  }

  // Click ripple on pill buttons.
  document.addEventListener("pointerdown", function (e) {
    var b = e.target.closest && e.target.closest('#tt-av-nav a[href="#contact"], [data-av-hero-copy] a, #contact a');
    if (!b || reduceMotion) return;
    var r = b.getBoundingClientRect();
    var d = Math.max(r.width, r.height) * 2;
    var s = document.createElement("span");
    s.className = "tt-av-ripple";
    s.style.cssText = "width:" + d + "px;height:" + d + "px;left:" + (e.clientX - r.left - d / 2) + "px;top:" + (e.clientY - r.top - d / 2) + "px";
    if (getComputedStyle(b).position === "static") b.style.position = "relative";
    b.style.overflow = "hidden";
    b.appendChild(s);
    setTimeout(function () { s.remove(); }, 750);
  });

  // Ticker speeds up with scroll velocity and flips direction with scroll direction.
  var mq = document.querySelector(".tt-av-marquee-track");
  if (mq && !reduceMotion) {
    mq.classList.add("is-js");
    var mx = 0, dir = -1, lastY = window.scrollY, boost = 0;
    window.addEventListener("scroll", function () {
      var dy = window.scrollY - lastY; lastY = window.scrollY;
      boost = Math.min(Math.abs(dy) * 0.35, 18);
      if (dy !== 0) dir = dy > 0 ? -1 : 1;
    }, { passive: true });
    var mqLoop = function () {
      boost *= 0.94;
      mx += dir * (0.55 + boost);
      var half = mq.scrollWidth / 2;
      if (mx <= -half) mx += half; else if (mx > 0) mx -= half;
      mq.style.transform = "translate3d(" + mx.toFixed(2) + "px,0,0)";
      requestAnimationFrame(mqLoop);
    };
    requestAnimationFrame(mqLoop);
  }

  /* ---------- Aviation: list + image showcase ---------- */
  document.querySelectorAll("[data-av-show]").forEach(function (sec) {
    var items = sec.querySelectorAll("[data-av-show-item]");
    var imgs = sec.querySelectorAll("[data-av-show-img]");
    var set = function (n) {
      items.forEach(function (it, k) { it.setAttribute("aria-current", k === n ? "true" : "false"); });
      imgs.forEach(function (im, k) { im.classList.toggle("is-on", k === n); });
    };
    items.forEach(function (it, n) {
      ["mouseenter", "focus", "click"].forEach(function (ev) { it.addEventListener(ev, function () { set(n); }); });
    });
  });

  /* ---------- Aviation: story panel. Titles drive the image; autoplay with a progress line, pauses on hover/focus, stops after a click. ---------- */
  document.querySelectorAll("[data-av-story]").forEach(function (root) {
    var items = Array.prototype.slice.call(root.querySelectorAll("[data-av-story-item]"));
    var imgs = root.querySelectorAll("[data-av-story-img]");
    var caps = root.querySelectorAll("[data-av-story-cap]");
    var curEl = root.querySelector("[data-av-story-cur]");
    var n = items.length;
    if (n < 2) return;
    var dur = parseInt(root.getAttribute("data-autoplay"), 10) || 0;
    var cur = 0, stopped = reduceMotion || !dur, paused = false, visible = false, start = 0, elapsed = 0, timer = 0;
    var fills = items.map(function (it) { return it.querySelector("[data-av-story-fill]"); });
    var open = function (k) {
      cur = k; elapsed = 0; start = performance.now();
      items.forEach(function (it, j) {
        it.classList.toggle("is-on", j === k);
        it.querySelector("[data-av-story-btn]").setAttribute("aria-expanded", j === k ? "true" : "false");
      });
      imgs.forEach(function (im, j) { im.classList.toggle("is-on", j === k); });
      caps.forEach(function (c, j) { c.classList.toggle("is-on", j === k); });
      if (curEl) curEl.textContent = (k < 9 ? "0" : "") + (k + 1);
    };
    // progress uses a timer (not rAF) so it keeps time even when frames are throttled
    var step = function () {
      var rb = root.getBoundingClientRect();
      visible = rb.top < window.innerHeight * 0.65 && rb.bottom > window.innerHeight * 0.35;
      if (stopped || paused || !visible) { start = 0; return; }
      var now = performance.now();
      if (!start) start = now - elapsed;
      elapsed = now - start;
      var p = Math.min(1, elapsed / dur);
      if (fills[cur]) fills[cur].style.transform = "scaleX(" + p.toFixed(4) + ")";
      if (p >= 1) open((cur + 1) % n);
    };
    var run = function () { clearInterval(timer); if (!stopped) timer = setInterval(step, 50); };
    items.forEach(function (it, k) {
      it.querySelector("[data-av-story-btn]").addEventListener("click", function () {
        stopped = true; clearInterval(timer);
        fills.forEach(function (f) { if (f) f.style.transform = "scaleX(0)"; });
        open(k);
      });
    });
    root.addEventListener("mouseenter", function () { paused = true; });
    root.addEventListener("mouseleave", function () { paused = false; });
    root.addEventListener("focusin", function () { paused = true; });
    root.addEventListener("focusout", function () { paused = false; });
    run();
  });

  /* ---------- Aviation: riff carousel. Continuous position `pos`; cards placed by signed distance from it (wrapped for an infinite loop). ---------- */
  document.querySelectorAll("[data-av-riff]").forEach(function (stage) {
    var cards = Array.prototype.slice.call(stage.querySelectorAll("[data-av-riff-card]"));
    var n = cards.length;
    if (n < 2) return;
    var sec = stage.closest("section");
    var curEl = sec.querySelector("[data-av-riff-cur]");
    var prev = sec.querySelector("[data-av-riff-prev]");
    var next = sec.querySelector("[data-av-riff-next]");
    var dur = parseInt(stage.getAttribute("data-autoplay"), 10) || 0;
    stage.classList.add("is-js");
    var pos = 0, target = 0, raf = 0, dragging = false, startX = 0, startPos = 0, moved = 0, hover = false, visible = false, timer = 0, lastActive = -1;
    var wrap = function (d) { d = ((d % n) + n) % n; return d > n / 2 ? d - n : d; };
    var spread = function () { return cards[0].offsetWidth * (window.innerWidth < 640 ? 0.78 : 0.56); };
    var fit = function () {
      var h = 0; cards.forEach(function (c) { h = Math.max(h, c.offsetHeight); });
      stage.style.height = (h + 110) + "px";
    };
    var render = function () {
      var sp = spread();
      cards.forEach(function (c, i) {
        var d = wrap(i - pos), a = Math.abs(d);
        var x = d * sp, rot = d * 2.5, sc = 1 - Math.min(a, 3) * 0.08, y = 24 + Math.min(a, 3) * 22;
        var op = a > 2.6 ? 0 : 1 - Math.max(0, a - 1.6);
        c.style.transform = "translate3d(" + x.toFixed(1) + "px," + y.toFixed(1) + "px,0) rotate(" + rot.toFixed(2) + "deg) scale(" + sc.toFixed(3) + ")";
        c.style.opacity = op.toFixed(3);
        c.style.zIndex = String(100 - Math.round(a * 10));
        c.style.filter = a > 0.05 ? "brightness(" + (1 - Math.min(a, 2) * 0.06).toFixed(3) + ")" : "";
      });
      var act = ((Math.round(pos) % n) + n) % n;
      if (act !== lastActive) {
        lastActive = act;
        if (curEl) curEl.textContent = (act < 9 ? "0" : "") + (act + 1);
        cards.forEach(function (c, i) { c.setAttribute("aria-hidden", i === act ? "false" : "true"); });
      }
    };
    var loop = function () {
      raf = 0;
      if (!dragging) pos += (target - pos) * (reduceMotion ? 1 : 0.12);
      if (Math.abs(target - pos) < 0.0005) pos = target;
      render();
      if (dragging || pos !== target) raf = requestAnimationFrame(loop);
    };
    var kick = function () { if (!raf) raf = requestAnimationFrame(loop); };
    var go = function (k) { target = k; kick(); restart(); };
    var restart = function () {
      clearTimeout(timer);
      if (!dur || reduceMotion || hover || dragging || !visible) return;
      timer = setTimeout(function () { go(Math.round(target) + 1); }, dur);
    };
    if (prev) prev.addEventListener("click", function () { go(Math.round(target) - 1); });
    if (next) next.addEventListener("click", function () { go(Math.round(target) + 1); });
    stage.addEventListener("keydown", function (e) {
      if (e.key === "ArrowRight") { e.preventDefault(); go(Math.round(target) + 1); }
      if (e.key === "ArrowLeft") { e.preventDefault(); go(Math.round(target) - 1); }
    });
    stage.addEventListener("pointerdown", function (e) {
      if (e.button !== 0) return;
      dragging = true; moved = 0; startX = e.clientX; startPos = pos; target = pos;
      stage.classList.add("is-drag");
      clearTimeout(timer); kick();
    });
    window.addEventListener("pointermove", function (e) {
      if (!dragging) return;
      var dx = e.clientX - startX; moved = Math.max(moved, Math.abs(dx));
      if (moved > 4 && !stage.hasPointerCapture(e.pointerId)) { try { stage.setPointerCapture(e.pointerId); } catch (err) {} }
      pos = startPos - dx / spread(); target = pos;
    });
    var end = function (e) {
      if (!dragging) return;
      dragging = false; stage.classList.remove("is-drag");
      var v = pos - startPos;
      target = Math.abs(v) > 0.12 && Math.abs(v) < 0.5 ? (v > 0 ? Math.ceil(pos) : Math.floor(pos)) : Math.round(pos);
      if (moved < 5 && e && e.target) {
        // a click on a side card brings it to the front
        var card = e.target.closest("[data-av-riff-card]");
        if (card) { var i = cards.indexOf(card); target = Math.round(pos) + wrap(i - pos); }
      }
      kick(); restart();
    };
    window.addEventListener("pointerup", end);
    window.addEventListener("pointercancel", end);
    stage.addEventListener("mouseenter", function () { hover = true; clearTimeout(timer); });
    stage.addEventListener("mouseleave", function () { hover = false; restart(); });
    stage.addEventListener("focusin", function () { hover = true; clearTimeout(timer); });
    stage.addEventListener("focusout", function () { hover = false; restart(); });
    if ("IntersectionObserver" in window) {
      new IntersectionObserver(function (es) { visible = es[0].isIntersecting; if (visible) restart(); else clearTimeout(timer); }, { threshold: 0.4 }).observe(stage);
    }
    window.addEventListener("resize", function () { fit(); render(); });
    fit(); render();
  });

  /* ---------- Aviation: FAQ flow ---------- */
  document.querySelectorAll("[data-av-faq]").forEach(function (list) {
    var items = Array.prototype.slice.call(list.querySelectorAll("[data-av-faq-item]"));
    var line = list.querySelector("[data-av-faq-line]");
    var cur = list.parentNode.querySelector("[data-av-faq-cur]");
    if (!items.length) return;
    var nodeY = function (k) {
      // node centre for item k assuming every earlier item is collapsed (its final position)
      var y = 0;
      for (var j = 0; j < k; j++) { var q = items[j].querySelector("[data-av-faq-q]"); y += q.offsetHeight + 1; }
      return y + 1.7 * 16 + 12;
    };
    var open = function (k) {
      items.forEach(function (it, j) {
        it.classList.toggle("is-open", j === k);
        it.classList.toggle("is-before", j < k);
        var b = it.querySelector("[data-av-faq-q]");
        b.setAttribute("aria-expanded", j === k ? "true" : "false");
      });
      if (line) line.style.height = (k < 0 ? 0 : nodeY(k)) + "px";
      if (cur && k >= 0) cur.textContent = (k < 9 ? "0" : "") + (k + 1);
    };
    var active = 0;
    items.forEach(function (it, k) {
      var b = it.querySelector("[data-av-faq-q]");
      b.addEventListener("click", function () { if (active === k) { active = -1; } else { active = k; } open(active); });
    });
    open(0);
    window.addEventListener("resize", function () { if (active >= 0) line.style.height = nodeY(active) + "px"; });
  });

  /* ---------- Aviation: showcase accordion (hubs): click/hover-intent opens, autoplay + progress bar, pause on hover/focus, stops after a click ---------- */
  document.querySelectorAll("[data-av-acc]").forEach(function (acc) {
    var items = Array.prototype.slice.call(acc.querySelectorAll("[data-av-acc-item]"));
    if (items.length < 2) return;
    var dur = parseInt(acc.getAttribute("data-autoplay"), 10) || 0;
    var cur = 0, stopped = reduceMotion || !dur, paused = false, visible = false, t0 = 0, raf = 0, elapsed = 0;
    items.forEach(function (it, i) { if (it.classList.contains("is-open")) cur = i; });
    var fills = items.map(function (it) { return it.querySelector("[data-av-acc-fill]"); });
    var open = function (i) {
      cur = i; elapsed = 0; t0 = 0;
      items.forEach(function (it, k) {
        var on = k === i;
        it.classList.toggle("is-open", on);
        var b = it.querySelector("[data-av-acc-btn]");
        if (b) b.setAttribute("aria-expanded", on ? "true" : "false");
        if (fills[k]) fills[k].style.transform = "scaleX(0)";
      });
    };
    var tick = function (now) {
      raf = 0;
      if (stopped || paused || !visible) { t0 = 0; return; }
      if (!t0) t0 = now - elapsed;
      elapsed = now - t0;
      var p = Math.min(1, elapsed / dur);
      if (fills[cur]) fills[cur].style.transform = "scaleX(" + p.toFixed(4) + ")";
      if (p >= 1) { open((cur + 1) % items.length); }
      raf = requestAnimationFrame(tick);
    };
    var kick = function () { if (!raf && !stopped && !paused && visible) { t0 = 0; raf = requestAnimationFrame(tick); } };
    var stop = function () { stopped = true; if (fills[cur]) fills[cur].style.transform = "scaleX(0)"; };
    items.forEach(function (it, i) {
      var b = it.querySelector("[data-av-acc-btn]");
      if (b) {
        b.addEventListener("click", function () { stop(); open(i); });
        b.addEventListener("keydown", function (e) {
          var d = e.key === "ArrowRight" || e.key === "ArrowDown" ? 1 : e.key === "ArrowLeft" || e.key === "ArrowUp" ? -1 : 0;
          if (!d) return;
          e.preventDefault(); stop();
          var n = (i + d + items.length) % items.length;
          open(n);
          var nb = items[n].querySelector("[data-av-acc-btn]"); if (nb) nb.focus();
        });
      }
    });
    acc.addEventListener("mouseenter", function () { paused = true; });
    acc.addEventListener("mouseleave", function () { paused = false; kick(); });
    acc.addEventListener("focusin", function () { paused = true; });
    acc.addEventListener("focusout", function () { paused = false; kick(); });
    if ("IntersectionObserver" in window) {
      new IntersectionObserver(function (es) { visible = es[0].isIntersecting; if (visible) kick(); }, { threshold: 0.35 }).observe(acc);
    } else { visible = true; kick(); }
  });

  /* ---------- Aviation: progress-step cards, bar fills as the card travels up the screen ---------- */
  var avSteps = Array.prototype.slice.call(document.querySelectorAll("[data-av-step]"));
  if (avSteps.length) {
    var stepState = avSteps.map(function (el) { return { el: el, fill: el.querySelector("[data-av-stepfill]"), cur: 0, tgt: 0 }; });
    if (reduceMotion) {
      stepState.forEach(function (s) { if (s.fill) s.fill.style.transform = "translateY(0)"; s.el.classList.add("is-on"); });
    } else {
      var stepRaf = 0;
      var stepMeasure = function () {
        var vh = window.innerHeight;
        stepState.forEach(function (s) {
          var r = s.el.getBoundingClientRect();
          var cy = r.top + r.height / 2;
          s.tgt = Math.max(0, Math.min(1, (vh * 0.88 - cy) / (vh * 0.5)));
        });
      };
      var stepLoop = function () {
        stepRaf = 0;
        var busy = false;
        stepState.forEach(function (s) {
          s.cur += (s.tgt - s.cur) * 0.14;
          if (Math.abs(s.tgt - s.cur) < 0.002) s.cur = s.tgt; else busy = true;
          if (s.fill) s.fill.style.transform = "translateY(" + ((s.cur - 1) * 100).toFixed(2) + "%)";
          s.el.classList.toggle("is-on", s.cur > 0.04);
        });
        if (busy) stepRaf = requestAnimationFrame(stepLoop);
      };
      var stepKick = function () { stepMeasure(); if (!stepRaf) stepRaf = requestAnimationFrame(stepLoop); };
      window.addEventListener("scroll", stepKick, { passive: true });
      window.addEventListener("resize", stepKick);
      stepState.forEach(function (s) { if (s.fill) s.fill.style.transform = "translateY(-100%)"; });
      stepKick();
    }
  }

  /* ---------- Aviation: scroll-focus list rows, pinned horizontal strip ---------- */
  var avFocus = document.querySelectorAll("[data-av-focus] > li");
  if (avFocus.length && !reduceMotion) {
    var focusTick = false;
    var focusUpdate = function () {
      focusTick = false;
      var mid = window.innerHeight * 0.5;
      avFocus.forEach(function (li) {
        var r = li.getBoundingClientRect();
        var d = Math.abs(r.top + r.height / 2 - mid) / mid;
        li.style.setProperty("--f", Math.max(0.28, 1 - d * 0.8).toFixed(2));
      });
    };
    window.addEventListener("scroll", function () {
      if (!focusTick) { focusTick = true; requestAnimationFrame(focusUpdate); }
    }, { passive: true });
    focusUpdate();
  }
  if (window.gsap && window.ScrollTrigger && !reduceMotion) {
    gsap.registerPlugin(ScrollTrigger);
    gsap.matchMedia().add("(min-width: 1024px)", function () {
      document.querySelectorAll("[data-av-hscroll]").forEach(function (sec) {
        var track = sec.querySelector("[data-av-hscroll-track]");
        var bar = sec.querySelector("[data-av-hscroll-bar]");
        if (!track) return;
        var cards = Array.prototype.slice.call(track.querySelectorAll("[data-av-arc]"));
        var n = cards.length;
        var gap = 6;
        var state = { p: 0 };
        cards.forEach(function (el) {
          el.style.transformOrigin = "50% 50%";
          Array.prototype.forEach.call(el.querySelectorAll("[data-reveal]"), function (r) { r.classList.add("tt-revealed"); });
        });
        // Wavy flow: the row is one continuous ribbon. Each card takes the height of a travelling sine wave at its
        // left and right edges (so neighbours join up) and is skewed to the slope between them.
        var AMP = 50;
        var wave = function (x, ph) { return AMP * Math.sin((x / window.innerWidth) * 5.4 + ph); };
        var geom = function () {
          var vw = window.innerWidth;
          var cw = cards[0].offsetWidth;
          var step = cw + gap;
          // First card leads (right); the row starts with it at 55% of the screen and ends with the last three resting in view.
          return { vw: vw, cw: cw, step: step, start: vw * 0.55 - (n - 1) * step, end: vw * 0.2 };
        };
        var render = function () {
          var g = geom();
          var p = state.p;
          var enter = 1 - Math.pow(1 - Math.min(1, p / 0.14), 3); // cards rise from below the title first
          var shift = g.start + (g.end - g.start) * p;
          var ph = 0.6 + p * 6.2; // the wave itself flows as you scroll
          cards.forEach(function (el, i) {
            var x = shift + (n - 1 - i) * g.step;
            var yl = wave(x, ph);
            var yr = wave(x + g.cw, ph);
            var yc = 70 + (yl + yr) / 2 + (1 - enter) * 280;
            var skew = Math.atan((yr - yl) / g.cw) * 57.2958;
            var u = (x + g.cw / 2) / g.vw;
            var o = Math.max(0, Math.min(1, (u + 0.1) / 0.2)) * Math.max(0, Math.min(1, (1.1 - u) / 0.2)) * enter;
            el.style.transform = "translate3d(" + x.toFixed(1) + "px," + yc.toFixed(1) + "px,0) skewY(" + skew.toFixed(2) + "deg)";
            el.style.opacity = o.toFixed(3);
          });
          if (bar) bar.style.transform = "scaleX(" + p.toFixed(3) + ")";
        };
        var dist = function () { var g = geom(); return g.end - g.start; };
        gsap.to(state, {
          p: 1, ease: "none", onUpdate: render,
          scrollTrigger: {
            trigger: sec, start: "top top", end: function () { return "+=" + Math.round(dist() * 0.8); },
            pin: true, scrub: 0.5, invalidateOnRefresh: true, onRefresh: render
          }
        });
        render();
      });
      return function () {
        document.querySelectorAll("[data-av-arc]").forEach(function (el) { el.style.transform = ""; el.style.opacity = ""; el.style.transformOrigin = ""; });
      };
    });
  }

  /* ---------- Aviation: immersive sections. Each stacked sheet rises and settles as it enters; the one it covers recedes. ---------- */
  var immSheets = Array.prototype.slice.call(document.querySelectorAll(".tt-av-sheet")).filter(function (s) { return !s.hasAttribute("data-av-hscroll"); });
  if (immSheets.length && !reduceMotion) {
    immSheets.forEach(function (s) { s.classList.add("tt-av-imm"); });
    var immTick = false;
    var immUpdate = function () {
      immTick = false;
      var vh = window.innerHeight;
      immSheets.forEach(function (s) {
        var r = s.getBoundingClientRect();
        if (r.top > vh * 1.1 || r.bottom < -vh * 0.2) return;
        var p = Math.max(0, Math.min(1, (vh - r.top) / (vh * 0.55)));
        var e = 1 - Math.pow(1 - p, 3);
        s.style.transform = p < 1 ? "translate3d(0," + ((1 - e) * 90).toFixed(1) + "px,0) scale(" + (0.94 + 0.06 * e).toFixed(4) + ")" : "";
        var q = Math.max(0, Math.min(1, (vh * 0.6 - r.bottom) / (vh * 0.6)));
        s.classList.toggle("is-exit", q > 0);
        s.style.setProperty("--exit", q.toFixed(3));
      });
    };
    var immKick = function () { if (!immTick) { immTick = true; requestAnimationFrame(immUpdate); } };
    window.addEventListener("scroll", immKick, { passive: true });
    window.addEventListener("resize", immKick);
    immUpdate();
  }

  /* ---------- Aviation: highlighter wipe on section headings ---------- */
  var hls = document.querySelectorAll("[data-hl]");
  if (hls.length) {
    var hlCheck = function () {
      var vh = window.innerHeight;
      hls.forEach(function (h) { if (!h.classList.contains("is-in") && h.getBoundingClientRect().top < vh * 0.85) h.classList.add("is-in"); });
    };
    window.addEventListener("scroll", hlCheck, { passive: true });
    window.addEventListener("load", hlCheck);
    hlCheck();
  }

  /* ---------- Generic scroll-reveal: [data-reveal] fades/slides in ---------- */
  var revealEls = document.querySelectorAll("[data-reveal]");
  if (revealEls.length) {
    if (reduceMotion || !("IntersectionObserver" in window)) {
      revealEls.forEach(function (el) {
        el.classList.add("tt-revealed");
      });
    } else {
      var io = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add("tt-revealed");
              io.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.08, rootMargin: "0px 0px -6% 0px" }
      );
      revealEls.forEach(function (el) {
        io.observe(el);
      });
      // Safety net: force-reveal anything the viewport has already reached
      // once scrolling settles, in case IntersectionObserver misses a
      // fast-scroll case (mirrors the Next.js site's useInView hook).
      var settleTimer;
      window.addEventListener(
        "scroll",
        function () {
          clearTimeout(settleTimer);
          settleTimer = setTimeout(function () {
            revealEls.forEach(function (el) {
              if (el.classList.contains("tt-revealed")) return;
              var rect = el.getBoundingClientRect();
              if (rect.top < window.innerHeight && rect.bottom > 0) {
                el.classList.add("tt-revealed");
              }
            });
          }, 200);
        },
        { passive: true }
      );
    }
  }

  /* ---------- Count-up stats: [data-count-to] ---------- */
  var counters = document.querySelectorAll("[data-count-to]");
  if (counters.length && "IntersectionObserver" in window) {
    var countIo = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          countIo.unobserve(entry.target);
          var el = entry.target;
          var target = parseInt(el.getAttribute("data-count-to"), 10);
          var plain = el.getAttribute("data-plain") === "true";
          if (reduceMotion || isNaN(target)) {
            el.textContent = plain ? String(target) : target.toLocaleString();
            return;
          }
          var start = null;
          var duration = 1800;
          function frame(ts) {
            if (!start) start = ts;
            var progress = Math.min((ts - start) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var value = Math.floor(eased * target);
            el.textContent = plain ? String(value) : value.toLocaleString();
            if (progress < 1) requestAnimationFrame(frame);
          }
          requestAnimationFrame(frame);
        });
      },
      { threshold: 0.4 }
    );
    counters.forEach(function (el) {
      countIo.observe(el);
    });
  }

  /* ---------- "Why Tecknotrove" parallax image ---------- */
  var whyImg = document.getElementById("tt-why-parallax-img");
  if (whyImg && !reduceMotion) {
    var whySection = whyImg.closest("section");
    var onWhyScroll = function () {
      var rect = whySection.getBoundingClientRect();
      // progress 0 when section top is at viewport bottom, 1 when section
      // bottom is at viewport top (mirrors the GSAP scrub range).
      var total = rect.height + window.innerHeight;
      var scrolled = window.innerHeight - rect.top;
      var progress = Math.min(Math.max(scrolled / total, 0), 1);
      var scale = 1.25 - 0.25 * progress;
      var y = -6 + 12 * progress;
      whyImg.style.transform = "scale(" + scale.toFixed(3) + ") translateY(" + y.toFixed(2) + "%)";
    };
    window.addEventListener("scroll", onWhyScroll, { passive: true });
    onWhyScroll();
  }

  /* ---------- Sector card fan interaction ---------- */
  var sectorList = document.getElementById("tt-sector-list");
  if (sectorList && window.matchMedia("(min-width: 640px)").matches) {
    var cards = Array.prototype.slice.call(sectorList.querySelectorAll("[data-card]"));
    var faces = Array.prototype.slice.call(sectorList.querySelectorAll("[data-card-face]"));
    var count = cards.length;
    var active = 0;
    var dur = reduceMotion ? "0.25s" : "0.85s";
    var ease = reduceMotion ? "cubic-bezier(0.22,1,0.36,1)" : "cubic-bezier(0.34,1.56,0.64,1)";
    var jitter = 0; // cards rest straight (no random tilt/offset); hover motion is unchanged

    function rand(range) {
      return (Math.random() - 0.5) * range * jitter;
    }

    cards.forEach(function (card) {
      card.style.transition = "transform " + dur + " " + ease;
      card.style.transform =
        "translate(" + rand(6) + "%," + rand(6) + "%) rotate(" + rand(8) + "deg) scale(1)";
    });
    faces.forEach(function (face) {
      face.style.transition = "transform " + dur + " " + ease;
    });

    function activate(i) {
      cards[i].style.transform = "translate(0,0) rotate(0deg) scale(1.045)";
      faces.forEach(function (face, index) {
        face.style.transform = index === i ? "translateX(0)" : "translateX(" + 22 / (index - i) + "%)";
      });
    }
    function scatter(i) {
      cards[i].style.transform =
        "translate(" + rand(6) + "%," + rand(6) + "%) rotate(" + rand(10) + "deg) scale(1)";
    }

    sectorList.addEventListener("mousemove", function (e) {
      var rect = sectorList.getBoundingClientRect();
      var pct = (e.clientX - rect.left) / rect.width;
      var next = Math.ceil(pct * count);
      if (next !== active && next > 0 && next <= count) {
        if (active !== 0) scatter(active - 1);
        active = next;
        activate(active - 1);
      }
    });
    sectorList.addEventListener("mouseleave", function () {
      if (active > 0) scatter(active - 1);
      active = 0;
      faces.forEach(function (face) {
        face.style.transform = "translateX(0)";
      });
    });
  }


  /* ---------- Aviation key-features tabs ---------- */
  document.querySelectorAll("[data-av-tabs]").forEach(function (root) {
    var tabs = root.querySelectorAll("[data-av-tab]");
    var panels = root.querySelectorAll("[data-av-panel]");
    tabs.forEach(function (tab) {
      tab.addEventListener("click", function () {
        var n = tab.getAttribute("data-av-tab");
        tabs.forEach(function (t) { t.setAttribute("aria-selected", t === tab ? "true" : "false"); });
        panels.forEach(function (p) { p.hidden = p.getAttribute("data-av-panel") !== n; });
      });
    });
  });

  /* ---------- FAQ accordion ---------- */
  document.querySelectorAll(".tt-faq-item").forEach(function (item, i) {
    var btn = item.querySelector(".tt-faq-q");
    var panel = item.querySelector(".tt-faq-a");
    if (!btn || !panel) return;
    if (i === 0) {
      panel.style.gridTemplateRows = "1fr";
      btn.querySelector(".tt-faq-icon").style.transform = "rotate(45deg)";
    }
    btn.addEventListener("click", function () {
      var isOpen = panel.style.gridTemplateRows === "1fr";
      document.querySelectorAll(".tt-faq-a").forEach(function (p) {
        p.style.gridTemplateRows = "0fr";
      });
      document.querySelectorAll(".tt-faq-icon").forEach(function (ic) {
        ic.style.transform = "rotate(0deg)";
      });
      if (!isOpen) {
        panel.style.gridTemplateRows = "1fr";
        btn.querySelector(".tt-faq-icon").style.transform = "rotate(45deg)";
      }
    });
  });
})();
