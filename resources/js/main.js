/* ==========================================================================
   AUREATE ESTATES — Core interaction layer
   ========================================================================== */

document.addEventListener("DOMContentLoaded", () => {
    /* ---- Sticky header ---- */
    const header = document.querySelector(".site-header");
    const onScroll = () => {
        if (!header) return;
        header.classList.toggle("is-scrolled", window.scrollY > 40);
    };
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });

    /* ---- Hero search tabs (Buy / Rent / Commercial) ---- */
    document.querySelectorAll(".search-tabs").forEach((tabGroup) => {
        tabGroup.querySelectorAll("button").forEach((btn) => {
            btn.addEventListener("click", () => {
                tabGroup
                    .querySelectorAll("button")
                    .forEach((b) => b.classList.remove("active"));
                btn.classList.add("active");
            });
        });
    });

    /* ---- Generic form validation + fake-submit success state ---- */
    document.querySelectorAll("form[data-aureate-form]").forEach((form) => {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            let valid = true;
            form.querySelectorAll("[required]").forEach((field) => {
                if (!field.value.trim()) valid = false;
            });
            form.classList.add("was-validated-aureate");
            if (!valid) return;
            const successEl = form.parentElement.querySelector(
                ".form-success-aureate",
            );
            form.style.display = "none";
            if (successEl) successEl.style.display = "block";
        });
    });

    /* ---- Counter animation fallback (used if GSAP unavailable) ---- */
    if (!window.gsap) {
        document.querySelectorAll("[data-counter]").forEach((el) => {
            el.textContent = el.dataset.counter;
        });
    }

    /* ---- Compare / favorite toggles on listing page ---- */
    document.addEventListener("click", (e) => {
        const compareBtn = e.target.closest("[data-compare]");
        if (compareBtn) compareBtn.classList.toggle("active");
    });

    /* ---- Mortgage calculator (property-details.html) ---- */
    const mortgageForm = document.getElementById("mortgageCalc");
    if (mortgageForm) {
        const calc = () => {
            const price = parseFloat(mortgageForm.price.value) || 0;
            const downPct = parseFloat(mortgageForm.down.value) || 0;
            const rate = parseFloat(mortgageForm.rate.value) || 0;
            const years = parseFloat(mortgageForm.years.value) || 1;
            const principal = price - (price * downPct) / 100;
            const monthlyRate = rate / 100 / 12;
            const n = years * 12;
            const emi =
                monthlyRate === 0
                    ? principal / n
                    : (principal * monthlyRate * Math.pow(1 + monthlyRate, n)) /
                      (Math.pow(1 + monthlyRate, n) - 1);
            document.getElementById("emiResult").textContent =
                "₹" + Math.round(emi).toLocaleString("en-IN");
        };
        mortgageForm.addEventListener("input", calc);
        calc();
    }

    /* ---- Set active nav link ---- */
    const path = window.location.pathname.split("/").pop() || "index.html";
    document.querySelectorAll(".nav-link[href]").forEach((link) => {
        if (link.getAttribute("href") === path) link.classList.add("active");
    });

    /* ---- Year in footer ---- */
    document.querySelectorAll("[data-year]").forEach((el) => {
        el.textContent = new Date().getFullYear();
    });
});

// ====================================
// GOLDEN CORRIDOR — PANEL EXPLORER
// ====================================
document.addEventListener("DOMContentLoaded", () => {
    const corridorExplorer = {
        panels: Array.from(document.querySelectorAll(".panel")),
        stops: Array.from(document.querySelectorAll(".route__stop")),
        wrap: document.getElementById("corridorPanels"),
        index: 0,
        timer: null,

        // Native utility functions replacing missing 'utils'
        isMobile: function () {
            return window.innerWidth <= 960;
        },

        prefersReducedMotion: function () {
            return window.matchMedia("(prefers-reduced-motion: reduce)")
                .matches;
        },

        init: function () {
            if (this.panels.length === 0) return;

            this.panels.forEach((panel, i) => {
                panel.addEventListener("click", () => {
                    this.set(i);
                    this.restart();
                });

                panel.addEventListener("mouseenter", () => {
                    if (!this.isMobile()) {
                        this.set(i);
                        this.restart();
                    }
                });

                panel.addEventListener("keydown", (e) => {
                    if (e.key === "Enter" || e.key === " ") {
                        e.preventDefault();
                        this.set(i);
                        this.restart();
                    }
                });
            });

            this.stops.forEach((stop) => {
                stop.addEventListener("click", () => {
                    const i = parseInt(stop.dataset.i, 10);
                    this.set(i);
                    this.restart();
                });
            });

            if (this.wrap) {
                this.wrap.addEventListener("mouseenter", () => this.stop());
                this.wrap.addEventListener("mouseleave", () => this.start());
            }

            this.start();
        },

        set: function (i) {
            if (i === this.index) return;
            this.index = i;

            // Sync Active state and ARIA attributes for Panels
            this.panels.forEach((p, j) => {
                const isActive = j === i;
                p.classList.toggle("is-active", isActive);
                p.setAttribute("aria-expanded", isActive ? "true" : "false");
            });

            // Sync Active state and ARIA attributes for Route Stops
            this.stops.forEach((s, j) => {
                const isActive = j === i;
                s.classList.toggle("is-active", isActive);
                s.setAttribute("aria-selected", isActive ? "true" : "false");
            });
        },

        next: function () {
            this.set((this.index + 1) % this.panels.length);
        },

        start: function () {
            if (this.prefersReducedMotion()) return;
            this.stop();
            this.timer = setInterval(() => this.next(), 5500);
        },

        restart: function () {
            this.stop();
            this.start();
        },

        stop: function () {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
    };

    // Initialize Corridor Panel Explorer
    corridorExplorer.init();
});

function toggleReadMore() {
    const wrapper = document.getElementById("propertyTextWrapper");
    const btn = document.getElementById("toggleReadMoreBtn");
    const btnText = btn.querySelector(".btn-text");

    const isCollapsed = wrapper.classList.toggle("collapsed");
    btnText.textContent = isCollapsed ? "Read More" : "Read Less";
}
