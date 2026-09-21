import type { Metadata } from "next";
import Nav from "@/components/Nav";
import Footer from "@/components/Footer";
import EnquireButton from "@/components/EnquireButton";
import NewsInsights from "@/components/sections/NewsInsights";
import LinkedInSection from "@/components/sections/LinkedInSection";
import SectorHero from "@/components/sector/SectorHero";
import SectorStatStrip from "@/components/sector/SectorStatStrip";
import SectorBenefits from "@/components/sector/SectorBenefits";
import SectorProducts from "@/components/sector/SectorProducts";
import SectorApplications from "@/components/sector/SectorApplications";
import SectorTechnology from "@/components/sector/SectorTechnology";
import SectorCallout from "@/components/sector/SectorCallout";
import { getSector } from "@/data/sectors";

const sector = getSector("defence")!;

export const metadata: Metadata = {
  title: "Defence Simulation | Tecknotrove",
  description: sector.subhead,
};

export default function DefencePage() {
  return (
    <>
      <Nav />
      <main className="flex-1">
        <SectorHero sector={sector} />
        <SectorStatStrip sector={sector} />
        <SectorBenefits sector={sector} />
        <SectorProducts sector={sector} />
        <SectorApplications sector={sector} />
        <SectorTechnology sector={sector} />
        <NewsInsights />
        <LinkedInSection />
        <SectorCallout sector={sector} />
      </main>
      <Footer />
      <EnquireButton />
    </>
  );
}
