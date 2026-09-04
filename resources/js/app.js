import './bootstrap';
// SSO auth wiring (Supabase login/register/forgot + global logout interceptor).
// Bundled into the main app entry so it ships with the existing build pipeline
// and never leaves a dangling Vite manifest reference.
import './auth';
import Alpine from 'alpinejs';
import markdownEditor from './markdown-editor';

window.Alpine = Alpine;

// Must be registered before start() — Alpine only resolves x-data names it
// already knows about when it walks the DOM.
Alpine.data('markdownEditor', markdownEditor);

Alpine.start();

/*
 * Resilient scroll-reveal system.
 *
 * Several pages hide sections with `.reveal-on-scroll { opacity: 0 }` and rely
 * on a per-page IntersectionObserver to add `.revealed`. That per-page observer
 * was not firing reliably, leaving whole pages blank. This global handler is
 * the single source of truth: it runs from the guaranteed-loaded app bundle,
 * is timing-safe (works whether or not DOMContentLoaded has already fired),
 * respects reduced-motion, and always has a fallback that reveals everything so
 * content can never get stuck invisible.
 */
(function initScrollReveal() {
    const run = () => {
        // Mark that JS is active so the no-JS CSS fallback can bow out.
        document.documentElement.classList.add('js');

        const els = Array.from(document.querySelectorAll('.reveal-on-scroll'));
        if (!els.length) return;

        const reduceMotion = window.matchMedia &&
            window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        const revealAll = () => els.forEach((el) => el.classList.add('revealed'));

        // No IntersectionObserver support or reduced motion → just show it all.
        if (reduceMotion || typeof IntersectionObserver === 'undefined') {
            revealAll();
            return;
        }

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        els.forEach((el) => {
            // Anything already in view on load is revealed immediately.
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                el.classList.add('revealed');
            } else {
                observer.observe(el);
            }
        });

        // Safety net: never let content stay hidden. If something never
        // intersects (odd layouts, print, etc.) reveal it after a beat.
        window.addEventListener('load', () => setTimeout(revealAll, 1200));
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', run);
    } else {
        run();
    }
})();
