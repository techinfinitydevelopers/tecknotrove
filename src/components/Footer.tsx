import Image from "next/image";

const EXPLORE = ["Simulation", "Software", "About", "Careers", "Contact"];

const FOLLOW = [
  { label: "LinkedIn", href: "https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/" },
  { label: "YouTube", href: "https://youtu.be/hb-hqyMnMLw" },
  { label: "X", href: "#" },
];

export default function Footer() {
  return (
    <footer className="relative overflow-hidden bg-footer-bg pt-16 text-white">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="flex flex-col justify-between gap-8 sm:flex-row sm:items-start">
          <div className="min-w-0">
            <div className="relative text-[19vw] sm:text-[10vw] lg:text-[7.5rem]">
              <div className="pointer-events-none absolute right-[-0.14em] top-[-0.03em] h-[0.2em] w-[0.2em]">
                <Image src="/images/logo-mark.png" alt="" fill className="object-contain" />
              </div>
              <div className="overflow-hidden">
                <p
                  className="-ml-1 select-none whitespace-nowrap font-black uppercase leading-[0.82] tracking-tighter"
                  style={{
                    background:
                      "linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.55) 100%)",
                    WebkitBackgroundClip: "text",
                    backgroundClip: "text",
                    color: "transparent",
                  }}
                >
                  Tecknotrove
                </p>
              </div>
            </div>
            <p className="mt-3 text-[11px] text-white/35">
              &copy; {new Date().getFullYear()} Tecknotrove Systems India Pvt
              Ltd. All rights reserved.
            </p>
          </div>

          <div className="flex gap-16 sm:pt-2">
            <div>
              <p className="mono-label mb-4 text-[10.5px] text-white/35">
                Explore
              </p>
              <ul className="space-y-2.5">
                {EXPLORE.map((link) => (
                  <li key={link}>
                    <a
                      href="#simulation"
                      className="text-sm text-white/55 transition-colors hover:text-white"
                    >
                      {link}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
            <div>
              <p className="mono-label mb-4 text-[10.5px] text-white/35">
                Follow
              </p>
              <ul className="space-y-2.5">
                {FOLLOW.map((s) => (
                  <li key={s.label}>
                    <a
                      href={s.href}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="text-sm text-white/55 transition-colors hover:text-white"
                    >
                      {s.label}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </div>

        <div className="mt-10 border-t border-white/10 py-5">
          <p className="text-xs text-white/30">
            Precise today. Perfect tomorrow.
          </p>
        </div>
      </div>
    </footer>
  );
}
