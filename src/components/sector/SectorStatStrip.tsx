"use client";

import type { Sector } from "@/data/sectors";

export default function SectorStatStrip({ sector }: { sector: Sector }) {
  return (
    <section className="border-b border-line bg-bg-elevated py-8 sm:py-10">
      <div className="mx-auto grid max-w-[1400px] grid-cols-2 gap-x-6 gap-y-8 px-5 sm:px-8 md:grid-cols-4">
        {sector.stats.map((s, i) => (
          <div
            key={s.label}
            className={`flex flex-col items-center text-center ${
              i > 0 ? "md:border-l md:border-line-strong/70" : ""
            }`}
          >
            <p
              className="font-mono text-3xl font-medium tabular-nums sm:text-4xl"
              style={{ color: sector.accent }}
            >
              {s.value}
            </p>
            <p className="mt-1.5 text-sm text-ink-dim">{s.label}</p>
          </div>
        ))}
      </div>
    </section>
  );
}
