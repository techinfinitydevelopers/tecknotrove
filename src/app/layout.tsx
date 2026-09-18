import type { Metadata } from "next";
import { Lato, JetBrains_Mono } from "next/font/google";
import SmoothScroll from "@/components/SmoothScroll";
import "./globals.css";

const lato = Lato({
  variable: "--font-lato",
  subsets: ["latin"],
  weight: ["300", "400", "700", "900"],
  display: "swap",
});

const mono = JetBrains_Mono({
  variable: "--font-mono-tech",
  subsets: ["latin"],
  weight: ["400", "500"],
  display: "swap",
});

export const metadata: Metadata = {
  title: "Tecknotrove | Precise Today. Perfect Tomorrow.",
  description:
    "Tecknotrove builds full-motion simulation and training technology for defence, aviation, driving and industrial sectors. 100% indigenous, 1500+ simulators delivered across 35+ countries since 2002.",
};

export default function RootLayout({ children }: LayoutProps<"/">) {
  return (
    <html
      lang="en"
      className={`${lato.variable} ${mono.variable} h-full antialiased`}
    >
      <body className="min-h-full flex flex-col bg-bg text-ink">
        <SmoothScroll />
        <div className="grain" aria-hidden="true" />
        {children}
      </body>
    </html>
  );
}
