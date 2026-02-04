import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

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
                'ppid-primary': '#1A305E', // Midnight Navy
                'ppid-accent': '#D4AF37',  // Metallic Gold
                'ppid-text': '#4A5568',    // Slate Gray
            },
        },
    },

    plugins: [forms, typography],
    darkMode: 'class',
};
