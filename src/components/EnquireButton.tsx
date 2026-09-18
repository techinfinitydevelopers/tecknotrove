"use client";

import { useState } from "react";
import { motion, useScroll, useMotionValueEvent, AnimatePresence } from "motion/react";
import { PaperPlaneTilt } from "@phosphor-icons/react";
import MagneticButton from "@/components/ui/MagneticButton";

export default function EnquireButton() {
  const [visible, setVisible] = useState(false);
  const { scrollY } = useScroll();

  useMotionValueEvent(scrollY, "change", (v) => {
    setVisible(v > (typeof window !== "undefined" ? window.innerHeight * 0.7 : 600));
  });

  return (
    <AnimatePresence>
      {visible && (
        <motion.div
          initial={{ opacity: 0, y: 24, scale: 0.9 }}
          animate={{ opacity: 1, y: 0, scale: 1 }}
          exit={{ opacity: 0, y: 24, scale: 0.9 }}
          transition={{ duration: 0.35, ease: [0.16, 1, 0.3, 1] }}
          className="fixed bottom-6 right-5 z-50 sm:bottom-8 sm:right-8"
        >
          <MagneticButton
            href="#contact"
            variant="dark"
            className="shadow-[0_10px_40px_-8px_rgba(0,51,161,0.45)]"
          >
            <PaperPlaneTilt weight="fill" size={17} />
            Enquire Now
          </MagneticButton>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
