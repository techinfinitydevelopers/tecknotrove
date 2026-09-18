"use client";

import { useState } from "react";
import Image from "next/image";
import { motion, useScroll, useMotionValueEvent, AnimatePresence } from "motion/react";
import { List, X, ArrowUpRight } from "@phosphor-icons/react";
import { cn } from "@/lib/utils";
import MagneticButton from "@/components/ui/MagneticButton";

const NAV_LINKS = [
  { label: "Simulation", href: "#simulation" },
  { label: "Software", href: "#software" },
  { label: "Company", href: "#why" },
];

const MENU_COLUMNS = [
  {
    title: "Simulation",
    links: ["Defence", "Aviation", "Automobile", "OESD"],
  },
  {
    title: "Software",
    links: ["Training Management System"],
  },
  {
    title: "Company",
    links: ["About Us", "Careers", "News", "Contact"],
  },
];

export default function Nav() {
  const [scrolled, setScrolled] = useState(false);
  const [open, setOpen] = useState(false);
  const { scrollY } = useScroll();

  useMotionValueEvent(scrollY, "change", (v) => setScrolled(v > 24));

  return (
    <>
      <header
        className={cn(
          "fixed inset-x-0 top-0 z-50 bg-nav-bg transition-shadow duration-300",
          scrolled && "shadow-[0_8px_30px_-12px_rgba(0,0,0,0.35)]"
        )}
      >
        <nav className="mx-auto flex h-16 max-w-[1400px] items-center justify-between px-5 sm:h-[72px] sm:px-8">
          <a href="#top" className="relative z-10 flex items-center">
            <Image
              src="/images/logo-white.png"
              alt="Tecknotrove"
              width={158}
              height={40}
              priority
              className="h-7 w-auto sm:h-8"
            />
          </a>

          <div className="hidden items-center gap-9 lg:flex">
            {NAV_LINKS.map((l) => (
              <a
                key={l.label}
                href={l.href}
                className="text-[14.5px] font-medium text-white/65 transition-colors hover:text-white"
              >
                {l.label}
              </a>
            ))}
          </div>

          <div className="flex items-center gap-3">
            <span className="hidden sm:inline-flex">
              <MagneticButton href="#contact" variant="light">
                Get in Touch
              </MagneticButton>
            </span>
            <button
              aria-label="Open menu"
              onClick={() => setOpen((o) => !o)}
              className="relative z-10 flex h-10 w-10 items-center justify-center rounded-full border border-white/20 text-white transition-colors hover:border-orange/60"
            >
              {open ? <X size={18} /> : <List size={18} />}
            </button>
          </div>
        </nav>
      </header>

      <AnimatePresence>
        {open && (
          <motion.div
            initial={{ clipPath: "inset(0 0 100% 0)" }}
            animate={{ clipPath: "inset(0 0 0% 0)" }}
            exit={{ clipPath: "inset(0 0 100% 0)" }}
            transition={{ duration: 0.55, ease: [0.76, 0, 0.24, 1] }}
            className="fixed inset-0 z-40 flex flex-col bg-nav-bg pt-24"
          >
            <div className="mx-auto grid w-full max-w-[1400px] flex-1 grid-cols-1 gap-12 px-6 pb-16 sm:px-8 md:grid-cols-3 md:gap-8">
              {MENU_COLUMNS.map((col, ci) => (
                <div key={col.title}>
                  <p className="mono-label mb-6 text-[11px] text-white/40">
                    {col.title}
                  </p>
                  <ul className="space-y-4">
                    {col.links.map((link, li) => (
                      <motion.li
                        key={link}
                        initial={{ opacity: 0, y: 16 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{
                          duration: 0.5,
                          delay: 0.15 + ci * 0.05 + li * 0.04,
                          ease: [0.16, 1, 0.3, 1],
                        }}
                      >
                        <a
                          href="#simulation"
                          onClick={() => setOpen(false)}
                          className="group flex items-center gap-2 text-2xl font-semibold text-white transition-colors hover:text-orange-300 sm:text-3xl"
                        >
                          {link}
                          <ArrowUpRight
                            size={20}
                            className="opacity-0 transition-opacity group-hover:opacity-100"
                          />
                        </a>
                      </motion.li>
                    ))}
                  </ul>
                </div>
              ))}
            </div>
            <div className="border-t border-white/10 px-6 py-6 text-sm text-white/40 sm:px-8">
              505, Windfall, Sahar Plaza, Chakala, Andheri (East), Mumbai 400059
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
