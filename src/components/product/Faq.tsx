"use client";

import { useState } from "react";
import { Plus } from "@phosphor-icons/react";
import { cn } from "@/lib/utils";

export default function Faq({ items }: { items: { q: string; a: string }[] }) {
  const [open, setOpen] = useState<number | null>(0);

  return (
    <div className="divide-y divide-line border-y border-line">
      {items.map((item, i) => {
        const isOpen = open === i;
        return (
          <div key={item.q}>
            <button
              onClick={() => setOpen(isOpen ? null : i)}
              className="flex w-full items-center justify-between gap-6 py-6 text-left"
            >
              <span className="text-base font-bold sm:text-lg">{item.q}</span>
              <Plus
                size={20}
                className={cn(
                  "shrink-0 text-ink-dim transition-transform duration-300",
                  isOpen && "rotate-45"
                )}
              />
            </button>
            <div
              className="grid overflow-hidden transition-[grid-template-rows] duration-400 ease-[cubic-bezier(0.16,1,0.3,1)]"
              style={{ gridTemplateRows: isOpen ? "1fr" : "0fr" }}
            >
              <div className="overflow-hidden">
                <p className="max-w-2xl pb-6 text-sm leading-relaxed text-ink-dim">
                  {item.a}
                </p>
              </div>
            </div>
          </div>
        );
      })}
    </div>
  );
}
