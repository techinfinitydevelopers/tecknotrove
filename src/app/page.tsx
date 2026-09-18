import Nav from "@/components/Nav";
import Footer from "@/components/Footer";
import EnquireButton from "@/components/EnquireButton";
import Hero from "@/components/sections/Hero";
import SectorGrid from "@/components/sections/SectorGrid";
import StatStrip from "@/components/sections/StatStrip";
import WhyTecknotrove from "@/components/sections/WhyTecknotrove";
import NewsInsights from "@/components/sections/NewsInsights";
import PartnerCareers from "@/components/sections/PartnerCareers";
import LinkedInSection from "@/components/sections/LinkedInSection";
import Callout from "@/components/sections/Callout";

export default function Home() {
  return (
    <>
      <Nav />
      <main className="flex-1">
        <Hero />
        <SectorGrid />
        <StatStrip />
        <WhyTecknotrove />
        <NewsInsights />
        <PartnerCareers />
        <LinkedInSection />
        <Callout />
      </main>
      <Footer />
      <EnquireButton />
    </>
  );
}
