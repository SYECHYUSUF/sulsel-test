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
                'ppid-primary': '#1A305E', // Midnight Navy - Main Brand Color
                'ppid-primary-hover': '#122143', // Darker navy for hovers
                'ppid-primary-light': '#2A4A7E', // Lighter navy for gradients/accents
                'ppid-primary-dark': '#0f172a', // Very dark blue/slate for gradients

                'ppid-accent': '#D4AF37',  // Metallic Gold - Highlights & Actions
                'ppid-accent-hover': '#B08D26', // Darker gold for hovers

                'ppid-text': '#4A5568',    // Slate Gray - Primary Text
                'ppid-text-light': '#94a3b8', // Slate 400 - Secondary/Muted Text

                'sidebar-bg': '#1a202c',   // Dark Gray Blue - Sidebar Background
                'sidebar-active': '#ffffff', // White - Active Sidebar Link Background

                // Functional Colors
                'page-bg': '#ffffff',      // Light mode background
                'page-bg-dark': '#0f172a', // Dark mode background (matches primary-dark/slate-900)

                // Legacy Support (to be safe)
                'dark-blue-gradient': '#2c3e50',
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
