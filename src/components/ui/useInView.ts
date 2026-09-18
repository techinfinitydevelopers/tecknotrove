"use client";

import { useEffect, useRef, useState } from "react";

export function useInView<T extends HTMLElement>(threshold = 0.1) {
  const ref = useRef<T>(null);
  const [inView, setInView] = useState(false);

  useEffect(() => {
    const el = ref.current;
    if (!el) return;

    const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduce) {
      setInView(true);
      return;
    }

    let revealed = false;
    const reveal = () => {
      if (!revealed) {
        revealed = true;
        setInView(true);
      }
    };

    const io = new IntersectionObserver(
      (entries) => {
        for (const entry of entries) {
          if (entry.isIntersecting) {
            reveal();
            io.unobserve(el);
          }
        }
      },
      { threshold, rootMargin: "600px 0px 600px 0px" }
    );
    io.observe(el);

    // Safety net: IntersectionObserver can miss an element entirely when a
    // fast/instant scroll (e.g. a hard scroll-flick, or a jump via anchor
    // link) never renders a frame where it intersects. Once scrolling
    // settles, force-reveal anything the viewport has already reached or
    // passed, so content can never get stuck permanently hidden.
    const checkSettled = () => {
      if (revealed) return;
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight) reveal();
    };

    let idleTimer: ReturnType<typeof setTimeout>;
    const onScroll = () => {
      clearTimeout(idleTimer);
      idleTimer = setTimeout(checkSettled, 150);
    };

    window.addEventListener("scroll", onScroll, { passive: true });
    checkSettled();

    return () => {
      io.disconnect();
      window.removeEventListener("scroll", onScroll);
      clearTimeout(idleTimer);
    };
  }, [threshold]);

  return { ref, inView };
}
