import type { Metadata } from "next";
import Nav from "@/components/Nav";
import Footer from "@/components/Footer";
import EnquireButton from "@/components/EnquireButton";
import NewsInsights from "@/components/sections/NewsInsights";
import LinkedInSection from "@/components/sections/LinkedInSection";
import SectorHero from "@/components/sector/SectorHero";
import SectorStatStrip from "@/components/sector/SectorStatStrip";
import SectorProducts from "@/components/sector/SectorProducts";
import SectorApplications from "@/components/sector/SectorApplications";
import SectorTechnology from "@/components/sector/SectorTechnology";
import SectorTrust from "@/components/sector/SectorTrust";
import SectorCallout from "@/components/sector/SectorCallout";
import { getSector } from "@/data/sectors";

const sector = getSector("oesd")!;

export const metadata: Metadata = {
  title: "Industrial (OESD) Simulation | Tecknotrove",
  description: sector.subhead,
};

export default function OesdPage() {
  return (
    <>
      <Nav />
      <main className="flex-1">
        <SectorHero sector={sector} />
        <SectorStatStrip sector={sector} />
        <SectorProducts sector={sector} />
        <SectorApplications sector={sector} />
        <SectorTechnology sector={sector} />
        <SectorTrust sector={sector} />
        <NewsInsights />
        <LinkedInSection />
        <SectorCallout sector={sector} />
      </main>
      <Footer />
      <EnquireButton />
    </>
  );
}
