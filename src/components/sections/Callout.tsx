"use client";

import { MapPin, Phone, Globe, ArrowUpRight } from "@phosphor-icons/react";
import MagneticButton from "@/components/ui/MagneticButton";
import { RevealLines, FadeUp } from "@/components/ui/RevealText";

export default function Callout() {
  return (
    <section
      id="contact"
      className="relative overflow-hidden bg-orange py-20 text-[#170800] sm:py-24"
    >
      <div
        className="pointer-events-none absolute inset-0 opacity-40"
        style={{
          backgroundImage:
            "linear-gradient(rgba(23,8,0,0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(23,8,0,0.08) 1px, transparent 1px)",
          backgroundSize: "48px 48px",
          maskImage:
            "radial-gradient(ellipse 80% 70% at 30% 40%, black 20%, transparent 85%)",
        }}
      />

      <div className="relative z-10 mx-auto grid max-w-[1400px] grid-cols-1 items-center gap-12 px-5 sm:px-8 lg:grid-cols-[1.05fr_0.95fr] lg:gap-16">
        {/* pitch */}
        <div>
          <RevealLines
            as="h2"
            lines={["See a simulator", "in action."]}
            className="text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl"
          />
          <FadeUp delay={0.15}>
            <p className="mt-6 max-w-lg text-base text-[#170800]/75 sm:text-lg">
              Visit our Mumbai facility for a live demonstration, or request a
              virtual walkthrough with our engineering team.
            </p>
            <div className="mt-9 flex flex-wrap items-center gap-4">
              <MagneticButton href="tel:+912261513002" variant="dark" sweep="blue">
                Book a demo
              </MagneticButton>
              <MagneticButton href="#brochure" variant="outline-dark" sweep="blue">
                Download Brochure
              </MagneticButton>
            </div>
          </FadeUp>
        </div>

        {/* facility card */}
        <FadeUp delay={0.25}>
          <div className="rounded-2xl bg-[#170800] p-8 text-white sm:p-10">
            <p className="mono-label text-[11px] text-orange-300">
              The facility
            </p>
            <p className="mt-4 text-xl font-bold leading-snug">
              Tecknotrove Systems India Pvt Ltd
            </p>

            <div className="mt-7 space-y-5">
              <div className="flex gap-3.5">
                <MapPin size={20} weight="duotone" className="mt-0.5 shrink-0 text-orange-300" />
                <p className="text-sm leading-relaxed text-white/70">
                  505, Windfall, Sahar Plaza, Chakala,
                  <br />
                  Andheri (East), Mumbai 400059
                </p>
              </div>

              <a
                href="tel:+912261513002"
                className="group flex items-center gap-3.5 text-sm text-white/70 transition-colors hover:text-white"
              >
                <Phone size={20} weight="duotone" className="shrink-0 text-orange-300" />
                +91 22 6151 3002
              </a>

              <a
                href="https://www.tecknotrove.com"
                target="_blank"
                rel="noopener noreferrer"
                className="group flex items-center gap-3.5 text-sm text-white/70 transition-colors hover:text-white"
              >
                <Globe size={20} weight="duotone" className="shrink-0 text-orange-300" />
                www.tecknotrove.com
                <ArrowUpRight
                  size={14}
                  className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                />
              </a>
            </div>

            <div className="mt-8 flex gap-8 border-t border-white/10 pt-6">
              <div>
                <p className="font-mono text-lg font-medium text-white">Mon–Sat</p>
                <p className="mt-0.5 text-xs text-white/50">Facility visits</p>
              </div>
              <div>
                <p className="font-mono text-lg font-medium text-white">24×7</p>
                <p className="mt-0.5 text-xs text-white/50">Technical support</p>
              </div>
            </div>
          </div>
        </FadeUp>
      </div>
    </section>
  );
}
