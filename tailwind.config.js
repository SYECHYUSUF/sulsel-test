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
                'ppid-primary': '#800020',
                'ppid-primary-hover': '#4a0012',
                'ppid-primary-light': '#9b1c31',
                'ppid-primary-dark': '#2a000a',

                'ppid-accent': '#D4AF37',
                'ppid-accent-hover': '#B08D26',

                'ppid-text': '#000000',
                'ppid-text-light': '#666666',

                'sidebar-bg': '#000000',
                'sidebar-active': '#ffffff',
                'sidebar-hover': 'rgba(255, 255, 255, 0.05)',

                'ppid-accent-light': '#EAC548',

                // Status Colors (Tetap standar fungsional)
                'ppid-error': '#D1001F',
                'ppid-success': '#10B981',
                'ppid-warning': '#F59E0B',
                'ppid-info': '#3B82F6',

                // Custom Brand Colors (Disesuaikan ke tema Burgundy/Hitam)
                'ppid-purple': '#800020',
                'ppid-purple-light': '#9b1c31',
                'ppid-blue': '#800020',

                // Functional Colors
                'page-bg': '#ffffff',      // White
                'page-bg-dark': '#000000', // Black

                // Legacy Support
                'dark-blue-gradient': '#000000',

                // Accessibility Menu Colors
                'access-primary': '#800020',        // Main theme color (matches ppid-primary)
                'access-primary-hover': '#4a0012', // Hover state
                'access-bg': '#ffffff',            // Panel background
                'access-bg-gray': '#f9fafb',       // Gray background (gray-50)
                'access-border': '#f3f4f6',        // Border color (gray-100)
                'access-border-orange': '#c2410c', // Orange border (orange-700)
                'access-button': '#f9fafb',        // Button background (gray-50)
                'access-button-hover': '#f3f4f6',  // Button hover (gray-100)
                'access-text': '#374151',          // Text color (gray-700)
                'access-text-muted': '#9ca3af',    // Muted text (gray-400)
            },
            backgroundImage: {
                'ppid-gradient-main': 'linear-gradient(to right, #1A305E, #2c3e50)',
                'ppid-gradient-hover': 'linear-gradient(to right, #122143, #1A305E)',
            },
        },
    },

    plugins: [forms, typography],
    darkMode: 'class',
};
