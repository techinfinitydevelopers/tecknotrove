"use client";

import { cn } from "@/lib/utils";
import { useInView } from "./useInView";

export function RevealLines({
  lines,
  className,
  delayStart = 0,
  as: Tag = "h2",
}: {
  lines: string[];
  className?: string;
  delayStart?: number;
  as?: "h1" | "h2" | "h3" | "p";
}) {
  const { ref, inView } = useInView<HTMLDivElement>(0.1);

  return (
    <Tag ref={ref as never} className={cn("overflow-hidden", className)}>
      {lines.map((line, i) => (
        <span key={line} className="block overflow-hidden">
          <span
            className="block transition-transform duration-[900ms] ease-[cubic-bezier(0.16,1,0.3,1)]"
            style={{
              transform: inView ? "translateY(0%)" : "translateY(110%)",
              transitionDelay: `${delayStart + i * 0.09}s`,
            }}
          >
            {line}
          </span>
        </span>
      ))}
    </Tag>
  );
}

export function FadeUp({
  children,
  className,
  delay = 0,
  as: Tag = "div",
  href,
  style,
}: {
  children: React.ReactNode;
  className?: string;
  delay?: number;
  as?: "div" | "a";
  href?: string;
  style?: React.CSSProperties;
}) {
  const { ref, inView } = useInView<HTMLDivElement>(0.1);

  return (
    <Tag
      ref={ref as never}
      href={href}
      className={cn(
        "transition-[opacity,transform,box-shadow] duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]",
        className
      )}
      style={{
        ...style,
        opacity: inView ? 1 : 0,
        transform: inView ? undefined : "translateY(28px)",
        transitionDelay: `${delay}s`,
      }}
    >
      {children}
    </Tag>
  );
}
