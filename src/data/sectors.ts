export type SectorProduct = {
  name: string;
  desc: string;
  href?: string;
};

export type SectorTrustStat = { value: string; label: string };

export type Sector = {
  key: string;
  name: string;
  eyebrow: string;
  accent: string;
  accentSoft: string;
  h1: string;
  subhead: string;
  image: string;
  stats: { value: string; label: string }[];
  benefits: { title: string; desc: string }[];
  products: SectorProduct[];
  applicationsLabel: string;
  applicationsHeading: string;
  applicationsBody: string;
  applications: string[];
  technologyLabel: string;
  technologyHeading: string;
  technologyBody: string;
  technologyBullets: string[];
  trust?: {
    heading: string;
    body: string;
    stats: SectorTrustStat[];
  };
};

const BENEFITS = [
  {
    title: "Risk-Free Training",
    desc: "Train in hazardous scenarios without exposing personnel or equipment.",
  },
  {
    title: "Accelerated Learning",
    desc: "Repeat drills until muscle memory and confidence develop.",
  },
  {
    title: "Measurable Performance",
    desc: "Instructor dashboards, automated scoring, detailed reports.",
  },
  {
    title: "Lower Training Costs",
    desc: "Reduce fuel, maintenance and equipment downtime.",
  },
];

export const SECTORS: Sector[] = [
  {
    key: "defence",
    name: "Defence",
    eyebrow: "Tecknotrove Defence",
    accent: "#4d7a2a",
    accentSoft: "rgba(77,122,42,0.16)",
    h1: "Simulation systems built for the demands of armed forces.",
    subhead:
      "When the training environment fails to match the battlefield, operators pay the price. Our defence simulators don't compromise.",
    image: "/images/sector-defence.jpg",
    stats: [
      { value: "20+", label: "Years in Defence" },
      { value: "8", label: "Simulator Platforms" },
      { value: "6-DOF", label: "Motion Fidelity" },
      { value: "MIL-STD", label: "Compliance" },
    ],
    benefits: BENEFITS,
    products: [
      {
        name: "Tank Driving Simulator",
        desc: "Full-mission MBT training, convertible across T-72 / T-90 / Arjun.",
        href: "/products/tank-driving-simulator",
      },
      { name: "APC Crew Simulator", desc: "Troop compartment and driver training." },
      { name: "Field Artillery Simulator", desc: "Gunnery and fire-control training." },
      { name: "Small Arms Trainer", desc: "Marksmanship and weapon-handling drills." },
      { name: "Ship Bridge Simulator", desc: "Full-mission naval bridge simulation." },
      { name: "CBRN Trainer", desc: "Chemical, biological, radiological and nuclear response." },
      { name: "Military Helicopter Simulator", desc: "Rotary-wing flight and mission training." },
      { name: "UAV Operator Trainer", desc: "Unmanned aerial vehicle operation and reconnaissance." },
    ],
    applicationsLabel: "02 / Applications",
    applicationsHeading: "Training for conditions that operators actually face.",
    applicationsBody:
      "From first control familiarisation through certified assessment, every scenario is built to reflect real operational conditions.",
    applications: [
      "Control Familiarisation",
      "Night & NVG Driving",
      "Cross-Country Navigation",
      "Fault Injection Training",
      "Convoy & Formation",
      "Fording Operations",
      "Urban Operations",
      "Certified Assessment",
    ],
    technologyLabel: "03 / Technology",
    technologyHeading: "The engineering behind the realism.",
    technologyBody:
      "Motion platforms, visuals, controls and instructor software are engineered in-house and tuned specifically for armoured and tactical vehicle dynamics.",
    technologyBullets: [
      "220° field of view, 60+fps, day/dusk/night/NVG rendering",
      "6-DOF electric motion platform, <20ms latency",
      "Geo-typical terrain, including custom sites from client imagery",
      "Automated scoring, session recording and replay",
    ],
  },
  {
    key: "aviation",
    name: "Aviation",
    eyebrow: "Tecknotrove Aviation",
    accent: "#0091d1",
    accentSoft: "rgba(0,145,209,0.16)",
    h1: "Simulation systems that meet the standard of flight.",
    subhead:
      "From the flight deck to the apron, every Tecknotrove aviation simulator is built to the fidelity regulators and crews expect.",
    image: "/images/sector-aviation.jpg",
    stats: [
      { value: "15+", label: "Years in Aviation" },
      { value: "6", label: "Simulator Platforms" },
      { value: "DGCA", label: "Aligned Standards" },
      { value: "ISO 9001", label: "2015 Certified" },
    ],
    benefits: BENEFITS,
    products: [
      { name: "Fixed-Base Flight Simulator", desc: "Procedural and systems training for fixed-wing crews." },
      { name: "Full-Motion Flight Simulator", desc: "6-DOF full-mission flight training." },
      { name: "Helicopter Training Simulator", desc: "Rotary-wing procedures and emergency handling." },
      { name: "ATC Simulation System", desc: "Air traffic control training and coordination scenarios." },
      { name: "GSE Operator Simulator", desc: "Ground support equipment operator training." },
      { name: "Cabin Crew Trainer", desc: "Cabin procedures and emergency-response training." },
    ],
    applicationsLabel: "02 / Applications",
    applicationsHeading: "The scenarios your crews will actually face.",
    applicationsBody:
      "Procedural training through emergency response, built around the situations aviation crews and ground teams encounter on the job.",
    applications: [
      "Procedural Familiarisation",
      "Instrument Flight Rules",
      "Emergency Procedures",
      "Crew Resource Management",
      "Ground Handling Operations",
      "Adverse Weather Ops",
      "Night Operations",
      "Certified Assessment",
    ],
    technologyLabel: "03 / Technology",
    technologyHeading: "Fidelity that satisfies regulators — and pilots.",
    technologyBody:
      "Visual, motion and control-loading systems engineered in-house to match certified aircraft handling characteristics.",
    technologyBullets: [
      "High-fidelity out-the-window visuals with real airport databases",
      "6-DOF motion with tuned control-loading feel",
      "Configurable avionics and instrument panels",
      "Automated scoring, session recording and replay",
    ],
    trust: {
      heading: "A track record built flight by flight.",
      body: "Deployed across active aviation training programmes worldwide.",
      stats: [
        { value: "25+", label: "Countries with active deployments" },
        { value: "ISO 9001:2015", label: "Quality certified" },
        { value: "DGCA", label: "Aligned" },
        { value: "24/7", label: "Technical support" },
      ],
    },
  },
  {
    key: "automobile",
    name: "Driving",
    eyebrow: "Tecknotrove Driving",
    accent: "#ae1857",
    accentSoft: "rgba(174,24,87,0.16)",
    h1: "Driver training simulation for fleets that cannot afford mistakes.",
    subhead:
      "Passenger, commercial and emergency-response fleets trained on the hazards that cause real incidents — without the real risk.",
    image: "/images/sector-automobile.jpg",
    stats: [
      { value: "10+", label: "Years in Driver Training" },
      { value: "5", label: "Vehicle Platforms" },
      { value: "40%", label: "Avg. Incident Reduction" },
      { value: "ISO 9001", label: "2015 Certified" },
    ],
    benefits: BENEFITS,
    products: [
      { name: "Car & Light Vehicle Simulator", desc: "Passenger and light-fleet driver training." },
      { name: "Heavy Vehicle Simulator", desc: "Truck and heavy-commercial driver training." },
      { name: "Emergency Vehicle Simulator", desc: "Response driving under pressure, safely." },
      { name: "Bus & Coach Simulator", desc: "Passenger-service driver training." },
      { name: "Off-Road & Construction Simulator", desc: "Site-vehicle handling and hazard training." },
    ],
    applicationsLabel: "02 / Applications",
    applicationsHeading: "The situations that cause incidents — trained safely.",
    applicationsBody:
      "From basic control through hazard perception and emergency response, every scenario targets a real cause of on-road incidents.",
    applications: [
      "Control Familiarisation",
      "Hazard Perception",
      "Adverse Weather Driving",
      "Skid & Recovery Training",
      "Night Driving",
      "Emergency Response Driving",
      "Fuel-Efficient Driving",
      "Certified Assessment",
    ],
    technologyLabel: "03 / Technology",
    technologyHeading: "Vehicle dynamics that drivers actually trust.",
    technologyBody:
      "Physics-accurate vehicle models and motion cueing tuned per platform, so the feel behind the wheel matches the real vehicle.",
    technologyBullets: [
      "Physics-based vehicle dynamics per platform",
      "Motion cueing tuned to vehicle class",
      "Configurable road networks and traffic scenarios",
      "Automated scoring, session recording and replay",
    ],
    trust: {
      heading: "Measurable outcomes from day one.",
      body: "Deployed across fleet operators and driver-training institutes.",
      stats: [
        { value: "20+", label: "Countries deployed" },
        { value: "ISO 9001:2015", label: "Certified" },
        { value: "40%", label: "Avg. incident reduction" },
        { value: "24/7", label: "Technical support" },
      ],
    },
  },
  {
    key: "oesd",
    name: "OESD",
    eyebrow: "Tecknotrove OESD",
    accent: "#b87626",
    accentSoft: "rgba(184,118,38,0.16)",
    h1: "Operator training simulation for high-consequence industrial environments.",
    subhead:
      "Oil, energy, shipping and disaster-response operations, trained on the equipment and emergencies that matter most — before they happen.",
    image: "/images/sector-oesd.jpg",
    stats: [
      { value: "10+", label: "Years in Industrial" },
      { value: "4", label: "Sector Specialisations" },
      { value: "60%", label: "Avg. Incident Reduction" },
      { value: "ISO 9001", label: "2015 Certified" },
    ],
    benefits: BENEFITS,
    products: [
      { name: "Drilling & Well Control Simulator", desc: "Rig-floor operations and blowout-prevention training." },
      { name: "Mining Equipment Simulator", desc: "Heavy-plant operator training for mining sites." },
      { name: "Port & Crane Simulator", desc: "Container and cargo-crane operator training." },
      { name: "Power Plant Operator Trainer", desc: "Control-room operations and fault response." },
      { name: "Disaster Response Simulator", desc: "Emergency-response coordination training." },
    ],
    applicationsLabel: "02 / Applications",
    applicationsHeading: "The emergencies that operators must handle — before they happen.",
    applicationsBody:
      "Equipment familiarisation through full emergency response, replicating the high-consequence situations operators are trained to prevent.",
    applications: [
      "Equipment Familiarisation",
      "Fault & Failure Response",
      "Well Control Emergencies",
      "Confined-Space Operations",
      "Disaster Response Coordination",
      "Adverse Condition Operations",
      "Shift-Handover Procedures",
      "Certified Assessment",
    ],
    technologyLabel: "03 / Technology",
    technologyHeading: "Simulation that replicates the actual equipment.",
    technologyBody:
      "Control panels, instrumentation and physics models built to match the specific rig, plant or vessel an operator will actually run.",
    technologyBullets: [
      "Equipment-matched control panels and instrumentation",
      "Physics-based process and fault modelling",
      "Configurable site and emergency scenarios",
      "Automated scoring, session recording and replay",
    ],
    trust: {
      heading: "Trusted where the stakes are highest.",
      body: "Deployed across high-consequence industrial operations worldwide.",
      stats: [
        { value: "15+", label: "Countries deployed" },
        { value: "ISO 9001:2015", label: "Certified" },
        { value: "60%", label: "Avg. incident reduction" },
        { value: "24/7", label: "Technical support" },
      ],
    },
  },
];

export function getSector(key: string) {
  return SECTORS.find((s) => s.key === key);
}
