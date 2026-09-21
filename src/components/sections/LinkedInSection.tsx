"use client";

import Image from "next/image";
import {
  LinkedinLogo,
  ArrowUpRight,
  ThumbsUp,
  ChatCircle,
  Repeat,
  PaperPlaneTilt,
  Globe,
} from "@phosphor-icons/react";
import { FadeUp } from "@/components/ui/RevealText";
import MagneticButton from "@/components/ui/MagneticButton";

const COMPANY_URL =
  "https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/";

const HASHTAGS = ["#Tecknotrove", "#CoalMining", "#MakeInIndia"];

const POSTS = [
  {
    time: "2d",
    text: "A single incident during training can cost a coal mine far more than most leaders account for: lost production, investigations, regulatory scrutiny, and above all, the human impact.",
    docTitle: "Tecknotrove_Coal_Mining_Incident_Reduction_HSE",
    pages: 4,
    reactions: 8,
    image: "/images/li-post-1.jpg",
    href: "https://www.linkedin.com/posts/tecknotrove-systems-i-pvt-ltd_tecknotrovecoalminingincidentreductionhse-activity-7506952375555739649-5lnD",
    // back card: sits at the origin, just a hint of tilt
    place:
      "z-10 sm:left-0 sm:top-0 sm:-rotate-3 sm:group-hover:-translate-x-3 sm:group-hover:-translate-y-3",
  },
  {
    time: "5d",
    text: "How long does it really take for a new operator to become productive? On-site training on live machines is slow and costly. Scenario-based simulation gets crews to full competency up to 4x faster.",
    docTitle: "Time-to-Competency_Tecknotrove",
    pages: 4,
    reactions: 6,
    image: "/images/li-post-2.jpg",
    href: "https://www.linkedin.com/posts/tecknotrove-systems-i-pvt-ltd_time-to-competencytecknotrove-activity-7505524623187488770-QzAV",
    // front card: a small corner peek, not a heavy overlap — the text needs
    // to stay readable on both cards without requiring a hover first
    place:
      "z-20 sm:left-[52px] sm:top-[44px] sm:rotate-3 sm:group-hover:translate-x-3 sm:group-hover:translate-y-3",
  },
];

export default function LinkedInSection() {
  return (
    <section className="bg-bg pb-24 pt-12 sm:pb-32 sm:pt-16">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="grid grid-cols-1 items-center gap-14 lg:grid-cols-[0.85fr_1.15fr] lg:gap-12">
          {/* account details */}
          <FadeUp>
            <p className="mono-label mb-5 text-[11px] text-blue-500">
              Latest from LinkedIn
            </p>
            <h2 className="max-w-xl text-4xl font-black leading-[1.08] tracking-tight sm:text-5xl">
              Join 9,000+ professionals following Tecknotrove.
            </h2>

            <div className="mt-10 flex items-center gap-4">
              <div className="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-brand text-white">
                <LinkedinLogo size={32} weight="fill" />
              </div>
              <div>
                <p className="text-lg font-bold text-ink">
                  Tecknotrove Systems (I) Pvt Ltd
                </p>
                <p className="text-sm text-ink-dim">
                  Defence · Aviation · Mining · Automotive
                </p>
              </div>
            </div>

            <div className="mt-8 flex gap-14 border-y border-line py-6">
              <div>
                <p className="font-mono text-4xl font-medium text-ink">9,232</p>
                <p className="mt-1 text-sm text-ink-dim">Followers</p>
              </div>
              <div>
                <p className="font-mono text-4xl font-medium text-ink">35+</p>
                <p className="mt-1 text-sm text-ink-dim">Countries reached</p>
              </div>
            </div>

            <div className="mt-8 flex flex-wrap gap-3">
              {HASHTAGS.map((h) => (
                <span
                  key={h}
                  className="rounded-full border border-line-strong px-4 py-2 text-sm font-medium text-ink-dim"
                >
                  {h}
                </span>
              ))}
            </div>

            <div className="mt-10 flex flex-wrap items-center gap-6">
              <MagneticButton href={COMPANY_URL} target="_blank" variant="dark">
                Follow Tecknotrove
              </MagneticButton>
              <a
                href={COMPANY_URL}
                target="_blank"
                rel="noopener noreferrer"
                className="group inline-flex items-center gap-2 text-base font-semibold text-ink-dim transition-colors hover:text-orange-400"
              >
                View all posts
                <ArrowUpRight
                  size={18}
                  className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                />
              </a>
            </div>
          </FadeUp>

          {/* stacked LinkedIn post cards */}
          <FadeUp delay={0.12}>
            <div className="group relative flex flex-col items-center gap-8 sm:mx-auto sm:block sm:h-[660px] sm:w-[432px]">
              {POSTS.map((p) => (
                <a
                  key={p.href}
                  href={p.href}
                  target="_blank"
                  rel="noopener noreferrer"
                  className={`relative flex w-full max-w-[380px] flex-col overflow-hidden rounded-xl border border-line-strong bg-white text-left shadow-[0_16px_36px_-14px_rgba(15,18,30,0.3)] transition-[transform,box-shadow] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] hover:z-30 hover:shadow-[0_28px_56px_-16px_rgba(15,18,30,0.4)] sm:absolute sm:w-[380px] ${p.place}`}
                >
                  {/* profile row */}
                  <div className="flex items-start gap-2.5 px-4 pt-4">
                    <Image
                      src="/images/li-logo.png"
                      alt=""
                      width={44}
                      height={44}
                      className="h-11 w-11 shrink-0 rounded-md object-cover"
                    />
                    <div className="min-w-0 flex-1">
                      <p className="truncate text-[13.5px] font-bold text-[#14161c]">
                        Tecknotrove Systems (I) Pvt Ltd
                      </p>
                      <p className="truncate text-xs text-[#565a6b]">
                        9,232 followers
                      </p>
                      <p className="mt-0.5 flex items-center gap-1 text-xs text-[#565a6b]">
                        {p.time}
                        <span aria-hidden="true">&middot;</span>
                        <Globe size={12} weight="fill" />
                      </p>
                    </div>
                  </div>

                  {/* post text */}
                  <p className="mt-2.5 line-clamp-3 px-4 text-[13.5px] leading-relaxed text-[#14161c]">
                    {p.text}
                  </p>

                  {/* document media */}
                  <div className="relative mt-3 aspect-[4/3] w-full bg-[#101c52]">
                    <Image
                      src={p.image}
                      alt=""
                      fill
                      sizes="(max-width: 640px) 92vw, 420px"
                      className="object-cover"
                    />
                  </div>
                  <div className="flex items-center justify-between border-b border-[#e6e7e8] bg-[#f3f4f7] px-4 py-2">
                    <span className="truncate text-[11.5px] font-medium text-[#565a6b]">
                      {p.docTitle}
                    </span>
                    <span className="mono-label shrink-0 text-[9.5px] text-[#8b8f9e]">
                      {p.pages} pages
                    </span>
                  </div>

                  {/* reaction summary */}
                  <div className="flex items-center gap-1.5 px-4 pt-2.5 text-xs text-[#565a6b]">
                    <span className="flex h-4 w-4 items-center justify-center rounded-full bg-blue-brand text-white">
                      <ThumbsUp size={10} weight="fill" />
                    </span>
                    {p.reactions}
                  </div>

                  {/* action bar */}
                  <div className="mt-2 grid grid-cols-4 gap-1 border-t border-[#e6e7e8] px-2 py-1.5">
                    {[
                      { icon: ThumbsUp, label: "Like" },
                      { icon: ChatCircle, label: "Comment" },
                      { icon: Repeat, label: "Repost" },
                      { icon: PaperPlaneTilt, label: "Send" },
                    ].map(({ icon: Icon, label }) => (
                      <span
                        key={label}
                        className="flex items-center justify-center gap-1.5 rounded-md py-2 text-[11.5px] font-semibold text-[#565a6b]"
                      >
                        <Icon size={15} />
                        <span className="hidden sm:inline">{label}</span>
                      </span>
                    ))}
                  </div>
                </a>
              ))}
            </div>
          </FadeUp>
        </div>
      </div>
    </section>
  );
}
