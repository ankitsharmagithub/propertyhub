/* ==========================================================================
   AUREATE ESTATES — GSAP Motion System
   ========================================================================== */

document.addEventListener("DOMContentLoaded", () => {
  if (!window.gsap) return;
  gsap.registerPlugin(ScrollTrigger);

  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (reduceMotion) {
    document.querySelectorAll(".reveal-up, .hero-title .line span").forEach(el => {
      el.style.opacity = 1; el.style.transform = "none";
    });
    return;
  }

  /* ---- Hero text reveal ---- */
  gsap.timeline({ delay: 0.2 })
    .from(".hero-kicker", { opacity: 0, y: 16, duration: 0.7, ease: "power3.out" })
    .from(".hero-title .line span", {
      yPercent: 120, opacity: 0, duration: 1, ease: "power4.out", stagger: 0.12
    }, "-=0.35")
    .from(".hero-sub", { opacity: 0, y: 20, duration: 0.8, ease: "power3.out" }, "-=0.5")
    .from(".search-panel", { opacity: 0, y: 30, duration: 0.9, ease: "power3.out" }, "-=0.4")
    .from(".hero-scroll-cue", { opacity: 0, duration: 0.6 }, "-=0.4");

  gsap.to(".hero-media img", { scale: 1.12, duration: 8, ease: "none" });

  /* ---- Generic fade-up reveals on scroll ---- */
  document.querySelectorAll(".reveal-up").forEach(el => {
    gsap.to(el, {
      opacity: 1, y: 0, duration: 0.9, ease: "power3.out",
      scrollTrigger: { trigger: el, start: "top 88%" }
    });
  });

  gsap.utils.toArray(".stagger-group").forEach(group => {
    gsap.from(group.children, {
      opacity: 0, y: 36, duration: 0.8, stagger: 0.12, ease: "power3.out",
      scrollTrigger: { trigger: group, start: "top 85%" }
    });
  });

  /* ---- Section eyebrow + title reveal ---- */
  gsap.utils.toArray(".section-head, .section-title, .eyebrow").forEach(el => {
    if (el.closest(".hero")) return;
    gsap.from(el, {
      opacity: 0, y: 24, duration: 0.8, ease: "power3.out",
      scrollTrigger: { trigger: el, start: "top 90%" }
    });
  });

  /* ---- Counters ---- */
  document.querySelectorAll("[data-counter]").forEach(el => {
    const target = parseFloat(el.dataset.counter);
    const obj = { val: 0 };
    ScrollTrigger.create({
      trigger: el,
      start: "top 90%",
      once: true,
      onEnter: () => {
        gsap.to(obj, {
          val: target, duration: 2, ease: "power2.out",
          onUpdate: () => { el.textContent = Math.floor(obj.val).toLocaleString(); }
        });
      }
    });
  });

  /* ---- Editorial image parallax ---- */
  gsap.utils.toArray(".parallax-img").forEach(img => {
    gsap.to(img, {
      yPercent: 14, ease: "none",
      scrollTrigger: { trigger: img.closest(".editorial-media, .final-cta"), start: "top bottom", end: "bottom top", scrub: true }
    });
  });

  /* ---- SVG blueprint line-draw ---- */
  document.querySelectorAll(".draw-line").forEach(path => {
    const len = path.getTotalLength ? path.getTotalLength() : 1000;
    gsap.set(path, { strokeDasharray: len, strokeDashoffset: len });
    gsap.to(path, {
      strokeDashoffset: 0, duration: 2.2, ease: "power2.out",
      scrollTrigger: { trigger: path.closest("svg"), start: "top 85%" }
    });
  });

  /* ---- Category / amenity stagger ---- */
  gsap.utils.toArray(".cat-grid, .amenity-grid, .feature-grid").forEach(grid => {
    gsap.from(grid.children, {
      opacity: 0, y: 34, duration: 0.7, stagger: 0.09, ease: "power3.out",
      scrollTrigger: { trigger: grid, start: "top 85%" }
    });
  });

  /* ---- Location rows stagger ---- */
  ScrollTrigger.create({
    trigger: "#locationList",
    start: "top 85%",
    once: true,
    onEnter: () => {
      gsap.to("#locationList .location-row", { opacity: 1, y: 0, duration: 0.6, stagger: 0.06, ease: "power3.out" });
    }
  });
  gsap.set("#locationList .location-row", { opacity: 0, y: 16 });

  /* ---- Magnetic buttons ---- */
  document.querySelectorAll(".btn, .btn-icon-circle").forEach(btn => {
    btn.addEventListener("mousemove", (e) => {
      const r = btn.getBoundingClientRect();
      const x = e.clientX - r.left - r.width / 2;
      const y = e.clientY - r.top - r.height / 2;
      gsap.to(btn, { x: x * 0.25, y: y * 0.35, duration: 0.4, ease: "power3.out" });
    });
    btn.addEventListener("mouseleave", () => {
      gsap.to(btn, { x: 0, y: 0, duration: 0.5, ease: "elastic.out(1, 0.4)" });
    });
  });

  /* ---- Project horizontal scroll controls ---- */
  const track = document.getElementById("projectsTrack");
  document.querySelectorAll("[data-scroll]").forEach(btn => {
    btn.addEventListener("click", () => {
      if (!track) return;
      const amount = track.clientWidth * 0.8 * (btn.dataset.scroll === "next" ? 1 : -1);
      track.scrollBy({ left: amount, behavior: "smooth" });
    });
  });

  /* ---- Page load fade ---- */
  gsap.from("main", { opacity: 0, duration: 0.6, ease: "power2.out" });
});
