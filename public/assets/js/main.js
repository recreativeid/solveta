/**
 * SOLVETA.ASIA — JAVASCRIPT INTERACTIONS & PORTFOLIO 3D CAROUSEL
 */

document.addEventListener('DOMContentLoaded', function () {
    // ----------------------------------------------------
    // 1. Mobile Menu Toggle
    // ----------------------------------------------------
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenuBtn = document.getElementById('close-mobile-menu');

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
        });
    }
    if (closeMenuBtn && mobileMenu) {
        closeMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    }

    // ----------------------------------------------------
    // 2. Portfolio Category Filtering & Carousel Logic
    // ----------------------------------------------------
    const filterTabs = document.querySelectorAll('.portfolio-filter-tab');
    const portfolioCards = document.querySelectorAll('.portfolio-card-item');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const category = tab.getAttribute('data-category');

            filterTabs.forEach(t => {
                t.classList.remove('bg-red-600', 'text-white', 'shadow-lg');
                t.classList.add('text-zinc-400', 'hover:text-white', 'hover:bg-zinc-800/60');
            });
            tab.classList.remove('text-zinc-400', 'hover:text-white', 'hover:bg-zinc-800/60');
            tab.classList.add('bg-red-600', 'text-white', 'shadow-lg');

            portfolioCards.forEach(card => {
                const cardCat = card.getAttribute('data-category');
                if (category === 'all' || cardCat === category) {
                    card.style.display = 'block';
                    card.classList.add('animate-fadeIn');
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // ----------------------------------------------------
    // 3. Portfolio Modal Preview
    // ----------------------------------------------------
    const modal = document.getElementById('portfolio-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalCategory = document.getElementById('modal-category');
    const modalImage = document.getElementById('modal-image');
    const modalDesc = document.getElementById('modal-description');
    const modalTags = document.getElementById('modal-tags');
    const modalWaLink = document.getElementById('modal-wa-link');
    const modalCloseBtn = document.getElementById('modal-close-btn');

    window.openPortfolioModal = function (title, category, image, desc, tagsStr, waUrl) {
        if (!modal) return;
        modalTitle.textContent = title;
        modalCategory.textContent = category;
        modalImage.src = image;
        modalDesc.textContent = desc;

        if (modalTags) {
            modalTags.innerHTML = '';
            try {
                const tags = JSON.parse(tagsStr);
                tags.forEach(tag => {
                    const span = document.createElement('span');
                    span.className = 'px-2.5 py-1 text-xs rounded-full bg-red-950/40 border border-red-800/40 text-red-400';
                    span.textContent = tag;
                    modalTags.appendChild(span);
                });
            } catch (e) {
                // Ignore parse error
            }
        }

        if (modalWaLink) {
            modalWaLink.href = waUrl;
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    if (modalCloseBtn && modal) {
        modalCloseBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    }

    // ----------------------------------------------------
    // 4. Interactive Pricing Addons Accordion / Toggle
    // ----------------------------------------------------
    const addonToggles = document.querySelectorAll('.toggle-addons-btn');
    addonToggles.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const targetEl = document.getElementById(targetId);
            if (targetEl) {
                targetEl.classList.toggle('hidden');
                btn.querySelector('.arrow-icon')?.classList.toggle('rotate-180');
            }
        });
    });

    // ----------------------------------------------------
    // 5. Video Player Play/Pause Hover on 3D Laptop
    // ----------------------------------------------------
    const heroVideo = document.getElementById('hero-profile-video');
    if (heroVideo) {
        heroVideo.addEventListener('click', () => {
            if (heroVideo.paused) {
                heroVideo.play();
            } else {
                heroVideo.pause();
            }
        });
    }
});
