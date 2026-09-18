"use client";

import { useEffect, useRef } from "react";
import Image from "next/image";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import MagneticButton from "@/components/ui/MagneticButton";
import { RevealLines } from "@/components/ui/RevealText";
import { FadeUp } from "@/components/ui/RevealText";

gsap.registerPlugin(ScrollTrigger);

export default function WhyTecknotrove() {
  const sectionRef = useRef<HTMLDivElement>(null);
  const imgRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduce || !sectionRef.current || !imgRef.current) return;

    const ctx = gsap.context(() => {
      gsap.fromTo(
        imgRef.current,
        { scale: 1.25, yPercent: -6 },
        {
          scale: 1,
          yPercent: 6,
          ease: "none",
          scrollTrigger: {
            trigger: sectionRef.current,
            start: "top bottom",
            end: "bottom top",
            scrub: 1,
          },
        }
      );
    }, sectionRef);

    return () => ctx.revert();
  }, []);

  return (
    <section id="why" ref={sectionRef} className="relative overflow-hidden py-28 sm:py-40">
      <div ref={imgRef} className="absolute inset-0">
        <Image
          src="/images/oesd-hero.jpg"
          alt="Tecknotrove full-motion training simulator platform"
          fill
          className="object-cover"
        />
      </div>
      <div className="absolute inset-0 bg-white/88" />
      <div className="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-blue-brand/10" />

      <div className="relative z-10 mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="max-w-2xl">
          <RevealLines
            as="h2"
            lines={["Every subsystem.", "One source."]}
            className="text-4xl font-black leading-[1.05] tracking-tight sm:text-6xl"
          />
          <FadeUp delay={0.15}>
            <p className="mt-6 max-w-lg text-base text-ink-dim sm:text-lg">
              Motion platforms, visuals, controls and instructor software are
              all engineered in-house, so every simulator ships as one
              integrated system instead of a stack of vendors.
            </p>
            <div className="mt-9">
              <MagneticButton href="#simulation" variant="outline">
                Our Technology
              </MagneticButton>
            </div>
          </FadeUp>
        </div>
      </div>
    </section>
  );
}
