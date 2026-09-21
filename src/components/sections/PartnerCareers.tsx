"use client";

import { Handshake, UsersThree, ArrowUpRight } from "@phosphor-icons/react";
import { FadeUp, RevealLines } from "@/components/ui/RevealText";
import MagneticButton from "@/components/ui/MagneticButton";

const TILES = [
  {
    index: "01",
    tag: "Partnerships",
    title: "Partner With Us",
    desc: "Distribution, integration and technology partnerships across our global network.",
    stat: { value: "35+", label: "Countries" },
    cta: "Get in Touch",
    href: "#contact",
    icon: Handshake,
    accent: "var(--orange)",
    gradient: "linear-gradient(160deg, var(--blue-brand) 0%, var(--blue-950) 100%)",
    sweep: "blue" as const,
  },
  {
    index: "02",
    tag: "Careers",
    title: "Join Our Team",
    desc: "Work on full-motion simulation systems, from motion platforms to visuals.",
    stat: { value: "20+", label: "Years running" },
    cta: "View Open Roles",
    href: "#careers",
    icon: UsersThree,
    accent: "#ffffff",
    gradient: "linear-gradient(160deg, #24262d 0%, #0a0a0c 100%)",
    sweep: "orange" as const,
  },
];

export default function PartnerCareers() {
  return (
    <section className="bg-bg-elevated pb-24 sm:pb-32">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <p className="mono-label mb-5 text-[11px] text-blue-500">
          Work With Tecknotrove
        </p>
        <RevealLines
          as="h2"
          lines={["Build the next simulator", "with us."]}
          className="max-w-2xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl"
        />

        <div className="mt-14 grid grid-cols-1 gap-5 md:grid-cols-2">
          {TILES.map((t, i) => {
            const Icon = t.icon;
            return (
              <FadeUp
                key={t.title}
                delay={i * 0.1}
                className="group relative flex min-h-[400px] flex-col overflow-hidden rounded-2xl p-8 text-white sm:min-h-[460px] sm:p-10"
                style={{ background: t.gradient }}
              >
                {/* top accent bar, grows on hover */}
                <div
                  className="absolute inset-x-0 top-0 h-[3px] origin-left scale-x-0 transition-transform duration-500 ease-[cubic-bezier(0.65,0,0.35,1)] group-hover:scale-x-100"
                  style={{ background: t.accent }}
                />

                {/* dot-grid texture, brightens + drifts on hover */}
                <div
                  className="pointer-events-none absolute inset-0 opacity-[0.15] transition-[opacity,transform] duration-700 group-hover:scale-105 group-hover:opacity-25"
                  style={{
                    backgroundImage:
                      "radial-gradient(rgba(255,255,255,0.9) 1px, transparent 1px)",
                    backgroundSize: "22px 22px",
                    maskImage:
                      "radial-gradient(ellipse 70% 60% at 80% 10%, black 0%, transparent 75%)",
                  }}
                />

                <div className="relative z-10 flex items-start justify-between">
                  <span className="font-mono text-sm text-white/35">{t.index}</span>
                  <Icon
                    size={40}
                    weight="light"
                    className="text-white/50 transition-transform duration-500 group-hover:-translate-y-1 group-hover:rotate-6"
                  />
                </div>

                <div className="relative z-10 mt-auto">
                  <span className="mono-label mb-4 inline-block text-[10.5px] text-orange-300">
                    {t.tag}
                  </span>
                  <h3 className="text-3xl font-black tracking-tight sm:text-4xl">
                    {t.title}
                  </h3>
                  <p className="mt-3 max-w-sm text-sm text-white/65">{t.desc}</p>

                  <div className="mt-7 flex flex-wrap items-end justify-between gap-6 border-t border-white/10 pt-6">
                    <div>
                      <p className="font-mono text-2xl font-medium text-white">
                        {t.stat.value}
                      </p>
                      <p className="mt-0.5 text-xs text-white/50">{t.stat.label}</p>
                    </div>
                    <MagneticButton
                      href={t.href}
                      variant="outline-light"
                      sweep={t.sweep}
                      className="px-5 py-2.5 text-xs"
                    >
                      {t.cta}
                      <ArrowUpRight size={14} />
                    </MagneticButton>
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
