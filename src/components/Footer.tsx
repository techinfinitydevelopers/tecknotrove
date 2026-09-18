import Image from "next/image";
import { LinkedinLogo, YoutubeLogo, XLogo } from "@phosphor-icons/react/ssr";

const COLUMNS = [
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
    links: ["About", "Careers", "News", "Contact"],
  },
];

export default function Footer() {
  return (
    <footer className="bg-footer-bg pt-20 text-white">
      <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="grid grid-cols-2 gap-10 border-b border-white/10 pb-16 md:grid-cols-5">
          <div className="col-span-2">
            <Image
              src="/images/logo-white.png"
              alt="Tecknotrove"
              width={158}
              height={40}
              className="h-8 w-auto"
            />
            <p className="mt-4 max-w-[240px] text-sm text-white/55">
              Precise today. Perfect tomorrow.
            </p>
            <div className="mt-6 flex gap-3">
              {[LinkedinLogo, YoutubeLogo, XLogo].map((Icon, i) => (
                <a
                  key={i}
                  href="#"
                  aria-label="Social link"
                  className="flex h-9 w-9 items-center justify-center rounded-full border border-white/15 text-white/60 transition-colors hover:border-orange/60 hover:text-orange-300"
                >
                  <Icon size={16} weight="fill" />
                </a>
              ))}
            </div>
          </div>

          {COLUMNS.map((col) => (
            <div key={col.title}>
              <p className="mono-label mb-5 text-[10.5px] text-white/35">
                {col.title}
              </p>
              <ul className="space-y-3">
                {col.links.map((link) => (
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
          ))}
        </div>

        <div className="flex flex-col items-center justify-between gap-4 py-8 text-xs text-white/35 sm:flex-row">
          <p>&copy; {new Date().getFullYear()} Tecknotrove Systems India Pvt Ltd.</p>
          <div className="flex gap-6">
            <a href="#privacy" className="hover:text-white/60">
              Privacy Policy
            </a>
            <a href="#terms" className="hover:text-white/60">
              Terms
            </a>
          </div>
        </div>
      </div>
    </footer>
  );
}
