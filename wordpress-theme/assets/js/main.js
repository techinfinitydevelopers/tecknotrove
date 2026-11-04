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

  /* ---------- Aviation navbar: mobile panel ---------- */
  var avToggle = document.getElementById("tt-av-toggle");
  var avPanel = document.getElementById("tt-av-panel");
  if (avToggle && avPanel) {
    avToggle.addEventListener("click", function () {
      var open = avPanel.classList.toggle("hidden") === false;
      avToggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
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
        var gap = 20;
        var state = { p: 0 };
        cards.forEach(function (el) {
          el.style.transformOrigin = "50% 50%";
          Array.prototype.forEach.call(el.querySelectorAll("[data-reveal]"), function (r) { r.classList.add("tt-revealed"); });
        });
        var smooth = function (a, b, x) { var t = Math.max(0, Math.min(1, (x - a) / (b - a))); return t * t * (3 - 2 * t); };
        // Height of the path at horizontal screen position u (0..1): low at the left edge, crest near 55%,
        // dipping again towards the right edge. Cards ride this curve and tilt along its tangent.
        var path = function (u) {
          var rise = 1 - smooth(-0.05, 0.55, u);
          var fall = smooth(0.72, 1.1, u);
          return rise * rise * 150 + fall * fall * 90;
        };
        var geom = function () {
          var vw = window.innerWidth;
          var cw = cards[0].offsetWidth;
          var step = cw + gap;
          // First card leads (right); the row starts with it at 55% of the screen and ends with the last three cards resting in view.
          return { vw: vw, cw: cw, step: step, start: vw * 0.55 - (n - 1) * step, end: vw * 0.2 };
        };
        var render = function () {
          var g = geom();
          var p = state.p;
          var enter = 1 - Math.pow(1 - Math.min(1, p / 0.14), 3); // cards rise from below the title first
          var shift = g.start + (g.end - g.start) * p;
          cards.forEach(function (el, i) {
            var x = shift + (n - 1 - i) * g.step;
            var u = (x + g.cw / 2) / g.vw;
            var y = path(u) + (1 - enter) * 280;
            var slope = (path(u + 0.01) - path(u - 0.01)) / (0.02 * g.vw);
            var ang = Math.atan(slope) * 57.2958 * 0.7;
            var o = Math.max(0, Math.min(1, (u + 0.1) / 0.2)) * Math.max(0, Math.min(1, (1.1 - u) / 0.2)) * enter;
            el.style.transform = "translate3d(" + x.toFixed(1) + "px," + y.toFixed(1) + "px,0) rotate(" + ang.toFixed(2) + "deg)";
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
        { threshold: 0.1 }
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
