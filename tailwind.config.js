import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                "navy-base": "#070f1e",
                "navy-surface": "#0b1b33",
                "navy-card": "#102344",
                "primary": "#ea580c",
                "primary-hover": "#c2410c",
                "accent-amber": "#f59e0b",
                "accent-coral": "#ef4444",
                "surface": "#f8f9ff",
                "surface-low": "#eff4ff",
                "on-surface": "#070f1e",
                "on-surface-variant": "#475569",
                brand: {
                    dark: '#070f1e',
                    navy: '#0b1b33',
                    surface: '#102344',
                    primary: '#ea580c',
                    amber: '#f59e0b',
                    coral: '#ef4444',
                },
            },
            fontFamily: {
                "headline": ["Space Grotesk", "sans-serif"],
                "body": ["Plus Jakarta Sans", "sans-serif"],
                "serif": ["Playfair Display", "serif"],
                "mono": ["JetBrains Mono", "monospace"],
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'glow': '0 0 25px rgba(234, 88, 12, 0.35)',
                'glow-amber': '0 0 25px rgba(245, 158, 11, 0.35)',
                'glow-navy': '0 0 35px rgba(7, 15, 30, 0.4)',
                '2xs': '0 1px 2px rgba(0, 0, 0, 0.05)',
                'xs': '0 2px 4px rgba(0, 0, 0, 0.05)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};