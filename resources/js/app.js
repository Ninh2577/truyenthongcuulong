import './bootstrap';
import Alpine from 'alpinejs';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const isDesktop = window.matchMedia('(min-width: 768px)').matches;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ==================== 1. PRELOADER (QUICK & HIGH-END < 700ms) ====================
    const preloader = document.getElementById('site-preloader');
    const initHeroAnimations = () => {
        if (prefersReducedMotion) {
            document.querySelectorAll('.hero-reveal-line, .hero-fade-item').forEach(el => {
                el.style.opacity = '1';
                el.style.transform = 'none';
            });
            return;
        }

        // Headline line-by-line reveal
        gsap.fromTo('.hero-reveal-line', 
            { y: 40, opacity: 0 }, 
            { y: 0, opacity: 1, duration: 0.85, stagger: 0.12, ease: 'power3.out' }
        );
        // Subtext, badge, CTAs fade-in
        gsap.fromTo('.hero-fade-item', 
            { opacity: 0, y: 20 }, 
            { opacity: 1, y: 0, duration: 0.75, delay: 0.35, stagger: 0.1, ease: 'power2.out' }
        );
    };

    if (preloader) {
        const progressBar = document.getElementById('preloader-progress');
        if (progressBar) {
            progressBar.style.width = '100%';
        }
        setTimeout(() => {
            preloader.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                preloader.remove();
            }, 450);
            initHeroAnimations();
        }, 550);
    } else {
        initHeroAnimations();
    }

    // ==================== 2. MAGNETIC BUTTON (DESKTOP) ====================
    if (isDesktop && !prefersReducedMotion) {
        const magneticBtns = document.querySelectorAll('.magnetic-btn');
        magneticBtns.forEach(btn => {
            const xTo = gsap.quickTo(btn, 'x', { duration: 0.3, ease: 'power3.out' });
            const yTo = gsap.quickTo(btn, 'y', { duration: 0.3, ease: 'power3.out' });

            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = (e.clientX - (rect.left + rect.width / 2)) * 0.35;
                const y = (e.clientY - (rect.top + rect.height / 2)) * 0.35;
                xTo(x);
                yTo(y);
            });

            btn.addEventListener('mouseleave', () => {
                xTo(0);
                yTo(0);
            });
        });
    }

    // ==================== 3. SHOWREEL CUSTOM PLAYER CONTROLLER (SECTION 2) ====================
    const showreelVideo = document.getElementById('showreel-main-video');
    const showreelCenterBtn = document.getElementById('showreel-center-play');
    const showreelPlayToggle = document.getElementById('showreel-play-toggle');
    const showreelPlayIcon = document.getElementById('showreel-play-icon');
    const showreelTimecode = document.getElementById('showreel-timecode');
    const showreelProgressBar = document.getElementById('showreel-progress-bar');
    const showreelScrubber = document.getElementById('showreel-scrubber');
    const showreelMuteBtn = document.getElementById('showreel-mute-btn');
    const showreelMuteIcon = document.getElementById('showreel-mute-icon');
    const showreelFullscreenBtn = document.getElementById('showreel-fullscreen-btn');
    const showreelContainer = document.getElementById('showreel-container');

    if (showreelVideo) {
        // Format seconds to DaVinci Timecode HH:MM:SS:FF (24fps)
        const formatTimecode = (sec) => {
            if (isNaN(sec) || sec < 0) sec = 0;
            const h = Math.floor(sec / 3600);
            const m = Math.floor((sec % 3600) / 60);
            const s = Math.floor(sec % 60);
            const f = Math.floor((sec % 1) * 24);
            const pad = (n) => String(n).padStart(2, '0');
            return `${pad(h)}:${pad(m)}:${pad(s)}:${pad(f)}`;
        };

        const toggleShowreelPlay = () => {
            if (showreelVideo.paused) {
                const playPromise = showreelVideo.play();
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        if (showreelCenterBtn) showreelCenterBtn.style.opacity = '0';
                        if (showreelPlayIcon) showreelPlayIcon.textContent = 'pause';
                    }).catch(() => {
                        // Browser autoplay policy prevented or source missing
                    });
                }
            } else {
                showreelVideo.pause();
                if (showreelCenterBtn) showreelCenterBtn.style.opacity = '1';
                if (showreelPlayIcon) showreelPlayIcon.textContent = 'play_arrow';
            }
        };

        if (showreelCenterBtn) {
            showreelCenterBtn.addEventListener('click', toggleShowreelPlay);
        }
        if (showreelPlayToggle) {
            showreelPlayToggle.addEventListener('click', toggleShowreelPlay);
        }

        // Time Update
        showreelVideo.addEventListener('timeupdate', () => {
            const cur = showreelVideo.currentTime;
            const dur = showreelVideo.duration || 1;
            const pct = (cur / dur) * 100;
            if (showreelProgressBar) {
                showreelProgressBar.style.width = `${pct}%`;
            }
            if (showreelTimecode) {
                showreelTimecode.textContent = `${formatTimecode(cur)} / ${formatTimecode(dur)}`;
            }
        });

        // Scrubber seek
        if (showreelScrubber) {
            const seekVideo = (e) => {
                const rect = showreelScrubber.getBoundingClientRect();
                const clickX = e.clientX - rect.left;
                const pct = Math.max(0, Math.min(1, clickX / rect.width));
                if (showreelVideo.duration) {
                    showreelVideo.currentTime = pct * showreelVideo.duration;
                }
            };
            showreelScrubber.addEventListener('click', seekVideo);
        }

        // Mute / Unmute
        if (showreelMuteBtn && showreelMuteIcon) {
            showreelMuteBtn.addEventListener('click', () => {
                showreelVideo.muted = !showreelVideo.muted;
                showreelMuteIcon.textContent = showreelVideo.muted ? 'volume_off' : 'volume_up';
            });
        }

        // Fullscreen
        if (showreelFullscreenBtn && showreelContainer) {
            showreelFullscreenBtn.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    showreelContainer.requestFullscreen().catch(() => {});
                } else {
                    document.exitFullscreen().catch(() => {});
                }
            });
        }

        // Video ended
        showreelVideo.addEventListener('ended', () => {
            if (showreelCenterBtn) showreelCenterBtn.style.opacity = '1';
            if (showreelPlayIcon) showreelPlayIcon.textContent = 'play_arrow';
        });
    }

    // ==================== 4. BEFORE / AFTER COLOR GRADE SLIDER (SECTION 4) ====================
    const sliderContainer = document.getElementById('color-grade-slider');
    const sliderHandle = document.getElementById('slider-handle-line');

    if (sliderContainer && sliderHandle) {
        let isDragging = false;
        let currentPos = 50;

        const setSliderPos = (pos) => {
            currentPos = Math.max(2, Math.min(98, pos));
            sliderContainer.style.setProperty('--slider-pos', `${currentPos}%`);
            sliderHandle.setAttribute('aria-valuenow', Math.round(currentPos));
        };

        const onMove = (clientX) => {
            const rect = sliderContainer.getBoundingClientRect();
            const pct = ((clientX - rect.left) / rect.width) * 100;
            setSliderPos(pct);
        };

        // Mouse Events
        sliderContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            onMove(e.clientX);
        });
        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            onMove(e.clientX);
        });
        window.addEventListener('mouseup', () => {
            isDragging = false;
        });

        // Touch Events for Mobile
        sliderContainer.addEventListener('touchstart', (e) => {
            if (e.touches.length > 0) {
                isDragging = true;
                onMove(e.touches[0].clientX);
            }
        }, { passive: true });
        window.addEventListener('touchmove', (e) => {
            if (!isDragging || e.touches.length === 0) return;
            onMove(e.touches[0].clientX);
        }, { passive: true });
        window.addEventListener('touchend', () => {
            isDragging = false;
        });

        // Keyboard Accessibility (ArrowLeft / ArrowRight)
        sliderHandle.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                setSliderPos(currentPos - 4);
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                setSliderPos(currentPos + 4);
            }
        });
    }

    // ==================== 5. TYPEWRITER CODE EDITOR (SECTION 4 WEB TAB) ====================
    const codeEditorTarget = document.getElementById('code-typewriter-target');
    if (codeEditorTarget) {
        const codeSnippet = `Route::prefix('v1/media')->group(function () {
    Route::post('/render-4k', [VideoPipeline::class, 'transcodeMaster']);
    Route::get('/analytics/realtime', [MarTechEngine::class, 'streamRoas']);
});`;
        let charIndex = 0;
        let isDeleting = false;

        const typeCode = () => {
            if (!isDeleting) {
                charIndex++;
                codeEditorTarget.textContent = codeSnippet.substring(0, charIndex);
                if (charIndex >= codeSnippet.length) {
                    setTimeout(() => { isDeleting = true; typeCode(); }, 3200);
                    return;
                }
                setTimeout(typeCode, 32);
            } else {
                charIndex -= 2;
                if (charIndex <= 0) {
                    charIndex = 0;
                    isDeleting = false;
                    setTimeout(typeCode, 800);
                    return;
                }
                codeEditorTarget.textContent = codeSnippet.substring(0, charIndex);
                setTimeout(typeCode, 18);
            }
        };

        // Start typing when section reaches viewport
        ScrollTrigger.create({
            trigger: '#workflow-section',
            start: 'top 85%',
            once: true,
            onEnter: () => typeCode()
        });
    }

    // ==================== 6. STATS COUNT-UP WITH SCROLLTRIGGER ====================
    const statsSection = document.getElementById('stats-section');
    if (statsSection) {
        ScrollTrigger.create({
            trigger: statsSection,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                if (!prefersReducedMotion) {
                    gsap.fromTo('.stat-icon',
                        { scale: 0.6, rotate: -15, opacity: 0 },
                        { scale: 1, rotate: 0, opacity: 1, duration: 0.7, stagger: 0.1, ease: 'back.out(1.7)' }
                    );
                }

                document.querySelectorAll('.stat-counter').forEach(counter => {
                    const target = parseFloat(counter.getAttribute('data-target'));
                    const isDecimal = target % 1 !== 0;
                    const suffix = counter.getAttribute('data-suffix') || '';
                    if (prefersReducedMotion) {
                        counter.textContent = (isDecimal ? target.toFixed(1) : Math.round(target)) + suffix;
                        return;
                    }

                    const obj = { val: 0 };
                    gsap.to(obj, {
                        val: target,
                        duration: 1.6,
                        ease: 'power2.out',
                        onUpdate: () => {
                            counter.textContent = (isDecimal ? obj.val.toFixed(1) : Math.round(obj.val)) + suffix;
                        }
                    });
                });
            }
        });
    }

    // ==================== 7. 3 PILLAR CARDS STAGGER REVEAL ====================
    const pillarSection = document.getElementById('services-pillars');
    if (pillarSection && !prefersReducedMotion) {
        gsap.fromTo('.pillar-card',
            { y: 45, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.15,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: pillarSection,
                    start: 'top 80%',
                    once: true
                }
            }
        );
    }

    // ==================== 8. "WHY CLM" SPOTLIGHT & CARDS ====================
    const whySection = document.getElementById('why-clm');
    if (whySection) {
        if (isDesktop && !prefersReducedMotion) {
            whySection.addEventListener('mousemove', (e) => {
                const rect = whySection.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                whySection.style.setProperty('--mouse-x', `${x}px`);
                whySection.style.setProperty('--mouse-y', `${y}px`);
            });
        }

        if (!prefersReducedMotion) {
            gsap.fromTo('.why-card',
                { y: 40, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.75,
                    stagger: 0.12,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: whySection,
                        start: 'top 80%',
                        once: true
                    }
                }
            );
        }
    }

    // ==================== 9. CASE STUDIES (CURSOR, VIDEO HOVER, PARALLAX) ====================
    const portfolioSection = document.getElementById('portfolio-section');
    if (portfolioSection) {
        if (isDesktop) {
            const cursor = document.getElementById('case-study-cursor');
            const grid = portfolioSection.querySelector('.portfolio-grid-wrapper');

            if (cursor && grid && !prefersReducedMotion) {
                const xTo = gsap.quickTo(cursor, 'x', { duration: 0.15, ease: 'power2.out' });
                const yTo = gsap.quickTo(cursor, 'y', { duration: 0.15, ease: 'power2.out' });

                grid.addEventListener('mouseenter', () => cursor.classList.add('active'));
                grid.addEventListener('mouseleave', () => cursor.classList.remove('active'));
                grid.addEventListener('mousemove', (e) => {
                    xTo(e.clientX);
                    yTo(e.clientY);
                });
            }

            // Video Preview on Hover for Showreel Card
            document.querySelectorAll('.video-hover-card').forEach(card => {
                const video = card.querySelector('video');
                if (!video) return;
                card.addEventListener('mouseenter', () => {
                    video.style.opacity = '1';
                    const playPromise = video.play();
                    if (playPromise !== undefined) {
                        playPromise.catch(() => {});
                    }
                });
                card.addEventListener('mouseleave', () => {
                    video.style.opacity = '0';
                    video.pause();
                    video.currentTime = 0;
                });
            });

            // Parallax on images
            if (!prefersReducedMotion) {
                gsap.utils.toArray('.project-parallax-img').forEach(img => {
                    gsap.to(img, {
                        yPercent: 8,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: img.closest('.project-item'),
                            start: 'top bottom',
                            end: 'bottom top',
                            scrub: true
                        }
                    });
                });
            }
        }
    }

    // ==================== 10. GLOBAL SECTION SCROLL REVEAL ====================
    if (!prefersReducedMotion) {
        document.querySelectorAll('.gsap-reveal-section').forEach(sec => {
            gsap.fromTo(sec,
                { y: 30, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: sec,
                        start: 'top 85%',
                        once: true
                    }
                }
            );
        });
    }
});
