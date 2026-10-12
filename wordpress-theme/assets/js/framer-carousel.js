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
        var baseBg = props.background || "#0b1230";
        var current = -1;
        function render(index) {
          current = index;
          var c = colors[index];
          var p = Object.assign({}, props, { style: { width: "100%", height: "100%" } });
          if (c) {
            p.accent = mix(c, "#ffffff", 0.3); // lighter shade for button/progress so it reads on the tinted stage
            p.background = mix(baseBg, c, 0.55); // stage is mostly the sector colour
            node.style.background = p.background;
            var frame = node.parentElement;
            if (frame) {
              frame.style.transition = "box-shadow 0.6s ease, border-color 0.6s ease";
              frame.style.border = "3px solid " + c;
              frame.style.boxShadow = "0 18px 36px -28px " + c;
            }
          }
          reactRoot.render(React.createElement(Carousel, p));
        }
        render(Math.max(0, (props.startSlide || 1) - 1));
        // The component announces "N of M: title" in an aria-live region; follow it.
        new MutationObserver(function () {
          var live = node.querySelector("[aria-live]");
          var m = live && live.textContent.match(/^(\d+) of/);
          if (m && parseInt(m[1], 10) - 1 !== current) render(parseInt(m[1], 10) - 1);
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
