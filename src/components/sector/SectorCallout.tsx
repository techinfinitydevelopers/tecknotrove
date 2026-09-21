"use client";

import Link from "next/link";
import { ArrowUpRight } from "@phosphor-icons/react";
import MagneticButton from "@/components/ui/MagneticButton";
import { RevealLines, FadeUp } from "@/components/ui/RevealText";
import type { Sector } from "@/data/sectors";

export default function SectorCallout({ sector }: { sector: Sector }) {
  return (
    <section id="contact" className="relative overflow-hidden bg-orange py-20 text-[#170800] sm:py-24">
      <div className="relative z-10 mx-auto max-w-[1400px] px-5 text-center sm:px-8">
        <RevealLines
          as="h2"
          lines={["Ready to see it", "in action?"]}
          className="mx-auto max-w-2xl text-4xl font-black leading-[1.05] tracking-tight sm:text-6xl"
        />
        <FadeUp delay={0.15}>
          <div className="mt-9 flex flex-wrap items-center justify-center gap-4">
            <MagneticButton href="tel:+912261513002" variant="dark" sweep="blue">
              Get in Touch
            </MagneticButton>
            <MagneticButton href="#brochure" variant="outline-dark" sweep="blue">
              Download Brochure
            </MagneticButton>
          </div>
        </FadeUp>
      </div>

      <div className="relative z-10 mx-auto mt-16 flex max-w-[1400px] flex-col items-center gap-4 border-t border-[#170800]/15 px-5 pt-10 text-center sm:px-8">
        <p className="text-sm text-[#170800]/70">Explore other industries.</p>
        <Link
          href="/#simulation"
          className="group inline-flex items-center gap-2 text-sm font-semibold text-[#170800]"
        >
          All Simulation Solutions
          <ArrowUpRight
            size={15}
            className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
          />
        </Link>
      </div>
    </section>
  );
}
