"use client";

import { FadeUp, RevealLines } from "@/components/ui/RevealText";
import type { Sector } from "@/data/sectors";

export default function SectorApplications({ sector }: { sector: Sector }) {
  return (
    <section className="bg-bg py-20 sm:py-28">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="grid grid-cols-1 gap-10 lg:grid-cols-[1fr_1fr] lg:gap-16">
          <div>
            <p className="mono-label mb-5 text-[11px]" style={{ color: sector.accent }}>
              {sector.applicationsLabel}
            </p>
            <RevealLines
              as="h2"
              lines={[sector.applicationsHeading]}
              className="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl"
            />
            <p className="mt-6 max-w-md text-base text-ink-dim">
              {sector.applicationsBody}
            </p>
          </div>

          <div className="grid grid-cols-2 gap-3 sm:grid-cols-2">
            {sector.applications.map((a, i) => (
              <FadeUp
                key={a}
                delay={i * 0.04}
                className="rounded-xl border border-line bg-bg-elevated px-5 py-4 text-sm font-semibold text-ink"
              >
                {a}
              </FadeUp>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
