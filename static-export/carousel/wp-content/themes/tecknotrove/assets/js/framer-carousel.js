/* Mounts the Framer "Modern Carousel" component into [data-tt-framer] elements.
   React, framer-motion and the stubbed "framer" package are resolved by the
   import map printed by inc/elementor/framer-carousel.php. */
(function () {
  var MODULE = "https://framerusercontent.com/modules/pcnq3QXMJohBxqEnBMZh/FrYhMfahqOvzaRJTI4Hb/Modern_Carousel.js";
  var loading;

  function load() {
    if (!loading) {
      loading = Promise.all([import("react"), import("react-dom/client"), import(MODULE)]);
    }
    return loading;
  }

  // Mix two #rrggbb colours (t = share of b).
  function mix(a, b, t) {
    function p(h) { h = h.replace("#", ""); if (h.length === 3) h = h.replace(/(.)/g, "$1$1"); return [0, 2, 4].map(function (i) { return parseInt(h.substr(i, 2), 16); }); }
    var x = p(a), y = p(b);
    return "#" + x.map(function (v, i) { return ("0" + Math.round(v * (1 - t) + y[i] * t).toString(16)).slice(-2); }).join("");
  }

  function mount(root) {
    var nodes = (root || document).querySelectorAll("[data-tt-framer]:not([data-tt-mounted])");
    if (!nodes.length) return;
    load().then(function (libs) {
      var React = libs[0].default || libs[0];
      var createRoot = libs[1].createRoot;
      var Carousel = libs[2].default;
      nodes.forEach(function (node) {
        if (node.getAttribute("data-tt-mounted")) return;
        var props;
        try { props = JSON.parse(node.getAttribute("data-props") || "{}"); } catch (e) { props = {}; }
        node.setAttribute("data-tt-mounted", "1");
        node.innerHTML = "";
        var reactRoot = createRoot(node);
        var colors = props.colors || [];
        var logos = props.logos || [];
        var baseBg = props.background || "#0b1230";
        var current = -1;
        function paint() {
          // Give every slide its sector colour (CSS in input.css turns it into the card look).
          node.querySelectorAll('[aria-roledescription="slide"]').forEach(function (el, i) {
            if (colors[i]) el.style.setProperty("--sector", colors[i]);
            if (logos[i]) el.style.setProperty("--logo", 'url("' + logos[i] + '")');
          });
        }
        function render(index) {
          current = index;
          var c = colors[index];
          var p = Object.assign({}, props, { style: { width: node.clientWidth || 1200, height: "100%" } });
          if (c) p.accent = c; // button, progress and dots in the active sector colour
          node.style.background = "transparent";
          reactRoot.render(React.createElement(Carousel, p));
          paint();
          setTimeout(paint, 60);
        }
        render(Math.max(0, (props.startSlide || 1) - 1));
        // The component lays itself out from the width it is given; keep it in step with the container.
        var lastW = node.clientWidth;
        if (window.ResizeObserver) {
          new ResizeObserver(function () {
            if (node.clientWidth && Math.abs(node.clientWidth - lastW) > 2) { lastW = node.clientWidth; render(Math.max(0, current)); }
          }).observe(node);
        }
        // Hover a collapsed strip to open it (same as clicking it). A short intent delay and a
        // lock during the transition stop the strips from ping-ponging as they resize under the cursor.
        var hoverTimer = null;
        var lockUntil = 0;
        var canHover = window.matchMedia && window.matchMedia("(hover: hover)").matches;
        if (canHover) {
          node.addEventListener("mouseover", function (e) {
            var slide = e.target.closest && e.target.closest('[role="group"][aria-roledescription="slide"]');
            if (!slide) return;
            var show = slide.querySelector('button[aria-label^="Show "]');
            if (!show) return; // already the open slide
            clearTimeout(hoverTimer);
            var wait = Math.max(90, lockUntil - Date.now());
            hoverTimer = setTimeout(function () {
              if (slide.matches(":hover") && slide.querySelector('button[aria-label^="Show "]')) {
                lockUntil = Date.now() + 750;
                show.click();
              }
            }, wait);
          });
          node.addEventListener("mouseleave", function () { clearTimeout(hoverTimer); });
        }
        // The component announces "N of M: title" in an aria-live region; follow it.
        new MutationObserver(function () {
          var live = node.querySelector("[aria-live]");
          var m = live && live.textContent.match(/^(\d+) of/);
          if (m && parseInt(m[1], 10) - 1 !== current) render(parseInt(m[1], 10) - 1);
          else paint();
        }).observe(node, { subtree: true, childList: true, characterData: true });
      });
    }).catch(function (err) {
      if (window.console) console.error("Framer carousel failed to load", err);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", function () { mount(document); });
  } else {
    mount(document);
  }

  // Elementor editor: widgets are re-rendered live.
  window.addEventListener("elementor/frontend/init", function () {
    if (!window.elementorFrontend) return;
    elementorFrontend.hooks.addAction("frontend/element_ready/tt_framer_carousel.default", function ($el) {
      mount($el && $el[0] ? $el[0] : document);
    });
  });
})();
