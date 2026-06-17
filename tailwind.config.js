import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    primary: '#0a0a0a',
                    secondary: '#111827',
                    card: '#1f2937',
                },
                gold: {
                    DEFAULT: '#D4AF37',
                    light: '#F5B041',
                },
                emerald: {
                    DEFAULT: '#0D9488',
                    light: '#10B981',
                },
            },
        },
    },

    plugins: [forms],
};
