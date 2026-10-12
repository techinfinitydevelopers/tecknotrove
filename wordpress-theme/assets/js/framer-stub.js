/* Minimal stand-in for the "framer" package, so Framer code components
   (like Modern Carousel) run outside Framer. They only need these exports
   to exist: property controls are editor-only, and we are never a static renderer. */
export function addPropertyControls() {}
export const ControlType = new Proxy({}, { get: (_t, key) => String(key) });
export function useIsStaticRenderer() { return false; }
export const RenderTarget = { current: () => "preview", canvas: "CANVAS", preview: "PREVIEW" };
export default {};
