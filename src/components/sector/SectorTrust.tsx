"use client";

import { RevealLines, FadeUp } from "@/components/ui/RevealText";
import type { Sector } from "@/data/sectors";

export default function SectorTrust({ sector }: { sector: Sector }) {
  if (!sector.trust) return null;
  const { heading, body, stats } = sector.trust;

  return (
    <section className="bg-blue-950 py-20 text-white sm:py-24">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <p className="mono-label mb-5 text-[11px] text-orange-300">
          04 / Track Record
        </p>
        <RevealLines
          as="h2"
          lines={[heading]}
          className="max-w-2xl text-3xl font-black leading-[1.08] tracking-tight sm:text-5xl"
        />
        <p className="mt-6 max-w-lg text-base text-white/65">{body}</p>

        <div className="mt-14 grid grid-cols-2 gap-x-6 gap-y-8 md:grid-cols-4">
          {stats.map((s, i) => (
            <FadeUp
              key={s.label}
              delay={i * 0.06}
              className={`flex flex-col items-center text-center ${
                i > 0 ? "md:border-l md:border-white/10" : ""
              }`}
            >
              <p className="font-mono text-3xl font-medium text-white sm:text-4xl">
                {s.value}
              </p>
              <p className="mt-1.5 text-sm text-white/55">{s.label}</p>
            </FadeUp>
          ))}
        </div>
      </div>
    </section>
  );
}
