import type { Metadata } from "next";
import { notFound } from "next/navigation";
import Image from "next/image";
import Link from "next/link";
import {
  Eye,
  Gauge,
  MapTrifold,
  ChartBar,
  ArrowsClockwise,
  UsersThree,
  SealCheck,
  ArrowUpRight,
  Cube,
  Monitor,
  SteeringWheel,
  Aperture,
  Waveform,
} from "@phosphor-icons/react/ssr";
import Nav from "@/components/Nav";
import Footer from "@/components/Footer";
import EnquireButton from "@/components/EnquireButton";
import MagneticButton from "@/components/ui/MagneticButton";
import { FadeUp, RevealLines } from "@/components/ui/RevealText";
import Faq from "@/components/product/Faq";
import { PRODUCTS, getProduct } from "@/data/products";

const FEATURE_ICONS = [Eye, Gauge, MapTrifold, ChartBar, ArrowsClockwise, UsersThree, SealCheck];
const GALLERY_ICONS = [Monitor, SteeringWheel, Aperture, Waveform];

export function generateStaticParams() {
  return PRODUCTS.map((p) => ({ slug: p.slug }));
}

export async function generateMetadata({
  params,
}: {
  params: Promise<{ slug: string }>;
}): Promise<Metadata> {
  const { slug } = await params;
  const product = getProduct(slug);
  if (!product) return {};
  return {
    title: `${product.name} | Tecknotrove`,
    description: product.subhead,
  };
}

export default async function ProductPage({
  params,
}: {
  params: Promise<{ slug: string }>;
}) {
  const { slug } = await params;
  const product = getProduct(slug);
  if (!product) notFound();

  return (
    <>
      <Nav />
      <main className="flex-1">
        {/* HERO */}
        <section className="relative flex h-[80vh] min-h-[520px] flex-col justify-end overflow-hidden text-white">
          <div className="absolute inset-0">
            <Image src={product.image} alt="" fill priority sizes="100vw" className="object-cover" />
            <div className="absolute inset-0 bg-gradient-to-t from-[#050916] via-[#050916]/70 to-[#050916]/40" />
          </div>

          <div className="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-16 pt-32 sm:px-8 sm:pb-20">
            <p className="mono-label mb-6 flex flex-wrap items-center gap-2 text-[10.5px] text-white/55">
              <Link href="/#simulation" className="hover:text-white">
                Simulation
              </Link>
              <span>/</span>
              <Link href={`/${product.sectorKey}`} className="hover:text-white">
                {product.sectorName}
              </Link>
              <span>/</span>
              <span className="text-orange-300">{product.name}</span>
            </p>

            <h1 className="max-w-2xl text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl">
              {product.h1}
            </h1>
            <p className="mt-6 max-w-lg text-base text-white/75 sm:text-lg">
              {product.subhead}
            </p>

            <div className="mt-9 flex flex-wrap items-center gap-4">
              <MagneticButton href="#contact" variant="solid">
                Get in Touch
              </MagneticButton>
              <MagneticButton href="#brochure" variant="outline-light">
                Download Brochure
              </MagneticButton>
            </div>
          </div>
        </section>

        {/* QUICK SPECS BAND */}
        <section className="bg-blue-950 py-8 text-white">
          <div className="mx-auto grid max-w-[1400px] grid-cols-2 gap-x-6 gap-y-6 px-5 sm:px-8 md:grid-cols-5">
            {product.quickSpecs.map((s, i) => (
              <div
                key={s.label}
                className={`text-center md:text-left ${
                  i > 0 ? "md:border-l md:border-white/10 md:pl-6" : ""
                }`}
              >
                <p className="mono-label text-[10px] text-white/40">{s.label}</p>
                <p className="mt-1.5 font-mono text-sm font-medium sm:text-base">
                  {s.value}
                </p>
              </div>
            ))}
          </div>
        </section>

        {/* OVERVIEW */}
        <section id="introduction" className="bg-bg py-20 sm:py-24">
          <div className="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
            <div>
              <p className="mono-label mb-5 text-[11px] text-blue-500">
                {product.overviewLabel}
              </p>
              <RevealLines
                as="h2"
                lines={[product.overviewHeading]}
                className="max-w-xl text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl"
              />
              <div className="mt-6 max-w-xl space-y-4">
                {product.overviewParagraphs.map((p) => (
                  <p key={p} className="text-base text-ink-dim">
                    {p}
                  </p>
                ))}
              </div>
            </div>
            <FadeUp delay={0.1} className="relative aspect-[4/3] overflow-hidden rounded-2xl">
              <Image
                src={product.image}
                alt=""
                fill
                sizes="(max-width: 1024px) 100vw, 50vw"
                className="object-cover"
              />
            </FadeUp>
          </div>
        </section>

        {/* KEY FEATURES */}
        <section id="key-features" className="bg-bg-elevated py-20 sm:py-24">
          <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
            <RevealLines
              as="h2"
              lines={["What sets it apart."]}
              className="text-3xl font-black tracking-tight sm:text-4xl"
            />
            <div className="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
              {product.features.map((f, i) => {
                const Icon = FEATURE_ICONS[i % FEATURE_ICONS.length];
                return (
                  <FadeUp
                    key={f.title}
                    delay={i * 0.05}
                    className="rounded-2xl border border-line bg-bg p-6"
                  >
                    <div className="flex h-11 w-11 items-center justify-center rounded-full bg-bg-panel text-blue-500">
                      <Icon size={20} weight="duotone" />
                    </div>
                    <h3 className="mt-5 text-lg font-bold">{f.title}</h3>
                    <p className="mt-2 text-sm text-ink-dim">{f.desc}</p>
                  </FadeUp>
                );
              })}
            </div>
          </div>
        </section>

        {/* APPLICATIONS */}
        <section id="applications" className="bg-bg py-20 sm:py-24">
          <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
            <p className="mono-label mb-5 text-[11px] text-blue-500">
              What operators train for
            </p>
            <RevealLines
              as="h2"
              lines={["Applications."]}
              className="text-3xl font-black tracking-tight sm:text-4xl"
            />
            <div className="mt-12 grid grid-cols-2 gap-3 sm:grid-cols-4">
              {product.applications.map((a, i) => (
                <FadeUp
                  key={a.title}
                  delay={i * 0.04}
                  className="rounded-xl border border-line bg-bg-elevated px-5 py-4"
                >
                  <p className="mono-label text-[9.5px] text-ink-faint">{a.category}</p>
                  <p className="mt-1.5 text-sm font-semibold text-ink">{a.title}</p>
                </FadeUp>
              ))}
            </div>
          </div>
        </section>

        {/* CONVERTIBLE KITS */}
        <section
          className="relative overflow-hidden py-20 text-white sm:py-24"
          style={{ background: "linear-gradient(160deg, var(--blue-brand), var(--blue-950))" }}
        >
          <div
            className="pointer-events-none absolute inset-0 opacity-[0.15]"
            style={{
              backgroundImage:
                "radial-gradient(rgba(255,255,255,0.9) 1px, transparent 1px)",
              backgroundSize: "22px 22px",
              maskImage:
                "radial-gradient(ellipse 70% 60% at 80% 20%, black 0%, transparent 75%)",
            }}
          />
          <div className="relative z-10 mx-auto max-w-[1400px] px-5 sm:px-8">
            <p className="mono-label mb-5 text-[11px] text-orange-300">
              {product.convertible.label}
            </p>
            <RevealLines
              as="h2"
              lines={[product.convertible.heading]}
              className="max-w-2xl text-3xl font-black leading-[1.08] tracking-tight sm:text-5xl"
            />
            <div className="mt-8 flex flex-wrap gap-3">
              {product.convertible.tags.map((t) => (
                <span
                  key={t}
                  className="rounded-full border border-white/25 px-4 py-2 text-sm font-medium"
                >
                  {t}
                </span>
              ))}
            </div>
            <div className="mt-12 border-t border-white/10 pt-8">
              <p className="font-mono text-4xl font-medium sm:text-5xl">
                {product.convertible.stat}
              </p>
              <p className="mt-2 text-sm text-white/60">
                {product.convertible.statLabel}
              </p>
            </div>
          </div>
        </section>

        {/* TMS CALLOUT */}
        <section id="software-features" className="bg-bg-elevated py-20 sm:py-24">
          <div className="mx-auto grid max-w-[1400px] grid-cols-1 items-center gap-12 px-5 sm:px-8 lg:grid-cols-2 lg:gap-16">
            <div>
              <p className="mono-label mb-5 text-[11px] text-blue-500">
                Integrated Software
              </p>
              <RevealLines
                as="h2"
                lines={["Comes with Tecknotrove TMS."]}
                className="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl"
              />
              <p className="mt-6 max-w-md text-base text-ink-dim">
                Every simulator ships with our in-house Training Management
                System — instructor scenario control, automated scoring
                and session reports, out of the box.
              </p>
              <div className="mt-8">
                <MagneticButton href="/#software" variant="outline">
                  Explore TMS
                </MagneticButton>
              </div>
            </div>
            <FadeUp
              delay={0.1}
              className="flex aspect-[4/3] flex-col justify-between rounded-2xl bg-[#0e0e11] p-8 text-white"
            >
              <div className="flex items-center justify-between">
                <span className="mono-label text-[10px] text-white/40">
                  TMS · Session Monitor
                </span>
                <span className="h-2 w-2 rounded-full bg-orange" />
              </div>
              <div className="grid grid-cols-3 gap-3">
                {[92, 78, 85].map((v) => (
                  <div key={v} className="rounded-lg bg-white/5 p-4">
                    <p className="font-mono text-2xl font-medium">{v}%</p>
                    <p className="mt-1 text-[11px] text-white/40">Score</p>
                  </div>
                ))}
              </div>
              <div className="h-16 rounded-lg bg-white/5" />
            </FadeUp>
          </div>
        </section>

        {/* SPECIFICATIONS */}
        <section id="specifications" className="bg-bg py-20 sm:py-24">
          <div className="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[1fr_0.9fr] lg:gap-16">
            <div>
              <p className="mono-label mb-5 text-[11px] text-blue-500">
                Key Specifications
              </p>
              <RevealLines
                as="h2"
                lines={["Built to exacting standards."]}
                className="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl"
              />
              <div className="mt-8 divide-y divide-line border-y border-line">
                {product.specs.map((s) => (
                  <div key={s.label} className="flex flex-col gap-1 py-4 sm:flex-row sm:justify-between">
                    <span className="text-sm font-semibold text-ink">{s.label}</span>
                    <span className="text-sm text-ink-dim">{s.value}</span>
                  </div>
                ))}
              </div>
            </div>

            <FadeUp delay={0.1} className="rounded-2xl bg-blue-brand p-8 text-white sm:p-10">
              <p className="mono-label text-[10.5px] text-orange-300">
                Full Specifications
              </p>
              <h3 className="mt-4 text-xl font-bold leading-snug">
                Every system is configured to your exact requirements.
              </h3>
              <p className="mt-3 text-sm text-white/70">
                Share your training objectives and site constraints, and our
                engineering team will send the full specification sheet for
                the {product.name}.
              </p>
              <div className="mt-7">
                <MagneticButton href="#contact" variant="light">
                  Request Full Specifications
                </MagneticButton>
              </div>
            </FadeUp>
          </div>
        </section>

        {/* GALLERY */}
        <section id="gallery" className="bg-bg-elevated py-20 sm:py-24">
          <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
            <p className="mono-label mb-5 text-[11px] text-blue-500">Gallery</p>
            <RevealLines
              as="h2"
              lines={["Full System View."]}
              className="text-3xl font-black tracking-tight sm:text-4xl"
            />
            <div className="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
              <FadeUp className="relative col-span-1 aspect-[4/3] overflow-hidden rounded-2xl sm:col-span-2 lg:col-span-2 lg:row-span-2 lg:aspect-auto">
                <Image
                  src={product.image}
                  alt=""
                  fill
                  sizes="(max-width: 640px) 100vw, (max-width: 1024px) 100vw, 66vw"
                  className="object-cover"
                />
              </FadeUp>
              {[
                "Operator Cab Interior",
                "Visual System — NVG Mode",
                "6-DOF Motion Platform",
                "AIOS Console",
              ].map((label, i) => {
                const Icon = GALLERY_ICONS[i % GALLERY_ICONS.length];
                return (
                  <FadeUp
                    key={label}
                    delay={i * 0.06}
                    className="flex aspect-[4/3] flex-col justify-end rounded-2xl p-6 text-white"
                    style={{
                      background:
                        "linear-gradient(160deg, var(--blue-500), var(--blue-950))",
                    }}
                  >
                    <Icon size={28} weight="light" className="mb-auto text-white/50" />
                    <p className="text-sm font-semibold">{label}</p>
                  </FadeUp>
                );
              })}
            </div>
          </div>
        </section>

        {/* FAQ */}
        <section id="faq" className="bg-bg py-20 sm:py-24">
          <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
            <p className="mono-label mb-5 text-[11px] text-blue-500">FAQ</p>
            <RevealLines
              as="h2"
              lines={["Common questions."]}
              className="mb-10 text-3xl font-black tracking-tight sm:text-4xl"
            />
            <Faq items={product.faq} />
          </div>
        </section>

        {/* RELATED PRODUCTS */}
        <section className="bg-bg-elevated py-20 sm:py-24">
          <div className="mx-auto max-w-[1400px] px-5 sm:px-8">
            <div className="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
              <RevealLines
                as="h2"
                lines={[`Explore other ${product.sectorName} simulators.`]}
                className="max-w-xl text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl"
              />
              <Link
                href={`/${product.sectorKey}#products`}
                className="group hidden shrink-0 items-center gap-2 text-sm font-semibold text-ink-dim transition-colors hover:text-orange-400 sm:flex"
              >
                {`All ${product.sectorName} products`}
                <ArrowUpRight
                  size={16}
                  className="transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                />
              </Link>
            </div>
            <div className="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
              {product.related.map((r, i) => (
                <FadeUp
                  key={r.name}
                  delay={i * 0.06}
                  className="rounded-2xl border border-line bg-bg p-6"
                >
                  <div className="flex h-11 w-11 items-center justify-center rounded-full bg-bg-panel text-blue-500">
                    <Cube size={20} weight="duotone" />
                  </div>
                  <h3 className="mt-5 text-lg font-bold">{r.name}</h3>
                  <p className="mt-2 text-sm text-ink-dim">{r.desc}</p>
                </FadeUp>
              ))}
            </div>
          </div>
        </section>

        {/* CALLOUT */}
        <section id="contact" className="relative overflow-hidden bg-orange py-20 text-[#170800] sm:py-24">
          <div className="relative z-10 mx-auto max-w-[1400px] px-5 text-center sm:px-8">
            <RevealLines
              as="h2"
              lines={[`See the ${product.code} in action.`]}
              className="mx-auto max-w-2xl text-4xl font-black leading-[1.05] tracking-tight sm:text-6xl"
            />
            <FadeUp delay={0.15}>
              <div className="mt-9 flex flex-wrap items-center justify-center gap-4">
                <MagneticButton href="tel:+912261513002" variant="dark" sweep="blue">
                  Get in Touch
                </MagneticButton>
                <MagneticButton href="#brochure" variant="outline-dark" sweep="blue">
                  Download Brochure
                </MagneticButton>
              </div>
            </FadeUp>
          </div>
        </section>
      </main>
      <Footer />
      <EnquireButton />
    </>
  );
}
