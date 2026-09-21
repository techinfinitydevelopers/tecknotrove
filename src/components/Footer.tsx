import Image from "next/image";
import { LinkedinLogo, YoutubeLogo, XLogo, EnvelopeSimple, Phone, MapPin } from "@phosphor-icons/react/ssr";

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

const SOCIALS = [
  { icon: LinkedinLogo, href: "https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/" },
  { icon: YoutubeLogo, href: "https://youtu.be/hb-hqyMnMLw" },
  { icon: XLogo, href: "#" },
];

export default function Footer() {
  return (
    <footer className="relative overflow-hidden bg-footer-bg pt-10 text-white">
      <div className="absolute inset-x-0 top-0 h-[2px] bg-orange" />
      <div
        className="pointer-events-none absolute inset-0 opacity-[0.5]"
        style={{
          backgroundImage:
            "linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px)",
          backgroundSize: "56px 56px",
          maskImage: "linear-gradient(to bottom, black, transparent 85%)",
        }}
      />

      <div className="relative mx-auto max-w-[1400px] px-5 sm:px-8">
        <div className="flex flex-col items-start justify-between gap-6 border-b border-white/10 pb-8 sm:flex-row sm:items-center">
          <div>
            <Image
              src="/images/logo-white.png"
              alt="Tecknotrove"
              width={158}
              height={40}
              className="h-7 w-auto"
            />
            <p className="mt-3 max-w-[280px] text-sm text-white/55">
              Simulation &amp; training technology for demanding industries,
              since 2002.
            </p>
          </div>
          <div className="flex gap-3">
            {SOCIALS.map(({ icon: Icon, href }, i) => (
              <a
                key={i}
                href={href}
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Social link"
                className="flex h-9 w-9 items-center justify-center rounded-full border border-white/15 text-white/60 transition-colors hover:border-orange/60 hover:text-orange-300"
              >
                <Icon size={16} weight="fill" />
              </a>
            ))}
          </div>
        </div>

        {/* oversized wordmark */}
        <div className="overflow-hidden border-b border-white/10 py-2 sm:py-3">
          <p
            className="select-none whitespace-nowrap text-[13vw] font-black uppercase leading-none tracking-tighter sm:text-[7vw] lg:text-[5rem]"
            style={{
              background:
                "linear-gradient(180deg, rgba(255,255,255,0.14) 0%, rgba(255,255,255,0.02) 100%)",
              WebkitBackgroundClip: "text",
              backgroundClip: "text",
              color: "transparent",
            }}
          >
            Tecknotrove
          </p>
        </div>

        <div className="grid grid-cols-2 gap-x-8 gap-y-10 border-b border-white/10 py-10 sm:grid-cols-4">
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

          <div className="col-span-2 sm:col-span-1">
            <p className="mono-label mb-5 text-[10.5px] text-white/35">
              Get in Touch
            </p>
            <ul className="space-y-3.5">
              <li>
                <a
                  href="tel:+912261513002"
                  className="group flex items-start gap-2.5 text-sm text-white/55 transition-colors hover:text-white"
                >
                  <Phone size={16} weight="duotone" className="mt-0.5 shrink-0 text-orange-300" />
                  +91 22 6151 3002
                </a>
              </li>
              <li>
                <a
                  href="https://www.tecknotrove.com"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="group flex items-start gap-2.5 text-sm text-white/55 transition-colors hover:text-white"
                >
                  <EnvelopeSimple size={16} weight="duotone" className="mt-0.5 shrink-0 text-orange-300" />
                  www.tecknotrove.com
                </a>
              </li>
              <li className="flex items-start gap-2.5 text-sm leading-relaxed text-white/55">
                <MapPin size={16} weight="duotone" className="mt-0.5 shrink-0 text-orange-300" />
                Andheri (East), Mumbai 400059
              </li>
            </ul>
          </div>
        </div>

        <div className="flex flex-col items-center justify-between gap-4 py-6 text-xs text-white/35 sm:flex-row">
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
