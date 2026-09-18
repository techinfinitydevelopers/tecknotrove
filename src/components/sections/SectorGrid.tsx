"use client";

import { useEffect, useRef } from "react";
import Image from "next/image";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import {
  ShieldChevron,
  AirplaneTilt,
  SteeringWheel,
  Factory,
  ArrowUpRight,
} from "@phosphor-icons/react";
import { RevealLines } from "@/components/ui/RevealText";

gsap.registerPlugin(ScrollTrigger);

const SECTORS = [
  {
    key: "defence",
    icon: ShieldChevron,
    name: "Defence",
    title: "Armoured Vehicles & Weapon Simulators",
    desc: "Tanks, IFVs, artillery and naval platforms, plus dedicated weapon-training systems.",
    image: "/images/sector-defence.jpg",
  },
  {
    key: "aviation",
    icon: AirplaneTilt,
    name: "Aviation",
    title: "Airport Ground Support Simulators",
    desc: "Baggage tractors, pushback tractors and towing vehicle training for ground crews.",
    image: "/images/sector-aviation.jpg",
  },
  {
    key: "automobile",
    icon: SteeringWheel,
    name: "Automobile",
    title: "Car, Truck & Emergency Fleets",
    desc: "Driver training for passenger, commercial and emergency-response fleets.",
    image: "/images/sector-automobile.jpg",
  },
  {
    key: "oesd",
    icon: Factory,
    name: "OESD",
    title: "Oil, Energy, Shipping & Disaster",
    desc: "Heavy plant, offshore and disaster-response training.",
    image: "/images/sector-oesd.jpg",
  },
];

export default function SectorGrid() {
  const listRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const container = listRef.current;
    if (!container) return;

    const mm = gsap.matchMedia();

    mm.add(
      {
        isRow: "(min-width: 640px)",
        reduced: "(prefers-reduced-motion: reduce)",
      },
      (ctx) => {
        const { isRow, reduced } = ctx.conditions as {
          isRow: boolean;
          reduced: boolean;
        };
        if (!isRow) return;

        // Motion is toned down rather than disabled, so the interaction still
        // works for people who ask for reduced motion.
        const dur = reduced ? 0.25 : 0.85;
        const ease = reduced ? "power2.out" : "elastic.out(1, 0.75)";
        const jitter = reduced ? 0 : 1;

        const cards = gsap.utils.toArray<HTMLElement>("[data-card]", container);
        const cardFaces = gsap.utils.toArray<HTMLElement>("[data-card-face]", container);
        const count = cards.length;
        let active = 0;

        cards.forEach((card) => {
          gsap.set(card, {
            xPercent: (Math.random() - 0.5) * 6 * jitter,
            yPercent: (Math.random() - 0.5) * 6 * jitter,
            rotation: (Math.random() - 0.5) * 8 * jitter,
          });
        });

        if (!reduced) {
          gsap.from(cards, {
            rotation: () => (Math.random() - 0.5) * 12,
            yPercent: "+=120",
            opacity: 0,
            duration: 1,
            ease: "elastic.out(1, 0.75)",
            stagger: 0.09,
            scrollTrigger: {
              trigger: container,
              start: "top 85%",
              once: true,
            },
          });
        }

        function activate(i: number) {
          gsap.to(cards[i], {
            xPercent: 0,
            yPercent: 0,
            rotation: 0,
            scale: 1.045,
            duration: dur,
            ease,
          });
          cardFaces.forEach((face, index) => {
            gsap.to(face, {
              xPercent: index === i ? 0 : 22 / (index - i),
              duration: dur,
              ease,
            });
          });
        }

        function scatter(i: number) {
          gsap.to(cards[i], {
            xPercent: (Math.random() - 0.5) * 6 * jitter,
            yPercent: (Math.random() - 0.5) * 6 * jitter,
            rotation: (Math.random() - 0.5) * 10 * jitter,
            scale: 1,
            duration: dur,
            ease,
          });
        }

        function onMove(e: MouseEvent) {
          const rect = container!.getBoundingClientRect();
          const pct = (e.clientX - rect.left) / rect.width;
          const next = Math.ceil(pct * count);
          if (next !== active && next > 0 && next <= count) {
            if (active !== 0) scatter(active - 1);
            active = next;
            activate(active - 1);
          }
        }

        function onLeave() {
          if (active > 0) scatter(active - 1);
          active = 0;
          gsap.to(cardFaces, { xPercent: 0, duration: dur, ease });
        }

        container!.addEventListener("mousemove", onMove);
        container!.addEventListener("mouseleave", onLeave);

        return () => {
          container!.removeEventListener("mousemove", onMove);
          container!.removeEventListener("mouseleave", onLeave);
        };
      }
    );

    return () => mm.revert();
  }, []);

  return (
    <section
      id="simulation"
      className="relative z-10 -mt-px overflow-hidden rounded-t-[2.5rem] bg-bg-elevated pb-28 pt-20 sm:rounded-t-[3rem] sm:pb-36 sm:pt-28"
    >
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <p className="mono-label mb-5 text-[11px] text-blue-500">
          Simulation Solutions
        </p>
        <div className="flex flex-col justify-between gap-6 md:flex-row md:items-end">
          <RevealLines
            as="h2"
            lines={["Built for the world's most", "demanding industries."]}
            className="max-w-2xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl"
          />
          <a
            href="#simulation"
            className="group flex shrink-0 items-center gap-2 text-sm font-semibold text-ink-dim transition-colors hover:text-orange-400"
          >
            View all simulation solutions
            <ArrowUpRight
              size={16}
              className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
            />
          </a>
        </div>

        <div
          ref={listRef}
          className="mt-14 flex flex-col gap-4 sm:flex-row sm:gap-0"
        >
          {SECTORS.map((s, i) => {
            const Icon = s.icon;
            return (
              <div
                key={s.key}
                data-card
                className="relative min-h-[320px] sm:-ml-3 sm:min-h-[430px] sm:flex-1 lg:min-h-[480px] first:sm:ml-0"
                style={{ zIndex: i }}
              >
                <div
                  data-card-face
                  className="group relative h-full overflow-hidden rounded-2xl border border-line bg-bg-panel p-5 shadow-[0_20px_45px_-24px_rgba(15,18,30,0.35)] lg:p-7"
                >
                  <div className="pointer-events-none absolute inset-0">
                    <Image
                      src={s.image}
                      alt=""
                      fill
                      sizes="(max-width: 640px) 100vw, 33vw"
                      className="object-cover"
                    />
                    {/* light scrim: opaque behind the copy, clear over the photo */}
                    <div
                      className="absolute inset-0"
                      style={{
                        background:
                          "linear-gradient(to top, rgb(233,238,251) 0%, rgb(233,238,251) 44%, rgba(233,238,251,0.55) 70%, rgba(233,238,251,0) 100%)",
                      }}
                    />
                  </div>

                  <div className="relative z-10 flex h-full flex-col">
                    <div className="flex h-11 w-11 items-center justify-center rounded-full border border-line-strong bg-bg/60 text-orange-400">
                      <Icon size={20} weight="duotone" />
                    </div>

                    <div className="mt-auto pt-10">
                      <p className="mono-label mb-2 text-[10.5px] text-ink-faint">
                        {s.name}
                      </p>
                      <h3 className="text-lg font-bold leading-snug lg:text-2xl">
                        {s.title}
                      </h3>
                      <p className="mt-2 hidden max-w-sm text-sm text-ink-dim lg:block">
                        {s.desc}
                      </p>
                      <span className="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-ink">
                        Discover
                        <ArrowUpRight size={15} />
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            );
          })}
        </div>
      </div>
    </section>
  );
}
