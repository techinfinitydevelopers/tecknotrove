export type Product = {
  slug: string;
  sectorKey: string;
  sectorName: string;
  name: string;
  code: string;
  h1: string;
  subhead: string;
  image: string;
  quickSpecs: { label: string; value: string }[];
  overviewLabel: string;
  overviewHeading: string;
  overviewParagraphs: string[];
  features: { title: string; desc: string }[];
  applications: { category: string; title: string }[];
  convertible: {
    label: string;
    heading: string;
    tags: string[];
    stat: string;
    statLabel: string;
  };
  specs: { label: string; value: string }[];
  faq: { q: string; a: string }[];
  related: { name: string; desc: string }[];
};

export const PRODUCTS: Product[] = [
  {
    slug: "tank-driving-simulator",
    sectorKey: "defence",
    sectorName: "Defence",
    name: "Tank Driving Simulator",
    code: "TDS-6F",
    h1: "Tank Driving Simulator.",
    subhead:
      "Real-world fidelity. Zero real-world risk. Full-mission MBT driver training, convertible across T-72, T-90 and Arjun.",
    image: "/images/sector-defence.jpg",
    quickSpecs: [
      { label: "Product", value: "TDS-6F" },
      { label: "Motion Platform", value: "6-DOF Electric" },
      { label: "Visual FoV", value: "220°×40°" },
      { label: "Latency", value: "<20ms" },
      { label: "Platforms", value: "T-72 · T-90 · Arjun" },
    ],
    overviewLabel: "Introduction",
    overviewHeading: "Full-mission MBT training system.",
    overviewParagraphs: [
      "The TDS-6F is a full-motion main battle tank driving simulator built to replicate the handling, terrain response and operational conditions of the T-72, T-90 and Arjun without putting a real vehicle, crew or training ground at risk.",
      "Every subsystem — motion platform, visuals, controls and instructor software — is engineered in-house by Tecknotrove, so the simulator ships as one integrated system rather than a stack of third-party vendors bolted together.",
      "A convertible cab kit lets a single unit be reconfigured between supported platforms in under 20 minutes, so training centres can run mixed-fleet programmes from one simulator instead of maintaining separate units per vehicle.",
    ],
    features: [
      {
        title: "High-Fidelity Visuals",
        desc: "220° FoV, 60+fps, day/dusk/night/NVG rendering, 4K resolution.",
      },
      {
        title: "Real-Time Physics",
        desc: "6-DOF motion platform with <20ms latency and accurate terrain and track modelling.",
      },
      {
        title: "Geo-Typical Terrain",
        desc: "Desert, jungle, urban and mountain terrain, with custom sites built from client imagery.",
      },
      {
        title: "Real-Time Assessment",
        desc: "Automated scoring, session reports, and full record & replay.",
      },
      {
        title: "Convertible Kit System",
        desc: "Swap between T-72, T-90 and Arjun cabs in under 20 minutes.",
      },
      {
        title: "Networked Group Training",
        desc: "One instructor station runs up to 4 networked simulators.",
      },
      {
        title: "ISO 9001:2015 Certified",
        desc: "Built and tested to MIL-STD safety compliance.",
      },
    ],
    applications: [
      { category: "Foundational", title: "Control Familiarisation" },
      { category: "Operations", title: "Night & NVG Driving" },
      { category: "Terrain", title: "Cross-Country Navigation" },
      { category: "Emergency", title: "Fault Injection Training" },
      { category: "Multi-Vehicle", title: "Convoy & Formation" },
      { category: "Specialist", title: "Fording Operations" },
      { category: "Urban", title: "Urban Operations" },
      { category: "Assessment", title: "Certified Assessment" },
    ],
    convertible: {
      label: "Supported Platforms",
      heading: "Convertible across multiple MBT variants.",
      tags: ["T-72", "T-90", "Arjun", "Custom OEM"],
      stat: "<20 minutes",
      statLabel: "to swap cab configuration",
    },
    specs: [
      { label: "Motion Platform", value: "6-DOF electric, <20ms latency" },
      { label: "Visual System", value: "220°×40° FoV, 60+fps, 4K, day/dusk/night/NVG" },
      { label: "Certification", value: "ISO 9001:2015, MIL-STD safety compliance" },
    ],
    faq: [
      {
        q: "What tank platforms does the simulator support?",
        a: "The TDS-6F ships with a convertible cab kit supporting T-72, T-90 and Arjun out of the box, with custom OEM configurations available on request.",
      },
      {
        q: "Is a motion platform mandatory, or can we opt for a static base?",
        a: "The 6-DOF electric motion platform is standard on the TDS-6F, but a static-base configuration is available for facilities with space or budget constraints — talk to our team about which fits your programme.",
      },
      {
        q: "Can the terrain be customised to match our actual training area?",
        a: "Yes. Alongside the standard desert, jungle, urban and mountain terrain sets, we build geo-typical custom terrain from client-supplied imagery and survey data.",
      },
      {
        q: "How does simulation reduce real-vehicle maintenance costs?",
        a: "Routine control familiarisation, fault-injection drills and repeat manoeuvres move off the real vehicle and onto the simulator, cutting fuel burn, track wear and scheduled maintenance hours on the actual fleet.",
      },
    ],
    related: [
      { name: "APC Crew Simulator", desc: "Troop compartment & driver training" },
      { name: "Field Artillery Simulator", desc: "Gunnery & fire control" },
      { name: "Ship Bridge Simulator", desc: "Full-mission bridge simulation" },
    ],
  },
];

export function getProduct(slug: string) {
  return PRODUCTS.find((p) => p.slug === slug);
}
