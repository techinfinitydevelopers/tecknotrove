import type { Metadata } from "next";
import Footer from "@/components/Footer";
import EnquireButton from "@/components/EnquireButton";
import AviationExperience from "@/components/aviation/AviationExperience";
import { getSector } from "@/data/sectors";

const sector = getSector("aviation")!;

export const metadata: Metadata = {
  title: "Aviation Simulation | Tecknotrove",
  description: sector.subhead,
};

export default function AviationPage() {
  return (
    <>
      <AviationExperience sector={sector} />
      <Footer />
      <EnquireButton />
    </>
  );
}
