"use client";

import Image from "next/image";
import { Check } from "@phosphor-icons/react";
import { FadeUp, RevealLines } from "@/components/ui/RevealText";
import type { Sector } from "@/data/sectors";

export default function SectorTechnology({ sector }: { sector: Sector }) {
  return (
    <section className="bg-bg-elevated py-20 sm:py-28">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="grid grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-16">
          <div>
            <p className="mono-label mb-5 text-[11px]" style={{ color: sector.accent }}>
              {sector.technologyLabel}
            </p>
            <RevealLines
              as="h2"
              lines={[sector.technologyHeading]}
              className="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl"
            />
            <p className="mt-6 max-w-lg text-base text-ink-dim">
              {sector.technologyBody}
            </p>
            <ul className="mt-8 space-y-4">
              {sector.technologyBullets.map((b) => (
                <li key={b} className="flex items-start gap-3 text-sm text-ink">
                  <Check
                    size={16}
                    weight="bold"
                    className="mt-0.5 shrink-0"
                    style={{ color: sector.accent }}
                  />
                  {b}
                </li>
              ))}
            </ul>
          </div>

          <FadeUp className="relative aspect-[4/3] overflow-hidden rounded-2xl">
            <Image
              src={sector.image}
              alt=""
              fill
              sizes="(max-width: 1024px) 100vw, 50vw"
              className="object-cover"
            />
          </FadeUp>
        </div>
      </div>
    </section>
  );
}
