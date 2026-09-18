"use client";

import {
  LinkedinLogo,
  ArrowUpRight,
  ShieldChevron,
  Confetti,
} from "@phosphor-icons/react";
import { FadeUp } from "@/components/ui/RevealText";
import MagneticButton from "@/components/ui/MagneticButton";

const HASHTAGS = ["#Tecknotrove", "#SimulationTechnology", "#MakeInIndia"];

const POSTS = [
  {
    tag: "Defence",
    text: "Another Tank Driving Simulator handed over to a mechanised infantry unit.",
    meta: "4 days ago · 312 reactions",
    icon: ShieldChevron,
    plate: "#1b2b63",
    tint: "var(--blue-brand)",
    tintOpacity: 0.55,
    // back card: tilted left, drifts further left and straightens on hover
    place:
      "z-10 sm:left-0 sm:top-[2%] sm:-rotate-6 sm:group-hover:-translate-x-6 sm:group-hover:-translate-y-2 sm:group-hover:-rotate-2",
  },
  {
    tag: "Events",
    text: "Our stand at DefExpo drew steady footfall all four days.",
    meta: "9 days ago · 187 reactions",
    icon: Confetti,
    plate: "#7a2200",
    tint: "var(--orange)",
    tintOpacity: 0.6,
    // front card: tilted right, drifts right and straightens on hover
    place:
      "z-20 sm:left-[22%] sm:top-[15%] sm:rotate-3 sm:group-hover:translate-x-6 sm:group-hover:translate-y-2 sm:group-hover:rotate-2",
  },
];

export default function LinkedInSection() {
  return (
    <section className="bg-bg py-24 sm:py-32">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="grid grid-cols-1 items-center gap-14 lg:grid-cols-2 lg:gap-12">
          {/* account details */}
          <FadeUp>
            <p className="mono-label mb-5 text-[11px] text-blue-500">
              Latest from LinkedIn
            </p>
            <h2 className="max-w-xl text-4xl font-black leading-[1.08] tracking-tight sm:text-5xl">
              Join 12,400+ professionals following Tecknotrove.
            </h2>

            <div className="mt-10 flex items-center gap-4">
              <div className="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-brand text-white">
                <LinkedinLogo size={32} weight="fill" />
              </div>
              <div>
                <p className="text-lg font-bold text-ink">Tecknotrove Systems</p>
                <p className="text-sm text-ink-dim">
                  Simulation &amp; training technology
                </p>
              </div>
            </div>

            <div className="mt-8 flex gap-14 border-y border-line py-6">
              <div>
                <p className="font-mono text-4xl font-medium text-ink">12,400+</p>
                <p className="mt-1 text-sm text-ink-dim">Followers</p>
              </div>
              <div>
                <p className="font-mono text-4xl font-medium text-ink">35+</p>
                <p className="mt-1 text-sm text-ink-dim">Countries reached</p>
              </div>
            </div>

            <div className="mt-8 flex flex-wrap gap-3">
              {HASHTAGS.map((h) => (
                <span
                  key={h}
                  className="rounded-full border border-line-strong px-4 py-2 text-sm font-medium text-ink-dim"
                >
                  {h}
                </span>
              ))}
            </div>

            <div className="mt-10 flex flex-wrap items-center gap-6">
              <MagneticButton
                href="https://linkedin.com"
                target="_blank"
                variant="dark"
              >
                Follow Tecknotrove
              </MagneticButton>
              <a
                href="#linkedin"
                className="group inline-flex items-center gap-2 text-base font-semibold text-ink-dim transition-colors hover:text-orange-400"
              >
                View all posts
                <ArrowUpRight
                  size={18}
                  className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                />
              </a>
            </div>
          </FadeUp>

          {/* stacked polaroid posts */}
          <FadeUp delay={0.12}>
            <div className="group relative flex flex-col items-center gap-6 sm:block sm:h-[540px]">
              {POSTS.map((p) => {
                const Icon = p.icon;
                return (
                  <a
                    key={p.tag}
                    href="#linkedin"
                    className={`relative w-full max-w-[340px] rounded-[3px] bg-white p-[13px] pb-[52px] shadow-[0_12px_28px_-8px_rgba(15,18,30,0.28)] transition-[transform,box-shadow,scale] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] hover:z-30 hover:scale-[1.05] hover:shadow-[0_26px_55px_-12px_rgba(15,18,30,0.45)] sm:absolute sm:w-[78%] sm:max-w-[440px] ${p.place}`}
                  >
                    <div
                      className="relative overflow-hidden rounded-[2px]"
                      style={{ background: p.plate, aspectRatio: "4 / 3" }}
                    >
                      <div
                        className="absolute inset-0"
                        style={{ background: p.tint, opacity: p.tintOpacity }}
                      />
                      <div className="absolute inset-0 opacity-[0.16] mix-blend-overlay [background-image:radial-gradient(circle,white_1px,transparent_1px)] [background-size:4px_4px]" />
                      <span className="mono-label absolute left-3 top-3 rounded-full bg-black/30 px-2.5 py-1 text-[9px] text-white">
                        {p.tag}
                      </span>
                      <Icon
                        weight="fill"
                        className="absolute -bottom-2 -right-2 h-16 w-16 text-white/55"
                      />
                    </div>
                    <p className="mt-3.5 px-0.5 text-[13.5px] leading-relaxed text-ink">
                      {p.text}
                    </p>
                    <p className="mt-2 px-0.5 text-[11px] text-ink-faint">
                      {p.meta}
                    </p>
                  </a>
                );
              })}
            </div>
          </FadeUp>
        </div>
      </div>
    </section>
  );
}
