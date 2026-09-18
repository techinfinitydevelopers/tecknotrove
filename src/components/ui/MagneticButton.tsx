"use client";

import { useRef } from "react";
import { motion, useMotionValue, useSpring } from "motion/react";
import { cn } from "@/lib/utils";

const SWEEP_COLORS: Record<string, { bg: string; text: string }> = {
  orange: { bg: "var(--orange)", text: "#170800" },
  blue: { bg: "var(--blue-brand)", text: "#ffffff" },
  dark: { bg: "#15161c", text: "#ffffff" },
};

export default function MagneticButton({
  children,
  className,
  href,
  onClick,
  target,
  variant = "solid",
  sweep = "orange",
}: {
  children: React.ReactNode;
  className?: string;
  href?: string;
  onClick?: () => void;
  target?: string;
  variant?: "solid" | "outline" | "outline-light" | "dark" | "outline-dark" | "light";
  sweep?: "orange" | "blue" | "dark";
}) {
  const ref = useRef<HTMLAnchorElement | HTMLButtonElement>(null);
  const x = useMotionValue(0);
  const y = useMotionValue(0);
  const sx = useSpring(x, { stiffness: 200, damping: 15, mass: 0.4 });
  const sy = useSpring(y, { stiffness: 200, damping: 15, mass: 0.4 });

  function handleMove(e: React.MouseEvent) {
    const el = ref.current;
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const relX = e.clientX - rect.left - rect.width / 2;
    const relY = e.clientY - rect.top - rect.height / 2;
    x.set(relX * 0.35);
    y.set(relY * 0.5);
  }

  function handleLeave() {
    x.set(0);
    y.set(0);
  }

  const base =
    "group relative isolate inline-flex items-center justify-center gap-2 overflow-hidden rounded-full px-7 py-3.5 text-sm font-bold tracking-wide whitespace-nowrap transition-colors duration-300";

  const styleMap: Record<string, string> = {
    solid: "bg-[#15161c] text-white",
    dark: "bg-[#15161c] text-white",
    light: "bg-white text-nav-bg",
    outline: "border border-line-strong bg-transparent text-ink group-hover:border-transparent",
    "outline-light":
      "border border-white/35 bg-transparent text-white group-hover:border-transparent",
    "outline-dark":
      "border border-[#170800]/35 bg-transparent text-[#170800] group-hover:border-transparent",
  };
  const styles = styleMap[variant];
  const sweepColor = SWEEP_COLORS[sweep];

  const Comp: React.ElementType = href ? motion.a : motion.button;

  return (
    <Comp
      ref={ref as never}
      href={href}
      target={target}
      rel={target ? "noopener noreferrer" : undefined}
      onClick={onClick}
      onMouseMove={handleMove}
      onMouseLeave={handleLeave}
      style={{ x: sx, y: sy }}
      whileTap={{ scale: 0.96 }}
      className={cn(base, styles, className)}
    >
      <span
        aria-hidden="true"
        className="absolute inset-0 origin-left scale-x-0 transition-transform duration-500 ease-[cubic-bezier(0.65,0,0.35,1)] group-hover:scale-x-100"
        style={{ background: sweepColor.bg }}
      />
      <span
        className={cn(
          "relative z-10 flex items-center gap-2 transition-colors duration-300",
          sweep === "orange" ? "group-hover:text-[#170800]" : "group-hover:text-white"
        )}
      >
        {children}
      </span>
    </Comp>
  );
}
