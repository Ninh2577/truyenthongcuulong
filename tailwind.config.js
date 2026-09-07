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
                brand: {
                    dark: '#0B132B',
                    navy: '#1C2541',
                    surface: '#1E293B',
                    card: '#0F172A',
                    cyan: '#00E5FF',
                    teal: '#00B4D8',
                    blue: '#2563EB',
                    gold: '#FFB703',
                    orange: '#FB8500',
                },
            },
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Outfit', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'glow': '0 0 25px rgba(0, 229, 255, 0.25)',
                'glow-gold': '0 0 25px rgba(255, 183, 3, 0.25)',
                'glow-blue': '0 0 30px rgba(37, 99, 235, 0.3)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};