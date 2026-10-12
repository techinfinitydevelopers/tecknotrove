/* Navbar: on scroll the centre dip rises into the bar and the bar becomes a flat strip;
   scrolling back to the top lets the dip drop back down. Driven by the .tt-nav-scrolled
   class that main.js toggles. */
(function () {
  var nav = document.getElementById("tt-nav");
  if (!nav || !window.gsap) return;
  var center = nav.querySelector(".tt-nav-center");
  var path = center && center.querySelector("path");
  var links = center && center.querySelector(":scope > div");
  if (!path) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  // Same command structure, so the numbers can be interpolated one by one.
  var DIP = path.getAttribute("d");
  var FLAT = "M0 0H680V50C648 50 636 50 628 50C622 50 614 50 596 50H84C66 50 58 50 52 50C44 50 32 50 0 50Z";
  var num = /-?\d*\.?\d+/g;
  var a = DIP.match(num).map(Number);
  var b = FLAT.match(num).map(Number);
  var tpl = DIP.split(num);

  function build(p) {
    var out = tpl[0];
    for (var i = 0; i < a.length; i++) {
      out += (a[i] + (b[i] - a[i]) * p).toFixed(2) + tpl[i + 1];
    }
    return out;
  }

  var LINK_RISE = 35; // px the links climb so they sit in the flat bar
  var state = { p: 0 };
  var tween;

  function apply() {
    path.setAttribute("d", build(state.p));
    if (links) links.style.transform = "translateY(" + (-LINK_RISE * state.p).toFixed(2) + "px)";
  }

  function go(target) {
    if (tween) tween.kill();
    tween = gsap.to(state, { p: target, duration: 0.6, ease: "expo.out", onUpdate: apply });
  }

  var last = nav.classList.contains("tt-nav-scrolled");
  if (last) { state.p = 1; apply(); }
  new MutationObserver(function () {
    var now = nav.classList.contains("tt-nav-scrolled");
    if (now !== last) { last = now; go(now ? 1 : 0); }
  }).observe(nav, { attributes: true, attributeFilter: ["class"] });
})();
