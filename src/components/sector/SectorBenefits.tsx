"use client";

import { ShieldCheck, Lightning, ChartLineUp, Coins } from "@phosphor-icons/react";
import { RevealLines, FadeUp } from "@/components/ui/RevealText";
import type { Sector } from "@/data/sectors";

const ICONS = [ShieldCheck, Lightning, ChartLineUp, Coins];

export default function SectorBenefits({ sector }: { sector: Sector }) {
  return (
    <section className="bg-bg py-20 sm:py-28">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <p className="mono-label mb-5 text-[11px]" style={{ color: sector.accent }}>
          01 / Benefits of Simulation
        </p>
        <RevealLines
          as="h2"
          lines={["Better training.", "Better outcomes."]}
          className="max-w-xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl"
        />

        <div className="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
          {sector.benefits.map((b, i) => {
            const Icon = ICONS[i % ICONS.length];
            return (
              <FadeUp
                key={b.title}
                delay={i * 0.08}
                className="rounded-2xl border border-line bg-bg-elevated p-6"
              >
                <div
                  className="flex h-11 w-11 items-center justify-center rounded-full"
                  style={{ background: sector.accentSoft, color: sector.accent }}
                >
                  <Icon size={20} weight="duotone" />
                </div>
                <h3 className="mt-5 text-lg font-bold">{b.title}</h3>
                <p className="mt-2 text-sm text-ink-dim">{b.desc}</p>
              </FadeUp>
            );
          })}
        </div>
      </div>
    </section>
  );
}
