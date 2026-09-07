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

    // ==================== 1. PRELOADER (QUICK & HIGH-END < 700ms) ====================
    const preloader = document.getElementById('site-preloader');
    const initHeroAnimations = () => {
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
    if (isDesktop) {
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

    // ==================== 3. STATS COUNT-UP WITH SCROLLTRIGGER ====================
    const statsSection = document.getElementById('stats-section');
    if (statsSection) {
        ScrollTrigger.create({
            trigger: statsSection,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                // Stat icons scale-in & slight rotate
                gsap.fromTo('.stat-icon',
                    { scale: 0.6, rotate: -15, opacity: 0 },
                    { scale: 1, rotate: 0, opacity: 1, duration: 0.7, stagger: 0.1, ease: 'back.out(1.7)' }
                );

                // Numbers count up smoothly
                document.querySelectorAll('.stat-counter').forEach(counter => {
                    const target = parseFloat(counter.getAttribute('data-target'));
                    const isDecimal = target % 1 !== 0;
                    const suffix = counter.getAttribute('data-suffix') || '';
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

    // ==================== 4. 3 PILLAR CARDS STAGGER REVEAL ====================
    const pillarSection = document.getElementById('services-pillars');
    if (pillarSection) {
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

    // ==================== 5. "WHY CLM" SPOTLIGHT & CARDS ====================
    const whySection = document.getElementById('why-clm');
    if (whySection) {
        if (isDesktop) {
            whySection.addEventListener('mousemove', (e) => {
                const rect = whySection.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                whySection.style.setProperty('--mouse-x', `${x}px`);
                whySection.style.setProperty('--mouse-y', `${y}px`);
            });
        }

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

    // ==================== 6. CASE STUDIES (CURSOR, VIDEO HOVER, PARALLAX) ====================
    const portfolioSection = document.getElementById('portfolio-section');
    if (portfolioSection) {
        if (isDesktop) {
            const cursor = document.getElementById('case-study-cursor');
            const grid = portfolioSection.querySelector('.portfolio-grid-wrapper');

            if (cursor && grid) {
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

    // ==================== 7. GLOBAL SECTION SCROLL REVEAL ====================
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
});
