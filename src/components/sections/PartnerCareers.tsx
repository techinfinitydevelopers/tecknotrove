"use client";

import { Handshake, UsersThree, ArrowUpRight } from "@phosphor-icons/react";
import { FadeUp } from "@/components/ui/RevealText";

const TILES = [
  {
    tag: "Partnerships",
    title: "Partner With Us",
    desc: "Distribution, integration and technology partnerships.",
    cta: "Get in Touch",
    href: "#contact",
    icon: Handshake,
    gradient: "linear-gradient(135deg, var(--blue-brand), var(--blue-950))",
  },
  {
    tag: "Careers",
    title: "Join Our Team",
    desc: "Work on full-motion simulation systems, from motion platforms to visuals.",
    cta: "View Open Roles",
    href: "#careers",
    icon: UsersThree,
    gradient: "linear-gradient(135deg, #2a2c33, #0e0e11)",
  },
];

export default function PartnerCareers() {
  return (
    <section className="bg-bg-elevated pb-24 sm:pb-32">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="grid grid-cols-1 gap-5 md:grid-cols-2">
          {TILES.map((t, i) => {
            const Icon = t.icon;
            return (
              <FadeUp
                as="a"
                key={t.title}
                href={t.href}
                delay={i * 0.1}
                className="group relative flex min-h-[380px] flex-col justify-end overflow-hidden rounded-2xl p-8 text-white sm:min-h-[440px] sm:p-10"
                style={{ background: t.gradient }}
              >
                <div
                  className="pointer-events-none absolute inset-0 opacity-40 transition-transform duration-700 group-hover:scale-110"
                  style={{
                    backgroundImage:
                      "radial-gradient(circle at 85% 15%, rgba(255,255,255,0.22), transparent 55%)",
                  }}
                />
                <Icon
                  size={64}
                  weight="thin"
                  className="pointer-events-none absolute right-8 top-8 text-white/15 sm:size-20"
                />
                <div className="relative z-10">
                  <span className="mono-label mb-4 inline-block text-[10.5px] text-orange-300">
                    {t.tag}
                  </span>
                  <h3 className="text-3xl font-black tracking-tight sm:text-4xl">
                    {t.title}
                  </h3>
                  <p className="mt-3 max-w-sm text-sm text-white/65">{t.desc}</p>
                  <span className="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-white transition-colors group-hover:text-orange-300">
                    {t.cta}
                    <ArrowUpRight
                      size={16}
                      className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                    />
                  </span>
                </div>
              </FadeUp>
            );
          })}
        </div>
      </div>
    </section>
  );
}
