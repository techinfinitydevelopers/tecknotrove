/* GSAP text animation, replayed every time its section scrolls into view.
   [data-split-title]  typewriter: characters appear one by one with a caret
   [data-split-lines]  lines slide up through a mask
   [data-anim-up]      fade / slide up
   Content stays visible if GSAP fails to load or motion is reduced. */
(function () {
  if (!window.gsap || !window.SplitText || !window.ScrollTrigger) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  gsap.registerPlugin(SplitText, ScrollTrigger);

  var ease = "expo.out";
  var CHAR_TIME = 0.045; // seconds per typed character

  // Play `tl` whenever the element's section enters (from either side);
  // rewind it when the section is fully left, so it replays next visit.
  function replayOnView(el, tl, reset) {
    var section = el.closest("section") || el;
    tl.pause(0);
    ScrollTrigger.create({
      trigger: section,
      start: "top 75%",
      end: "bottom 25%",
      onEnter: function () { tl.restart(); },
      onEnterBack: function () { tl.restart(); },
      onLeave: reset,
      onLeaveBack: reset
    });
  }

  document.querySelectorAll("[data-split-title]").forEach(function (el) {
    var timeline, bound = false;
    SplitText.create(el, {
      type: "words,chars",
      autoSplit: true,
      onSplit: function (self) {
        var chars = self.chars;
        var n = chars.length;
        var state = { i: 0 };
        var caretAt = -1;

        function paint() {
          var upto = Math.floor(state.i);
          for (var k = 0; k < n; k++) {
            chars[k].style.visibility = k < upto ? "visible" : "hidden";
          }
          var want = upto > 0 ? upto - 1 : -1;
          if (want !== caretAt) {
            if (caretAt >= 0 && chars[caretAt]) chars[caretAt].classList.remove("tt-caret");
            if (want >= 0) chars[want].classList.add("tt-caret");
            caretAt = want;
          }
        }
        function clearCaret() {
          if (caretAt >= 0 && chars[caretAt]) chars[caretAt].classList.remove("tt-caret");
          caretAt = -1;
        }
        function reset() {
          if (timeline) timeline.pause(0);
          state.i = 0;
          paint();
          clearCaret();
        }

        if (timeline) timeline.kill();
        timeline = gsap.timeline();
        timeline.to(state, {
          i: n,
          duration: n * CHAR_TIME,
          ease: "none",
          onUpdate: paint
        });
        // keep the caret blinking briefly, then remove it
        timeline.to({}, { duration: 1.6, onComplete: clearCaret });

        reset();
        if (!bound) {
          bound = true;
          replayOnView(el, timeline, reset);
        }
      }
    });
  });

  document.querySelectorAll("[data-split-lines]").forEach(function (el) {
    SplitText.create(el, {
      type: "lines",
      mask: "lines",
      autoSplit: true,
      onSplit: function (self) {
        var tl = gsap.timeline({ delay: 0.5 });
        tl.from(self.lines, { yPercent: 105, opacity: 0, duration: 0.95, ease: ease, stagger: 0.09 });
        replayOnView(el, tl, function () { tl.pause(0); });
        return tl;
      }
    });
  });

  document.querySelectorAll("[data-anim-up]").forEach(function (el) {
    var tl = gsap.timeline({ delay: 0.9 });
    tl.from(el, { y: 24, opacity: 0, duration: 0.9, ease: ease });
    replayOnView(el, tl, function () { tl.pause(0); });
  });
})();
