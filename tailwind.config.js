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
                'ppid-primary': '#800020', // Burgundy (Ganti dari Navy)
                'ppid-primary-hover': '#4a0012', // Darker Burgundy
                'ppid-primary-light': '#9b1c31', // Lighter Burgundy
                'ppid-primary-dark': '#2a000a', // Deep Burgundy/Blackish

                'ppid-accent': '#D4AF37',  // Gold (Tetap)
                'ppid-accent-hover': '#B08D26', // Darker Gold (Tetap)

                'ppid-text': '#000000',    // Pure Black (Ganti dari Slate)
                'ppid-text-light': '#666666', // Neutral Gray

                'sidebar-bg': '#000000',   // Pure Black (Ganti dari Dark Gray Blue)
                'sidebar-active': '#ffffff', // White (Tetap)
                'sidebar-hover': 'rgba(255, 255, 255, 0.05)', // Configurable sidebar hover color

                'ppid-accent-light': '#EAC548', // Lighter Gold for gradients

                // Status Colors (Tetap standar fungsional)
                'ppid-error': '#D1001F',
                'ppid-success': '#10B981',
                'ppid-warning': '#F59E0B',
                'ppid-info': '#3B82F6',

                // Custom Brand Colors (Disesuaikan ke tema Burgundy/Hitam)
                'ppid-purple': '#800020', // Diubah ke Burgundy agar senada
                'ppid-purple-light': '#9b1c31', // Diubah ke Light Burgundy
                'ppid-blue': '#800020', // Diubah ke Burgundy (biasanya untuk link)

                // Functional Colors
                'page-bg': '#ffffff',      // White
                'page-bg-dark': '#000000', // Black

                // Legacy Support
                'dark-blue-gradient': '#000000', // Diubah ke Black
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
