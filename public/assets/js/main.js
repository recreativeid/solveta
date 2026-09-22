/**
 * SOLVETA — Authentic Frontend Engine (Replicated 1:1 from Next.js)
 * High-performance Vanilla JS with 3D Coverflow Physics, Kinetic Swiping,
 * Interactive Laptop Mockup, Theme Manager, and Instant Search.
 */

document.addEventListener("DOMContentLoaded", () => {
    // -------------------------------------------------------------------------
    // 1. THEME SWITCHER (Light / Dark Mode with LocalStorage)
    // -------------------------------------------------------------------------
    const themeBtn = document.getElementById("theme-toggle-btn");
    const sunIcon = document.getElementById("theme-sun-icon");
    const moonIcon = document.getElementById("theme-moon-icon");

    function updateThemeIcons(isDark) {
        if (!sunIcon || !moonIcon) return;
        if (isDark) {
            sunIcon.classList.remove("hidden");
            moonIcon.classList.add("hidden");
        } else {
            sunIcon.classList.add("hidden");
            moonIcon.classList.remove("hidden");
        }
    }

    const isCurrentDark = document.documentElement.classList.contains("dark");
    updateThemeIcons(isCurrentDark);

    if (themeBtn) {
        themeBtn.addEventListener("click", () => {
            const isDark = document.documentElement.classList.toggle("dark");
            try {
                localStorage.setItem("solveta_theme", isDark ? "dark" : "light");
            } catch (e) {}
            updateThemeIcons(isDark);

            // Re-render Coverflow card border & shadow styles if exists
            if (window.solvetaCoverflow && typeof window.solvetaCoverflow.paint === "function") {
                window.solvetaCoverflow.paint();
            }
        });
    }

    // -------------------------------------------------------------------------
    // 2. OPENING SCREEN (Smooth Loading Progress 0-100% with Soft Dissolve)
    // -------------------------------------------------------------------------
    const openingScreen = document.getElementById("opening-screen");
    const openingContent = document.getElementById("opening-content");
    const progressBar = document.getElementById("opening-progress-bar");
    const progressText = document.getElementById("opening-percentage");

    if (openingScreen && progressBar && progressText) {
        let progress = 0;
        const totalDuration = 3800; // ~3.8 seconds
        const intervalTime = 35;
        const step = 100 / (totalDuration / intervalTime);

        const progressTimer = setInterval(() => {
            progress += step;
            if (progress >= 100) {
                progress = 100;
                clearInterval(progressTimer);
                progressBar.style.width = "100%";
                progressText.textContent = "100%";

                setTimeout(() => {
                    if (openingContent) openingContent.classList.add("opening-content-fade-out");
                    openingScreen.classList.add("opening-fade-out");
                    setTimeout(() => {
                        openingScreen.classList.add("opening-hidden");
                    }, 1000);
                }, 200);
                return;
            }
            progressBar.style.width = Math.min(100, progress) + "%";
            progressText.textContent = Math.round(progress) + "%";
        }, intervalTime);
    }

    // -------------------------------------------------------------------------
    // 3. STICKY NAVBAR SCROLL ADAPTATION
    // -------------------------------------------------------------------------
    const mainNavbar = document.getElementById("main-navbar");
    if (mainNavbar) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 20) {
                mainNavbar.classList.add("py-3", "bg-white/95", "dark:bg-[#07080E]/95", "shadow-2xs", "border-gray-200/80", "dark:border-gray-800");
                mainNavbar.classList.remove("py-4", "bg-white/80", "dark:bg-[#07080E]/80", "border-gray-200/40", "dark:border-gray-800/60");
            } else {
                mainNavbar.classList.add("py-4", "bg-white/80", "dark:bg-[#07080E]/80", "border-gray-200/40", "dark:border-gray-800/60");
                mainNavbar.classList.remove("py-3", "bg-white/95", "dark:bg-[#07080E]/95", "shadow-2xs", "border-gray-200/80", "dark:border-gray-800");
            }
        }, { passive: true });
    }

    // -------------------------------------------------------------------------
    // 4. INSTANT SEARCH MODAL (Shortcut ⌘K / Ctrl+K & Filter)
    // -------------------------------------------------------------------------
    const searchModal = document.getElementById("search-modal");
    const searchTrigger = document.getElementById("nav-search-trigger");
    const searchClose = document.getElementById("search-modal-close");
    const searchBackdrop = document.getElementById("search-modal-backdrop");
    const searchInput = document.getElementById("search-modal-input");
    const searchResults = document.getElementById("search-results-list");

    const searchData = [
        { title: "Website & Digital Presence", category: "Services", link: "/#services" },
        { title: "Business Digitalization", category: "Services", link: "/#services" },
        { title: "Custom Digital Solution", category: "Services", link: "/#services" },
        { title: "Database & Integration", category: "Services", link: "/#services" },
        { title: "Optimization", category: "Services", link: "/#services" },
        { title: "Paket Basic — Rp 299K", category: "Pricing", link: "/#pricing" },
        { title: "Paket Standard — Rp 549K (Popular)", category: "Pricing", link: "/#pricing" },
        { title: "Paket Premium — Rp 749K", category: "Pricing", link: "/#pricing" },
        { title: "Paket Custom — Mulai Rp 1,5 Juta", category: "Pricing", link: "/#pricing" },
        { title: "01 Understand & 02 Analyze", category: "Process", link: "/#process" },
        { title: "03 Design & 04 Develop", category: "Process", link: "/#process" },
        { title: "05 Integrate & 06 Launch", category: "Process", link: "/#process" },
        { title: "Portofolio Proyek Website", category: "Portofolio", link: "/#portfolio" },
        { title: "Formulir Brief Pemesanan 16 Field", category: "Pemesanan", link: "/formulir" },
        { title: "Konsultasi Gratis Langsung WhatsApp", category: "Contact", link: "/#philosophy" },
    ];

    function openSearchModal() {
        if (!searchModal) return;
        searchModal.classList.remove("hidden");
        if (searchInput) {
            searchInput.value = "";
            renderSearchResults("");
            setTimeout(() => searchInput.focus(), 50);
        }
    }

    function closeSearchModal() {
        if (!searchModal) return;
        searchModal.classList.add("hidden");
    }

    function renderSearchResults(query) {
        if (!searchResults) return;
        const q = query.trim().toLowerCase();
        const filtered = q
            ? searchData.filter(item => item.title.toLowerCase().includes(q) || item.category.toLowerCase().includes(q))
            : searchData;

        if (filtered.length === 0) {
            searchResults.innerHTML = `<div class="py-8 text-center text-xs text-gray-400 font-sans">Tidak ada hasil untuk "${query}"</div>`;
            return;
        }

        searchResults.innerHTML = filtered.map(item => `
            <a href="${item.link}" class="search-item flex items-center justify-between p-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-colors group">
                <div>
                    <div class="text-xs font-semibold text-gray-800 dark:text-gray-200 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 font-sans">
                        ${item.title}
                    </div>
                    <div class="text-[10px] text-gray-400 font-mono">
                        ${item.category}
                    </div>
                </div>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-gray-300 dark:text-gray-600 group-hover:text-[#8B0021] dark:group-hover:text-rose-400 transition-colors"></i>
            </a>
        `).join("");

        if (window.lucide) {
            window.lucide.createIcons();
        }

        searchResults.querySelectorAll(".search-item").forEach(el => {
            el.addEventListener("click", () => closeSearchModal());
        });
    }

    if (searchTrigger) searchTrigger.addEventListener("click", openSearchModal);
    if (searchClose) searchClose.addEventListener("click", closeSearchModal);
    if (searchBackdrop) searchBackdrop.addEventListener("click", closeSearchModal);
    if (searchInput) {
        searchInput.addEventListener("input", (e) => renderSearchResults(e.target.value));
    }

    window.addEventListener("keydown", (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === "k") {
            e.preventDefault();
            if (searchModal && !searchModal.classList.contains("hidden")) {
                closeSearchModal();
            } else {
                openSearchModal();
            }
        }
        if (e.key === "Escape" && searchModal && !searchModal.classList.contains("hidden")) {
            closeSearchModal();
        }
    });

    // -------------------------------------------------------------------------
    // 5. INTERACTIVE 3D LAPTOP MOCKUP VIDEO PLAYER (Hero Section)
    // -------------------------------------------------------------------------
    const heroVideo = document.getElementById("hero-profile-video");
    const videoContainer = document.getElementById("laptop-video-container");
    const playOverlay = document.getElementById("video-play-overlay");
    const playBtn = document.getElementById("video-play-btn");
    const restartBtn = document.getElementById("video-restart-btn");
    const soundBtn = document.getElementById("video-sound-btn");
    const fullscreenBtn = document.getElementById("video-fullscreen-btn");
    const btnPauseIcon = document.getElementById("btn-pause-icon");
    const btnPlayIcon = document.getElementById("btn-play-icon");
    const btnVolMute = document.getElementById("btn-vol-mute");
    const btnVolUnmute = document.getElementById("btn-vol-unmute");
    const laptopLid = document.getElementById("laptop-lid");
    const laptopChassis = document.getElementById("laptop-chassis-container");

    function updateVideoPlayState(isPlaying) {
        if (playOverlay) {
            if (isPlaying) {
                playOverlay.classList.add("hidden");
            } else {
                playOverlay.classList.remove("hidden");
            }
        }
        if (btnPauseIcon && btnPlayIcon) {
            if (isPlaying) {
                btnPauseIcon.classList.remove("hidden");
                btnPlayIcon.classList.add("hidden");
            } else {
                btnPauseIcon.classList.add("hidden");
                btnPlayIcon.classList.remove("hidden");
            }
        }
    }

    function toggleVideoPlay() {
        if (!heroVideo) return;
        if (heroVideo.paused) {
            heroVideo.play().then(() => updateVideoPlayState(true)).catch(() => {});
        } else {
            heroVideo.pause();
            updateVideoPlayState(false);
        }
    }

    if (videoContainer) {
        videoContainer.addEventListener("click", (e) => {
            // Ignore if clicking on control buttons inside
            if (e.target.closest("button")) return;
            toggleVideoPlay();
        });
    }

    if (playBtn) {
        playBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            toggleVideoPlay();
        });
    }

    if (restartBtn && heroVideo) {
        restartBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            heroVideo.currentTime = 0;
            heroVideo.play().then(() => updateVideoPlayState(true)).catch(() => {});
        });
    }

    if (soundBtn && heroVideo) {
        soundBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            heroVideo.muted = !heroVideo.muted;
            if (heroVideo.muted) {
                if (btnVolMute) btnVolMute.classList.remove("hidden");
                if (btnVolUnmute) btnVolUnmute.classList.add("hidden");
                soundBtn.classList.remove("bg-[#8B0021]", "text-white");
                soundBtn.classList.add("bg-black/70", "text-gray-300");
                soundBtn.title = "Hidupkan Suara";
            } else {
                if (btnVolMute) btnVolMute.classList.add("hidden");
                if (btnVolUnmute) btnVolUnmute.classList.remove("hidden");
                soundBtn.classList.add("bg-[#8B0021]", "text-white");
                soundBtn.classList.remove("bg-black/70", "text-gray-300");
                soundBtn.title = "Matikan Suara";
            }
        });
    }

    if (fullscreenBtn && videoContainer) {
        fullscreenBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            if (!document.fullscreenElement) {
                if (videoContainer.requestFullscreen) {
                    videoContainer.requestFullscreen();
                } else if (videoContainer.webkitRequestFullscreen) {
                    videoContainer.webkitRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        });
    }

    if (heroVideo) {
        heroVideo.addEventListener("play", () => updateVideoPlayState(true));
        heroVideo.addEventListener("pause", () => updateVideoPlayState(false));
    }

    // -------------------------------------------------------------------------
    // 5.1 3D CONTAINER SCROLL VERTICAL TILT & MOUSE PARALLAX
    // (Authentic Next.js Aceternity Container Scroll Animation)
    // -------------------------------------------------------------------------
    if (laptopChassis && laptopLid) {
        let mouseX = 0;
        let mouseY = 0;
        let targetRotateX = 22;
        let currentRotateX = 22;
        let targetTranslateY = 50;
        let currentTranslateY = 50;
        let targetScale = 0.94;
        let currentScale = 0.94;
        let isTicking = false;

        const isMobile = window.innerWidth < 768;

        function updateScrollTilt() {
            const rect = laptopChassis.getBoundingClientRect();
            const winH = window.innerHeight;
            const targetCenter = winH * 0.5;
            const elementCenter = rect.top + rect.height * 0.5;
            
            // Progress: 0 when element enters viewport, 1 when at center or passed
            const totalDistance = (winH + rect.height) * 0.5;
            let progress = 1 - (elementCenter - targetCenter) / totalDistance;
            progress = Math.max(0, Math.min(1, progress));

            targetRotateX = (1 - progress) * 22; // 22deg tilted backwards down to 0deg upright
            targetTranslateY = (1 - progress) * 50; // 50px down to 0px
            targetScale = isMobile ? (0.88 + progress * 0.12) : (0.94 + progress * 0.08);

            if (!isTicking) {
                isTicking = true;
                requestAnimationFrame(animateFrame);
            }
        }

        function animateFrame() {
            // Smooth spring damping interpolation
            currentRotateX += (targetRotateX - currentRotateX) * 0.12;
            currentTranslateY += (targetTranslateY - currentTranslateY) * 0.12;
            currentScale += (targetScale - currentScale) * 0.12;

            laptopChassis.style.transform = `perspective(1200px) rotateX(${currentRotateX.toFixed(2)}deg) translateY(${currentTranslateY.toFixed(1)}px) scale(${currentScale.toFixed(3)})`;

            // Mouse parallax tilt on lid for desktop
            if (!isMobile) {
                laptopLid.style.transform = `perspective(1200px) rotateY(${(mouseX * 9).toFixed(2)}deg) rotateX(${(-mouseY * 7).toFixed(2)}deg)`;
            }

            if (
                Math.abs(targetRotateX - currentRotateX) > 0.05 ||
                Math.abs(targetTranslateY - currentTranslateY) > 0.1 ||
                Math.abs(targetScale - currentScale) > 0.002
            ) {
                requestAnimationFrame(animateFrame);
            } else {
                isTicking = false;
            }
        }

        window.addEventListener("scroll", updateScrollTilt, { passive: true });
        window.addEventListener("resize", updateScrollTilt);
        updateScrollTilt();

        if (!isMobile) {
            laptopChassis.addEventListener("mousemove", (e) => {
                const rect = laptopChassis.getBoundingClientRect();
                mouseX = (e.clientX - rect.left) / rect.width - 0.5;
                mouseY = (e.clientY - rect.top) / rect.height - 0.5;
                if (!isTicking) {
                    isTicking = true;
                    requestAnimationFrame(animateFrame);
                }
            });

            laptopChassis.addEventListener("mouseleave", () => {
                mouseX = 0;
                mouseY = 0;
                if (!isTicking) {
                    isTicking = true;
                    requestAnimationFrame(animateFrame);
                }
            });
        }
    }

    // -------------------------------------------------------------------------
    // 6. PRICING FILTER BUTTONS
    // -------------------------------------------------------------------------
    const pricingFilterBtns = document.querySelectorAll(".pricing-filter-btn");
    const pricingCards = document.querySelectorAll(".pricing-tier-card");

    pricingFilterBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            const targetId = btn.getAttribute("data-target");

            // Update active pill
            pricingFilterBtns.forEach(b => {
                b.classList.remove("bg-[#8B0021]", "text-white", "border-[#8B0021]", "shadow-xs");
                b.classList.add("bg-white", "dark:bg-gray-900", "text-gray-600", "dark:text-gray-300", "border-gray-200", "dark:border-gray-800");
            });
            btn.classList.add("bg-[#8B0021]", "text-white", "border-[#8B0021]", "shadow-xs");
            btn.classList.remove("bg-white", "dark:bg-gray-900", "text-gray-600", "dark:text-gray-300", "border-gray-200", "dark:border-gray-800");

            // Filter cards
            pricingCards.forEach(card => {
                if (targetId === "all" || card.id === targetId) {
                    card.style.display = "block";
                    card.style.opacity = "0";
                    setTimeout(() => {
                        card.style.transition = "opacity 300ms ease";
                        card.style.opacity = "1";
                    }, 20);
                } else {
                    card.style.display = "none";
                }
            });
        });
    });

    // -------------------------------------------------------------------------
    // 7. AUTHENTIC 3D COVERFLOW CAROUSEL ENGINE (Interactive & Swipe Gesture)
    // -------------------------------------------------------------------------
    const coverflowSection = document.getElementById("coverflow-section");
    const coverflowFrame = document.getElementById("coverflow-frame");
    const prevBtn = document.getElementById("coverflow-prev-btn");
    const nextBtn = document.getElementById("coverflow-next-btn");
    const dotsContainer = document.getElementById("coverflow-dots");
    const ambienceBg = document.getElementById("coverflow-ambience-bg");
    const filterBtns = document.querySelectorAll(".coverflow-filter-btn");

    if (coverflowFrame) {
        // Collect all card elements
        const allCardElements = Array.from(document.querySelectorAll(".coverflow-card"));
        let activeCards = [...allCardElements];
        let count = activeCards.length;

        // Continuous fractional position - physics state
        let pos = 0;
        let target = 0;
        let width = 0;
        let rafId = null;
        let selectedIndex = 0;
        let isHovered = false;
        let drag = null;

        // Physics constants
        const rotate = 32;   // degrees tilt for neighbours
        const depth = 0.55;  // depth factor
        const falloff = 0.62;// distance damping
        const gap = 0.08;    // gap ratio

        function indexAt(p) {
            if (count === 0) return 0;
            return ((Math.round(p) % count) + count) % count;
        }

        function isDarkTheme() {
            return document.documentElement.classList.contains("dark");
        }

        // Direct 60fps/120fps DOM renderer
        function paint() {
            if (!width || count === 0) return;
            const pitch = width * (1 + gap);
            const isDark = isDarkTheme();

            activeCards.forEach((card, index) => {
                if (!card) return;

                // Fold distance into shortest way round the ring
                let offset = index - pos;
                offset = ((offset % count) + count) % count;
                if (offset > count / 2) offset -= count;

                const distance = Math.abs(offset);
                const isCenter = distance < 0.45;

                // 3D physics ramp calculations
                const ramp = Math.pow(distance, falloff);
                const tilt = Math.min(rotate * ramp, 65) * Math.sign(offset);

                // Apply transform & 3D perspective
                card.style.transform = `translateX(calc(-50% + ${offset * pitch}px)) translateZ(${-depth * width * ramp}px) rotateY(${-tilt}deg)`;

                // Dynamic opacity & z-index
                const edge = Math.min(1, Math.max(0, count / 2 - distance));
                const baseOpacity = Math.max(0, 1 - 0.15 * distance) * edge;
                card.style.opacity = String(baseOpacity);
                card.style.zIndex = String(100 - Math.round(distance * 10));

                // Center vs Side card styling
                if (isCenter) {
                    card.style.borderColor = isDark ? "#f43f5e" : "#8B0021";
                    card.style.boxShadow = isDark
                        ? "0 25px 60px rgba(0,0,0,0.9), 0 0 30px rgba(244,63,94,0.3)"
                        : "0 25px 50px -12px rgba(139,0,33,0.3), 0 0 20px rgba(139,0,33,0.15)";
                    card.style.filter = "brightness(1)";
                    card.style.cursor = "default";
                } else {
                    card.style.borderColor = isDark ? "rgba(255, 255, 255, 0.15)" : "rgba(0, 0, 0, 0.15)";
                    card.style.boxShadow = isDark ? "0 15px 35px rgba(0,0,0,0.6)" : "0 12px 25px rgba(0,0,0,0.08)";
                    card.style.filter = isDark
                        ? `brightness(${Math.max(0.45, 0.9 - distance * 0.2)})`
                        : `brightness(${Math.max(0.75, 1 - distance * 0.1)})`;
                    card.style.cursor = "pointer";
                }

                // Frosted glass bottom banner opacity
                const banner = card.querySelector(".coverflow-card-banner");
                if (banner) {
                    const bannerOpacity = Math.max(0, 1 - distance * 2.2);
                    banner.style.opacity = String(bannerOpacity);
                    banner.style.transform = `translateY(${(1 - bannerOpacity) * 16}px)`;
                    banner.style.pointerEvents = isCenter ? "auto" : "none";
                }
            });

            // Update ambient background image blur
            const currentCard = activeCards[selectedIndex];
            if (currentCard && ambienceBg) {
                const imgSrc = currentCard.getAttribute("data-img");
                if (imgSrc && ambienceBg.src !== imgSrc) {
                    ambienceBg.src = imgSrc;
                }
            }

            // Update pagination dots
            updateDots();
        }

        // Settle animation using exponential ease-out
        function settle(t) {
            if (rafId !== null) cancelAnimationFrame(rafId);
            target = t;
            selectedIndex = indexAt(target);

            function step() {
                const remaining = target - pos;
                if (Math.abs(remaining) < 0.0004) {
                    pos = target;
                    paint();
                    rafId = null;
                    return;
                }
                pos += remaining * 0.16;
                paint();
                rafId = requestAnimationFrame(step);
            }
            rafId = requestAnimationFrame(step);
        }

        function goTo(index) {
            if (count === 0) return;
            const targetPos = index + Math.round((target - index) / count) * count;
            settle(targetPos);
        }

        function nudge(by) {
            if (count === 0) return;
            settle(Math.round(target) + by);
        }

        // Pagination Dots Builder
        function buildDots() {
            if (!dotsContainer) return;
            dotsContainer.innerHTML = "";
            activeCards.forEach((_, idx) => {
                const dot = document.createElement("button");
                dot.type = "button";
                dot.setAttribute("aria-label", `Pergi ke portofolio ${idx + 1}`);
                dot.className = "h-2 rounded-full transition-all duration-300 cursor-pointer w-2 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400";
                dot.addEventListener("click", () => goTo(idx));
                dotsContainer.appendChild(dot);
            });
            updateDots();
        }

        function updateDots() {
            if (!dotsContainer) return;
            const dots = dotsContainer.children;
            for (let i = 0; i < dots.length; i++) {
                if (i === selectedIndex) {
                    dots[i].className = "h-2 rounded-full transition-all duration-300 cursor-pointer w-7 bg-[#8B0021] dark:bg-rose-500 shadow-[0_0_10px_rgba(139,0,33,0.6)]";
                } else {
                    dots[i].className = "h-2 rounded-full transition-all duration-300 cursor-pointer w-2 bg-gray-300 dark:bg-gray-700 hover:bg-gray-400";
                }
            }
        }

        // Measure width for responsive calculations
        function measure() {
            if (activeCards[0]) {
                width = activeCards[0].offsetWidth;
                paint();
            }
        }

        // Pointer Drag & Swipe Gestures (Kinetic physics)
        coverflowFrame.addEventListener("pointerdown", (e) => {
            if (e.target.closest("a, button, [data-interactive]")) return;

            if (rafId !== null) {
                cancelAnimationFrame(rafId);
                rafId = null;
            }
            coverflowFrame.setPointerCapture(e.pointerId);
            target = pos;
            drag = {
                id: e.pointerId,
                x: e.clientX,
                pos: pos,
                v: 0,
                t: performance.now(),
            };
        });

        coverflowFrame.addEventListener("pointermove", (e) => {
            if (!drag || drag.id !== e.pointerId) return;
            const pitch = width * (1 + gap);
            if (!pitch) return;

            const now = performance.now();
            const prevPos = pos;
            pos = drag.pos - (e.clientX - drag.x) / pitch;
            drag.v = ((pos - prevPos) / Math.max(now - drag.t, 1)) * 1000;
            drag.t = now;

            const idx = indexAt(pos);
            if (idx !== selectedIndex) {
                selectedIndex = idx;
            }
            paint();
        });

        function endDrag(e) {
            if (!drag || drag.id !== e.pointerId) return;
            drag = null;
            // Kinetic flick throw (carry max 2 cards)
            const carried = Math.max(-2, Math.min(2, drag.v * 0.18));
            settle(Math.round(pos + carried));
        }

        coverflowFrame.addEventListener("pointerup", endDrag);
        coverflowFrame.addEventListener("pointercancel", endDrag);

        // Click on side card moves to it
        allCardElements.forEach(card => {
            card.addEventListener("click", (e) => {
                if (e.target.closest("a, button, [data-interactive]")) return;
                const idx = activeCards.indexOf(card);
                if (idx !== -1 && idx !== selectedIndex) {
                    goTo(idx);
                }
            });
        });

        // Arrow Buttons
        if (prevBtn) prevBtn.addEventListener("click", () => nudge(-1));
        if (nextBtn) nextBtn.addEventListener("click", () => nudge(1));

        // Keyboard Navigation
        coverflowFrame.addEventListener("keydown", (e) => {
            if (e.key === "ArrowLeft") {
                e.preventDefault();
                nudge(-1);
            } else if (e.key === "ArrowRight") {
                e.preventDefault();
                nudge(1);
            }
        });

        // Category Filter
        filterBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                const cat = btn.getAttribute("data-category");

                // Update filter buttons styling
                filterBtns.forEach(b => {
                    b.className = "coverflow-filter-btn text-xs font-semibold font-sans px-4 py-1.5 rounded-full transition-all duration-200 cursor-pointer border bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-300 hover:bg-rose-50 dark:hover:bg-gray-800 hover:text-[#7B0B1E] dark:hover:text-rose-300 border-gray-200 dark:border-gray-800 hover:border-rose-200 dark:hover:border-rose-700";
                });
                btn.className = "coverflow-filter-btn text-xs font-semibold font-sans px-4 py-1.5 rounded-full transition-all duration-200 cursor-pointer border bg-gradient-to-r from-[#8B0021] to-[#50000F] text-white border-[#8B0021] shadow-xs";

                // Filter cards
                if (cat === "Semua") {
                    activeCards = [...allCardElements];
                    allCardElements.forEach(c => c.style.display = "");
                } else {
                    activeCards = allCardElements.filter(c => c.getAttribute("data-category") === cat);
                    allCardElements.forEach(c => {
                        if (c.getAttribute("data-category") === cat) {
                            c.style.display = "";
                        } else {
                            c.style.display = "none";
                        }
                    });
                }

                count = activeCards.length;
                pos = 0;
                target = 0;
                selectedIndex = 0;
                buildDots();
                measure();
            });
        });

        // Autoplay loop (every 5 seconds)
        if (coverflowSection) {
            coverflowSection.addEventListener("mouseenter", () => { isHovered = true; });
            coverflowSection.addEventListener("mouseleave", () => { isHovered = false; });
        }

        setInterval(() => {
            if (!isHovered && drag === null && count > 1) {
                nudge(1);
            }
        }, 5000);

        // Resize Observer
        window.addEventListener("resize", measure);
        measure();
        buildDots();

        // Expose engine to window
        window.solvetaCoverflow = {
            paint,
            goTo,
            nudge,
        };
    }

    // -------------------------------------------------------------------------
    // 8. FOOTER SECRET CLICK (Click 3x to open Developer Portal)
    // -------------------------------------------------------------------------
    const secretTrigger = document.getElementById("footer-secret-click");
    if (secretTrigger) {
        let clickCount = 0;
        secretTrigger.addEventListener("click", () => {
            clickCount++;
            if (clickCount >= 3) {
                window.location.href = "/admin";
            }
        });
    }

    // Re-trigger lucide icons
    if (window.lucide) {
        window.lucide.createIcons();
    }
});
