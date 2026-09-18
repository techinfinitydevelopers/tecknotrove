"use client";

import Image from "next/image";
import { ArrowUpRight } from "@phosphor-icons/react";
import { RevealLines, FadeUp } from "@/components/ui/RevealText";

// Folder-tab panel, measured off the reference and drawn as a path so the
// step reads as one continuous S-ramp. Two elliptical arcs meet directly at
// y=120 with no straight vertical between them — that straight segment is what
// made an earlier border-radius version look like a blocky step.
// Card is aspect-[4/5], so this viewBox scales with preserveAspectRatio="none"
// without distorting.
const BODY_TOP = 28; // % of card height, where the number sits
const PANEL_PATH = [
  "M0,116",
  "A16,16 0 0 1 16,100", // outer top-left corner of the raised tab
  "L146,100", // tab top edge
  "Q154,100 159,109", // ease into the slant
  "L177,131", // the slant itself — a straight diagonal, ~50 degrees
  "Q182,140 190,140", // ease back out onto the body edge
  "L384,140", // body top edge
  "A16,16 0 0 1 400,156", // outer top-right corner
  "L400,500",
  "L0,500",
  "Z",
].join(" ");
// Panel drops 22% of card height on hover — kept as a literal Tailwind class
// (group-hover:translate-y-[22%]) so the utility is generated at build time.

const ARTICLES = [
  {
    title: "Tank Driving Simulator delivered to the Indian Army",
    meta: "12 Aug 2025 · 4 min read",
    image: "/images/news-army.jpg",
    dark: true,
    frame: "#0a1440",
    surface: "#101c52",
  },
  {
    title: "What we showcased and signed at DefExpo 2025",
    meta: "02 Jun 2025 · 3 min read",
    image: "/images/news-expo.jpg",
    dark: false,
    frame: "#d5dae4",
    surface: "#eef0f5",
  },
  {
    title: "Why 6-DOF matters for full-motion training",
    meta: "21 Apr 2025 · 6 min read",
    image: "/images/news-motion.jpg",
    dark: true,
    frame: "#08080a",
    surface: "#141417",
  },
];

export default function NewsInsights() {
  return (
    <section className="border-t border-line bg-bg-elevated py-24 sm:py-32">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <p className="mono-label mb-5 text-[11px] text-blue-500">Media</p>
        <div className="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
          <RevealLines
            as="h2"
            lines={["Latest News & Insights"]}
            className="text-3xl font-black tracking-tight sm:text-5xl"
          />
          <a
            href="#news"
            className="group hidden shrink-0 items-center gap-2 text-sm font-semibold text-ink-dim transition-colors hover:text-orange-400 sm:flex"
          >
            View all
            <ArrowUpRight
              size={16}
              className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
            />
          </a>
        </div>

        <div className="mt-12 grid grid-cols-1 gap-6 sm:grid-cols-3">
          {ARTICLES.map((a, i) => {
            const titleColor = a.dark ? "#ffffff" : "#14161c";
            const bodyColor = a.dark
              ? "rgba(255,255,255,0.62)"
              : "rgba(20,22,28,0.62)";
            const arrowColor = a.dark
              ? "rgba(255,255,255,0.8)"
              : "rgba(20,22,28,0.7)";

            return (
              <FadeUp
                key={a.title}
                as="a"
                href="#news"
                delay={i * 0.08}
                className="group relative block aspect-[4/5] rounded-[30px] p-[7px] shadow-[0_22px_48px_-26px_rgba(15,18,30,0.5)] transition-transform duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] hover:-translate-y-1.5"
                style={{ background: a.frame }}
              >
                <div
                  className="relative h-full w-full overflow-hidden rounded-[24px]"
                  style={{ background: a.surface }}
                >
                  {/* brochure photo, revealed as the panel slides away */}
                  <Image
                    src={a.image}
                    alt=""
                    fill
                    sizes="(max-width: 640px) 100vw, 33vw"
                    className="object-cover transition-transform duration-[650ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-[1.05]"
                  />

                  {/* sliding folder panel */}
                  <div
                    className="absolute inset-0 transition-transform duration-[650ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:translate-y-[22%]"
                  >
                    <svg
                      viewBox="0 0 400 500"
                      preserveAspectRatio="none"
                      aria-hidden="true"
                      className="absolute inset-0 h-full w-full"
                    >
                      <path d={PANEL_PATH} fill={a.surface} />
                    </svg>
                    {/* number + arrow ride down with the panel */}
                    <div
                      className="absolute inset-x-0 flex items-center justify-between px-7 pt-3.5"
                      style={{ top: `${BODY_TOP}%` }}
                    >
                      <span
                        className="text-5xl font-medium leading-none tracking-tight"
                        style={{ color: titleColor }}
                      >
                        {String(i + 1).padStart(2, "0")}
                      </span>
                      <ArrowUpRight
                        size={22}
                        style={{ color: arrowColor }}
                        className="transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5"
                      />
                    </div>
                  </div>

                  {/* copy pinned to the bottom */}
                  <div className="absolute inset-x-0 bottom-0 z-10 px-7 pb-7">
                    <h3
                      className="text-[15px] font-bold leading-snug"
                      style={{ color: titleColor }}
                    >
                      {a.title}
                    </h3>
                    <p
                      className="mt-1.5 text-[13px] leading-relaxed"
                      style={{ color: bodyColor }}
                    >
                      {a.meta}
                    </p>
                  </div>
                </div>
              </FadeUp>
            );
          })}
        </div>
      </div>
    </section>
  );
}
