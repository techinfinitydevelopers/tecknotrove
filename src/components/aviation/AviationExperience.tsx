"use client";

import Image from "next/image";
import { useState } from "react";
import {
  AirplaneTilt,
  ArrowDown,
  ArrowRight,
  ArrowUpRight,
  Broadcast,
  Check,
  GlobeHemisphereWest,
  Headset,
  List,
  ShieldCheck,
  X,
} from "@phosphor-icons/react";
import type { Sector } from "@/data/sectors";

const NAV_ITEMS = [
  { label: "Overview", href: "#overview" },
  { label: "Simulators", href: "#simulators" },
  { label: "Training", href: "#training" },
  { label: "Technology", href: "#technology" },
  { label: "Our track record", href: "#track-record" },
];

const PROOF_ICONS = [GlobeHemisphereWest, ShieldCheck, Headset];

export default function AviationExperience({ sector }: { sector: Sector }) {
  const [menuOpen, setMenuOpen] = useState(false);

  const closeMenu = () => setMenuOpen(false);

  return (
    <>
      <a
        href="#main-content"
        className="sr-only z-[70] rounded-full bg-white px-5 py-3 text-sm font-bold text-[#071a2c] focus:not-sr-only focus:fixed focus:left-4 focus:top-4"
      >
        Skip to content
      </a>

      <header className="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#071a2c]/85 text-white shadow-[0_12px_40px_-24px_rgba(0,0,0,.65)] backdrop-blur-xl">
        <nav
          aria-label="Aviation page"
          className="mx-auto flex h-[76px] max-w-[1440px] items-center justify-between px-5 sm:px-8"
        >
          <a href="#top" onClick={closeMenu} className="flex shrink-0 items-center">
            <Image
              src="/images/logo-white.png"
              alt="Tecknotrove"
              width={158}
              height={40}
              priority
              className="h-7 w-auto sm:h-8"
            />
          </a>

          <div className="hidden items-center gap-7 xl:flex">
            {NAV_ITEMS.map((item) => (
              <a
                key={item.href}
                href={item.href}
                className="text-[12px] font-medium tracking-wide text-white/70 transition-colors hover:text-white"
              >
                {item.label}
              </a>
            ))}
          </div>

          <div className="flex items-center gap-3">
            <a
              href="/#simulation"
              className="hidden items-center gap-2 rounded-full border border-white/20 px-4 py-2.5 text-xs font-semibold text-white/85 transition-colors hover:border-white/50 hover:bg-white/5 lg:inline-flex"
            >
              All industries <ArrowUpRight size={14} />
            </a>
            <a
              href="#contact"
              className="hidden items-center gap-2 rounded-full bg-[#d7b982] px-5 py-2.5 text-xs font-bold text-[#071a2c] transition-colors hover:bg-[#ead3a6] sm:inline-flex"
            >
              Talk to our team <ArrowUpRight size={14} />
            </a>
            <button
              type="button"
              aria-label={menuOpen ? "Close navigation menu" : "Open navigation menu"}
              aria-expanded={menuOpen}
              aria-controls="aviation-mobile-menu"
              onClick={() => setMenuOpen((open) => !open)}
              className="flex h-10 w-10 items-center justify-center rounded-full border border-white/20 text-white transition-colors hover:border-white/50 xl:hidden"
            >
              {menuOpen ? <X size={19} /> : <List size={19} />}
            </button>
          </div>
        </nav>

        {menuOpen && (
          <div
            id="aviation-mobile-menu"
            className="border-t border-white/10 bg-[#071a2c] px-5 pb-6 pt-3 xl:hidden"
          >
            <div className="mx-auto flex max-w-[1440px] flex-col">
              {NAV_ITEMS.map((item) => (
                <a
                  key={item.href}
                  href={item.href}
                  onClick={closeMenu}
                  className="border-b border-white/10 py-3.5 text-sm text-white/80 transition-colors hover:text-white"
                >
                  {item.label}
                </a>
              ))}
              <a
                href="/#simulation"
                onClick={closeMenu}
                className="mt-4 text-sm font-semibold text-[#e2c895]"
              >
                Explore all industries <ArrowUpRight className="ml-1 inline" size={15} />
              </a>
              <a
                href="#contact"
                onClick={closeMenu}
                className="mt-4 inline-flex w-fit items-center gap-2 rounded-full bg-[#d7b982] px-5 py-3 text-sm font-bold text-[#071a2c]"
              >
                Talk to our team <ArrowUpRight size={15} />
              </a>
            </div>
          </div>
        )}
      </header>

      <main id="main-content" className="flex-1 bg-[#f7f6f2] text-[#102335]">
        <section id="top" className="relative flex min-h-[720px] items-end overflow-hidden bg-[#071a2c] text-white sm:min-h-[790px] lg:min-h-[92svh]">
          <div className="absolute inset-0">
            <Image
              src={sector.image}
              alt=""
              fill
              priority
              sizes="100vw"
              className="object-cover object-center"
            />
            <div className="absolute inset-0 bg-[linear-gradient(90deg,rgba(5,17,30,.94)_0%,rgba(5,17,30,.74)_42%,rgba(5,17,30,.16)_100%)]" />
            <div className="absolute inset-0 bg-[linear-gradient(0deg,rgba(5,17,30,.88)_0%,transparent_54%)]" />
            <div className="absolute inset-0 opacity-20 [background-image:linear-gradient(rgba(255,255,255,.12)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.12)_1px,transparent_1px)] [background-size:72px_72px] [mask-image:linear-gradient(90deg,black,transparent_82%)]" />
          </div>

          <div className="relative z-10 mx-auto w-full max-w-[1440px] px-5 pb-16 pt-36 sm:px-8 sm:pb-20 lg:pb-24">
            <div className="max-w-[820px]">
              <p className="mb-7 inline-flex items-center gap-3 text-[10px] font-semibold uppercase tracking-[.25em] text-[#e1c48f] sm:text-xs">
                <span className="h-px w-8 bg-[#d7b982]" /> Tecknotrove Aviation
              </p>
              <h1 className="max-w-[790px] text-balance text-[clamp(3rem,7vw,6.6rem)] font-medium leading-[.99] tracking-[-.055em]">
                Simulation systems that meet the standard of flight.
              </h1>
              <p className="mt-7 max-w-[570px] text-base leading-7 text-white/75 sm:text-lg sm:leading-8">
                From the flight deck to the apron, every Tecknotrove aviation simulator is built to the fidelity regulators and crews expect.
              </p>
              <div className="mt-9 flex flex-wrap items-center gap-3">
                <a
                  href="#simulators"
                  className="group inline-flex items-center gap-3 rounded-full bg-[#d7b982] px-6 py-3.5 text-sm font-bold text-[#071a2c] transition-all hover:bg-[#ead3a6]"
                >
                  Explore simulators
                  <ArrowDown size={16} className="transition-transform group-hover:translate-y-0.5" />
                </a>
                <a
                  href="#contact"
                  className="inline-flex items-center gap-2 rounded-full border border-white/35 px-6 py-3.5 text-sm font-semibold text-white transition-colors hover:border-white hover:bg-white/10"
                >
                  Speak with an expert <ArrowUpRight size={15} />
                </a>
              </div>
            </div>

            <div className="mt-16 flex flex-wrap items-center gap-x-8 gap-y-3 border-t border-white/20 pt-5 text-[10px] font-medium uppercase tracking-[.2em] text-white/60 sm:mt-20 sm:text-[11px]">
              <span>Flight training</span>
              <span className="hidden h-1 w-1 rounded-full bg-[#d7b982] sm:block" />
              <span>Ground operations</span>
              <span className="hidden h-1 w-1 rounded-full bg-[#d7b982] sm:block" />
              <span>Air traffic control</span>
            </div>
          </div>

          <a
            href="#overview"
            aria-label="Scroll to aviation overview"
            className="absolute bottom-24 right-8 hidden h-12 w-12 items-center justify-center rounded-full border border-white/35 text-white transition-colors hover:bg-white/10 lg:flex"
          >
            <ArrowDown size={18} />
          </a>
        </section>

        <section id="overview" className="px-5 py-20 sm:px-8 sm:py-28 lg:py-36">
          <div className="mx-auto grid max-w-[1280px] gap-12 lg:grid-cols-[.8fr_1.2fr] lg:gap-24">
            <div>
              <p className="mb-5 text-[10px] font-semibold uppercase tracking-[.24em] text-[#927448]">Aviation, considered end to end</p>
              <h2 className="max-w-xl text-3xl font-medium leading-[1.08] tracking-[-.04em] sm:text-5xl">
                Confidence for every crew, on every part of the journey.
              </h2>
            </div>
            <div className="lg:pt-2">
              <p className="max-w-2xl text-base leading-8 text-[#5b6872] sm:text-lg">
                From flight crew procedures to ground-support operations, our aviation portfolio helps teams build capability in a controlled, repeatable environment. Train for routine operations, sharpen responses to demanding situations, and give instructors the tools to assess performance.
              </p>
              <a href="#training" className="mt-7 inline-flex items-center gap-2 text-sm font-bold text-[#102335] transition-colors hover:text-[#927448]">
                See training applications <ArrowRight size={16} />
              </a>
            </div>
          </div>
          <div className="mx-auto mt-16 grid max-w-[1280px] grid-cols-2 border-y border-[#d9d7d0] md:grid-cols-4">
            {sector.stats.map((stat, index) => (
              <div key={stat.label} className={`py-7 sm:py-9 ${index % 2 ? "pl-5 sm:pl-8" : "pr-5 sm:pr-8"} ${index > 1 ? "border-t border-[#d9d7d0] md:border-t-0" : ""} ${index % 2 === 1 ? "border-l border-[#d9d7d0]" : ""} ${index === 2 ? "md:border-l" : ""}`}>
                <p className="text-3xl font-medium tracking-[-.04em] text-[#102335] sm:text-4xl">{stat.value}</p>
                <p className="mt-2 text-[10px] font-semibold uppercase tracking-[.15em] text-[#71808a] sm:text-xs">{stat.label}</p>
              </div>
            ))}
          </div>
        </section>

        <section id="simulators" className="bg-white px-5 py-20 sm:px-8 sm:py-28 lg:py-32">
          <div className="mx-auto max-w-[1280px]">
            <div className="flex flex-col justify-between gap-6 border-b border-[#e4e3df] pb-8 md:flex-row md:items-end">
              <div>
                <p className="mb-4 text-[10px] font-semibold uppercase tracking-[.24em] text-[#927448]">A considered portfolio</p>
                <h2 className="max-w-2xl text-3xl font-medium leading-tight tracking-[-.04em] sm:text-5xl">Training solutions for the entire aviation ecosystem.</h2>
              </div>
              <p className="max-w-sm text-sm leading-6 text-[#71808a]">Explore simulation for flight crews, airport teams, air traffic controllers and cabin operations.</p>
            </div>

            <div className="mt-8 grid gap-0 sm:grid-cols-2 lg:grid-cols-3">
              {sector.products.map((product, index) => (
                <article key={product.name} className="group relative border-b border-[#e4e3df] py-7 sm:px-6 sm:py-9 lg:px-8 first:sm:pl-0 [&:nth-child(odd)]:sm:border-r [&:nth-child(3n+1)]:lg:pl-0 [&:nth-child(3n)]:lg:border-r-0">
                  <div className="flex items-center justify-between">
                    <span className="text-[10px] font-semibold tracking-[.18em] text-[#a2a7a7]">0{index + 1}</span>
                    <AirplaneTilt size={20} weight="light" className="text-[#a58b5e] transition-transform group-hover:-translate-y-1 group-hover:translate-x-1" />
                  </div>
                  <h3 className="mt-8 max-w-sm text-xl font-medium tracking-[-.025em] text-[#102335] sm:text-2xl">{product.name}</h3>
                  <p className="mt-3 max-w-sm text-sm leading-6 text-[#71808a]">{product.desc}</p>
                  <div className="mt-7 h-px w-10 bg-[#d7b982] transition-all group-hover:w-16" />
                </article>
              ))}
            </div>
          </div>
        </section>

        <section id="training" className="relative overflow-hidden bg-[#0b2032] px-5 py-20 text-white sm:px-8 sm:py-28 lg:py-32">
          <div className="pointer-events-none absolute -right-36 -top-40 h-[520px] w-[520px] rounded-full border border-white/[.07]" />
          <div className="pointer-events-none absolute -right-16 -top-20 h-[360px] w-[360px] rounded-full border border-white/[.07]" />
          <div className="relative mx-auto grid max-w-[1280px] gap-12 lg:grid-cols-[.85fr_1.15fr] lg:gap-24">
            <div>
              <p className="mb-5 text-[10px] font-semibold uppercase tracking-[.24em] text-[#d7b982]">Training built around real operations</p>
              <h2 className="max-w-xl text-3xl font-medium leading-[1.08] tracking-[-.04em] sm:text-5xl">Prepare for the expected. Practise for the unexpected.</h2>
              <p className="mt-6 max-w-lg text-base leading-7 text-white/60">Move from procedural familiarisation to high-pressure scenarios in a safe, repeatable training environment.</p>
            </div>
            <div className="grid grid-cols-1 sm:grid-cols-2">
              {sector.applications.map((application, index) => (
                <div key={application} className="flex items-center gap-4 border-t border-white/15 py-5 sm:px-5 first:sm:pl-0 [&:nth-child(odd)]:sm:border-r [&:nth-child(2)]:sm:border-t">
                  <span className="font-mono text-[10px] text-[#d7b982]">0{index + 1}</span>
                  <span className="text-sm font-medium text-white/85">{application}</span>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section id="technology" className="px-5 py-20 sm:px-8 sm:py-28 lg:py-36">
          <div className="mx-auto grid max-w-[1280px] items-center gap-12 lg:grid-cols-2 lg:gap-20">
            <div className="relative min-h-[360px] overflow-hidden bg-[#d8dfe2] sm:min-h-[520px]">
              <Image
                src="/images/why-simulator.jpg"
                alt="Tecknotrove engineers assembling a full-motion training simulator platform"
                fill
                sizes="(max-width: 1024px) 100vw, 50vw"
                className="object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-[#071a2c]/45 to-transparent" />
              <div className="absolute bottom-5 left-5 flex items-center gap-3 border border-white/25 bg-[#071a2c]/55 px-4 py-3 text-[10px] font-medium uppercase tracking-[.16em] text-white backdrop-blur-md sm:bottom-7 sm:left-7">
                <span className="h-2 w-2 rounded-full bg-[#d7b982]" /> Integrated engineering
              </div>
            </div>

            <div className="lg:py-8">
              <p className="mb-5 text-[10px] font-semibold uppercase tracking-[.24em] text-[#927448]">The engineering behind the experience</p>
              <h2 className="max-w-xl text-3xl font-medium leading-[1.08] tracking-[-.04em] sm:text-5xl">Fidelity that satisfies regulators — and pilots.</h2>
              <p className="mt-6 max-w-xl text-base leading-7 text-[#5b6872]">Visual, motion and control-loading systems engineered in-house to match certified aircraft handling characteristics.</p>
              <ul className="mt-8 space-y-4">
                {sector.technologyBullets.map((item) => (
                  <li key={item} className="flex items-start gap-3 text-sm leading-6 text-[#344957]">
                    <Check size={17} weight="bold" className="mt-1 shrink-0 text-[#927448]" />
                    {item}
                  </li>
                ))}
              </ul>
              <div className="mt-9 flex items-center gap-3 border-t border-[#d9d7d0] pt-6 text-xs text-[#71808a]">
                <Broadcast size={18} className="text-[#927448]" />
                One integrated system, tuned for the training mission.
              </div>
            </div>
          </div>
        </section>

        {sector.trust && (
          <section id="track-record" className="bg-[#eae8e1] px-5 py-20 sm:px-8 sm:py-28">
            <div className="mx-auto max-w-[1280px]">
              <div className="grid gap-8 md:grid-cols-[1fr_.7fr] md:items-end">
                <div>
                  <p className="mb-5 text-[10px] font-semibold uppercase tracking-[.24em] text-[#927448]">Experience, backed by standards</p>
                  <h2 className="max-w-2xl text-3xl font-medium leading-tight tracking-[-.04em] sm:text-5xl">{sector.trust.heading}</h2>
                </div>
                <p className="max-w-md text-sm leading-7 text-[#65737b] md:justify-self-end">{sector.trust.body}</p>
              </div>
              <div className="mt-12 grid border-y border-[#d1cec5] sm:grid-cols-2 lg:grid-cols-4">
                {sector.trust.stats.map((item, index) => {
                  const Icon = PROOF_ICONS[index % PROOF_ICONS.length];
                  return (
                    <div key={item.label} className={`py-7 sm:px-6 sm:py-9 ${index % 2 ? "border-l border-[#d1cec5] pl-5 sm:pl-6" : "pr-5 sm:pr-6"} ${index > 1 ? "border-t border-[#d1cec5] lg:border-t-0" : ""} ${index === 2 ? "lg:border-l" : ""}`}>
                      <Icon size={20} weight="light" className="text-[#927448]" />
                      <p className="mt-5 text-2xl font-medium tracking-[-.03em] text-[#102335] sm:text-3xl">{item.value}</p>
                      <p className="mt-2 text-xs leading-5 text-[#71808a]">{item.label}</p>
                    </div>
                  );
                })}
              </div>
            </div>
          </section>
        )}

        <section id="contact" className="relative overflow-hidden bg-[#071a2c] px-5 py-20 text-white sm:px-8 sm:py-28 lg:py-32">
          <div className="absolute right-0 top-0 h-full w-1/2 bg-[radial-gradient(ellipse_at_100%_0%,rgba(215,185,130,.15),transparent_60%)]" />
          <div className="relative mx-auto grid max-w-[1280px] gap-10 md:grid-cols-[1fr_auto] md:items-end">
            <div>
              <p className="mb-5 text-[10px] font-semibold uppercase tracking-[.24em] text-[#d7b982]">Start a conversation</p>
              <h2 className="max-w-3xl text-4xl font-medium leading-[1.05] tracking-[-.045em] sm:text-6xl">Let’s plan what your aviation teams need next.</h2>
              <p className="mt-6 max-w-xl text-base leading-7 text-white/60">Tell us about your training objectives and we’ll help you explore the right simulation approach.</p>
            </div>
            <a href="tel:+912261513002" className="group inline-flex w-fit items-center gap-3 rounded-full bg-[#d7b982] px-6 py-4 text-sm font-bold text-[#071a2c] transition-colors hover:bg-[#ead3a6]">
              Talk to our team <ArrowUpRight size={17} className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" />
            </a>
          </div>
          <div className="relative mx-auto mt-14 flex max-w-[1280px] flex-col gap-2 border-t border-white/15 pt-6 text-xs leading-6 text-white/55 sm:flex-row sm:justify-between">
            <span>Tecknotrove Systems India Pvt Ltd</span>
            <span>505, Windfall, Sahar Plaza, Chakala, Andheri (East), Mumbai 400059</span>
          </div>
        </section>
      </main>
    </>
  );
}
