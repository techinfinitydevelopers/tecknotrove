"use client";

import Image from "next/image";
import { motion, useReducedMotion } from "motion/react";
import MagneticButton from "@/components/ui/MagneticButton";
import type { Sector } from "@/data/sectors";

export default function SectorHero({ sector }: { sector: Sector }) {
  const reduce = useReducedMotion();

  return (
    <section className="relative flex h-[90vh] min-h-[560px] flex-col justify-end overflow-hidden text-white">
      <div className="absolute inset-0">
        <Image src={sector.image} alt="" fill priority sizes="100vw" className="object-cover" />
        <div
          className="absolute inset-0"
          style={{
            background: `linear-gradient(180deg, rgba(9,10,14,0.55) 0%, rgba(9,10,14,0.75) 55%, rgba(9,10,14,0.96) 100%)`,
          }}
        />
        <div
          className="absolute inset-0 mix-blend-color"
          style={{ background: sector.accent, opacity: 0.35 }}
        />
      </div>

      <div className="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-16 pt-32 sm:px-8 sm:pb-20">
        <motion.span
          initial={reduce ? false : { opacity: 0, y: 10 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
          className="mono-label mb-5 inline-flex items-center gap-2 rounded-full border border-white/25 bg-black/20 px-3.5 py-1.5 text-[10.5px] text-white"
        >
          <span
            className="h-1.5 w-1.5 rounded-full"
            style={{ background: sector.accent }}
          />
          {sector.eyebrow}
        </motion.span>

        <h1 className="max-w-3xl text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl">
          {sector.h1}
        </h1>

        <motion.p
          initial={reduce ? false : { opacity: 0, y: 10 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, delay: 0.15 }}
          className="mt-6 max-w-lg text-base text-white/75 sm:text-lg"
        >
          {sector.subhead}
        </motion.p>

        <div className="mt-9 flex flex-wrap items-center gap-4">
          <MagneticButton href="#contact" variant="solid">
            Get in Touch
          </MagneticButton>
          <MagneticButton href="#brochure" variant="outline-light">
            Download Brochure
          </MagneticButton>
        </div>
      </div>
    </section>
  );
}
