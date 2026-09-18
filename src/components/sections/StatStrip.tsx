"use client";

import { useEffect, useRef } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ArrowUpRight } from "@phosphor-icons/react";

gsap.registerPlugin(ScrollTrigger);

const STATS = [
  { value: 35, suffix: "+", label: "Countries served" },
  { value: 1500, suffix: "+", label: "Simulators delivered" },
  { value: 2002, suffix: "", label: "Established", plain: true },
  { value: 24, suffix: "×7", label: "Technical support" },
];

export default function StatStrip() {
  const ref = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const el = ref.current;
    if (!el) return;

    const nodes = el.querySelectorAll<HTMLSpanElement>("[data-stat]");

    const ctx = gsap.context(() => {
      nodes.forEach((node) => {
        const target = Number(node.dataset.stat);
        const plain = node.dataset.plain === "true";
        const format = (n: number) => (plain ? String(n) : n.toLocaleString());
        if (reduce) {
          node.textContent = format(target);
          return;
        }
        const obj = { v: 0 };
        gsap.to(obj, {
          v: target,
          duration: 1.8,
          ease: "power2.out",
          scrollTrigger: {
            trigger: el,
            start: "top 80%",
            once: true,
          },
          onUpdate: () => {
            node.textContent = format(Math.floor(obj.v));
          },
        });
      });
    }, ref);

    return () => ctx.revert();
  }, []);

  return (
    <section className="border-y border-line bg-bg-cream py-8 sm:py-10">
      <div
        ref={ref}
        className="mx-auto flex max-w-[1400px] flex-col gap-6 px-5 sm:px-8 md:flex-row md:items-center md:justify-between md:gap-10"
      >
        <div className="grid grid-cols-2 gap-y-8 md:max-w-[980px] md:flex-1 md:grid-cols-4 md:gap-x-10">
          {STATS.map((s) => (
            <div key={s.label} className="flex flex-col">
              <div className="font-mono text-4xl font-medium tabular-nums text-ink sm:text-5xl">
                <span data-stat={s.value} data-plain={s.plain ? "true" : "false"}>
                  0
                </span>
                <span className="text-orange-400">{s.suffix}</span>
              </div>
              <p className="mt-2 text-sm text-ink-dim">{s.label}</p>
            </div>
          ))}
        </div>
        <a
          href="#why"
          className="group inline-flex shrink-0 items-center gap-2 text-sm font-semibold text-ink-dim transition-colors hover:text-orange-400"
        >
          Know more
          <ArrowUpRight
            size={16}
            className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
          />
        </a>
      </div>
    </section>
  );
}
