"use client";

import { useEffect, useRef } from "react";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import {
  ArrowUpRight,
  GlobeHemisphereWest,
  Wrench,
  CalendarBlank,
  Headset,
} from "@phosphor-icons/react";
import MagneticButton from "@/components/ui/MagneticButton";

gsap.registerPlugin(ScrollTrigger);

const STATS = [
  { value: 35, suffix: "+", label: "Countries served", icon: GlobeHemisphereWest },
  { value: 1500, suffix: "+", label: "Simulators delivered", icon: Wrench },
  { value: 2002, suffix: "", label: "Established", plain: true, icon: CalendarBlank },
  { value: 24, suffix: "×7", label: "Technical support", icon: Headset },
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
    <section className="relative overflow-hidden border-y border-line bg-bg-cream py-10 sm:py-12">
      <div
        className="pointer-events-none absolute inset-0 opacity-[0.35]"
        style={{
          backgroundImage:
            "linear-gradient(rgba(23,8,0,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(23,8,0,0.06) 1px, transparent 1px)",
          backgroundSize: "56px 56px",
          maskImage: "linear-gradient(to right, black, transparent 85%)",
        }}
      />

      <div
        ref={ref}
        className="relative mx-auto flex max-w-[1400px] flex-col gap-8 px-5 sm:px-8 md:flex-row md:items-center md:justify-between md:gap-10"
      >
        <div className="grid grid-cols-2 gap-x-6 gap-y-9 md:max-w-[1020px] md:flex-1 md:grid-cols-4 md:gap-x-0">
          {STATS.map((s, i) => {
            const Icon = s.icon;
            return (
              <div
                key={s.label}
                className={`flex flex-col ${
                  i > 0 ? "md:border-l md:border-line-strong/70 md:pl-8" : ""
                }`}
              >
                <Icon size={20} weight="duotone" className="mb-3 text-orange-400" />
                <div className="font-mono text-4xl font-medium tabular-nums text-ink sm:text-5xl">
                  <span data-stat={s.value} data-plain={s.plain ? "true" : "false"}>
                    0
                  </span>
                  <span className="text-orange-400">{s.suffix}</span>
                </div>
                <p className="mt-2 text-sm text-ink-dim">{s.label}</p>
              </div>
            );
          })}
        </div>
        <MagneticButton
          href="#why"
          variant="outline"
          sweep="dark"
          className="shrink-0 self-start px-5 py-2.5 text-xs md:self-auto"
        >
          Know more
          <ArrowUpRight size={14} />
        </MagneticButton>
      </div>
    </section>
  );
}
