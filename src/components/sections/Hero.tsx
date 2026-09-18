"use client";

import { motion, useReducedMotion } from "motion/react";
import MagneticButton from "@/components/ui/MagneticButton";

export default function Hero() {
  const reduce = useReducedMotion();

  return (
    <section id="top" className="relative h-[150vh]">
      <div
        className="sticky top-0 flex h-dvh flex-col overflow-hidden text-white"
        style={{
          background:
            "radial-gradient(ellipse 90% 70% at 78% 15%, #12409e 0%, var(--blue-brand) 45%, var(--blue-950) 100%)",
        }}
      >
        {/* technical backdrop */}
        <div className="pointer-events-none absolute inset-0">
          <div
            className="absolute inset-0 opacity-[0.5]"
            style={{
              backgroundImage:
                "linear-gradient(rgba(255,255,255,0.09) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.09) 1px, transparent 1px)",
              backgroundSize: "56px 56px",
              maskImage:
                "radial-gradient(ellipse 80% 60% at 65% 40%, black 10%, transparent 75%)",
            }}
          />
          <div className="absolute right-[-10%] top-1/2 h-[130vmin] w-[130vmin] -translate-y-1/2 sm:right-[-4%]">
            <div className="absolute inset-0 rounded-full border border-white/20 animate-spin-slow" />
            <div className="absolute inset-[9%] rounded-full border border-white/15 animate-spin-slow-reverse" />
            <div className="absolute inset-[20%] rounded-full border border-orange/25" />
            <div className="absolute inset-[20%] rounded-full border border-white/10">
              <span
                className="absolute inset-0 rounded-full border border-orange/40"
                style={{ animation: reduce ? undefined : "pulse-ring 3.6s ease-out infinite" }}
              />
            </div>
            <div
              className="absolute inset-0"
              style={{
                background:
                  "conic-gradient(from 200deg, transparent 0deg, rgba(255,255,255,0.16) 40deg, transparent 90deg)",
                animation: reduce ? undefined : "spin-slow 12s linear infinite",
                borderRadius: "9999px",
              }}
            />
          </div>
          <div className="absolute inset-0 bg-gradient-to-t from-blue-950/80 via-transparent to-transparent" />
        </div>

        <div className="relative z-10 mx-auto flex w-full max-w-[1400px] flex-1 flex-col justify-center px-5 pt-16 sm:px-8">
          <motion.p
            initial={reduce ? false : { opacity: 0, y: 12 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.1 }}
            className="mono-label mb-6 text-[11px] text-orange-300"
          >
            Simulation &amp; Training Technology &middot; Est. 2002
          </motion.p>

          <h1 className="max-w-3xl text-[13vw] font-black leading-[0.95] tracking-tight sm:text-[7.5vw] lg:text-[5.6rem]">
            {["Precise today.", "Perfect tomorrow."].map((line, i) => (
              <span key={line} className="block overflow-hidden">
                <motion.span
                  className="block"
                  initial={reduce ? false : { y: "115%" }}
                  animate={{ y: "0%" }}
                  transition={{
                    duration: 1,
                    delay: 0.25 + i * 0.12,
                    ease: [0.16, 1, 0.3, 1],
                  }}
                >
                  {line}
                </motion.span>
              </span>
            ))}
          </h1>

          <motion.p
            initial={reduce ? false : { opacity: 0, y: 12 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.55 }}
            className="mt-7 max-w-md text-base text-white/75 sm:text-lg"
          >
            Building technologies for demanding industries, from full-motion
            armoured vehicle trainers to airport ground-support simulators.
          </motion.p>

          <motion.div
            initial={reduce ? false : { opacity: 0, y: 12 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.68 }}
            className="mt-10 flex flex-wrap items-center gap-4"
          >
            <MagneticButton href="#why" variant="solid">
              About Us
            </MagneticButton>
            <MagneticButton
              href="https://youtu.be/hb-hqyMnMLw"
              target="_blank"
              variant="outline-light"
            >
              Corporate Video
            </MagneticButton>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
