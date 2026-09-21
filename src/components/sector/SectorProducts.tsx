"use client";

import Link from "next/link";
import { ArrowUpRight, Cube } from "@phosphor-icons/react";
import { FadeUp, RevealLines } from "@/components/ui/RevealText";
import type { Sector } from "@/data/sectors";

export default function SectorProducts({ sector }: { sector: Sector }) {
  return (
    <section id="products" className="bg-bg-elevated py-20 sm:py-28">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <RevealLines
          as="h2"
          lines={[`Every simulator ships with`, `Tecknotrove TMS.`]}
          className="max-w-2xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl"
        />

        <div className="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
          {sector.products.map((p, i) => {
            const Tile = (
              <>
                <div
                  className="flex h-12 w-12 items-center justify-center rounded-full"
                  style={{ background: sector.accentSoft, color: sector.accent }}
                >
                  <Cube size={22} weight="duotone" />
                </div>
                <h3 className="mt-6 text-lg font-bold leading-snug">{p.name}</h3>
                <p className="mt-2 text-sm text-ink-dim">{p.desc}</p>
                {p.href && (
                  <span className="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-ink">
                    View Product
                    <ArrowUpRight size={15} />
                  </span>
                )}
              </>
            );

            return (
              <FadeUp
                key={p.name}
                delay={i * 0.05}
                className="rounded-2xl border border-line bg-bg p-6"
              >
                {p.href ? (
                  <Link href={p.href} className="group block">
                    {Tile}
                  </Link>
                ) : (
                  <div>{Tile}</div>
                )}
              </FadeUp>
            );
          })}
        </div>
      </div>
    </section>
  );
}
