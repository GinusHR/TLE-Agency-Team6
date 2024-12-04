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
            colors: {
                // Custom colors for the form
                'cream': '#FBFCF6',
                'moss-light': '#E2ECC8',
                'moss-medium': '#92AA83',
                'moss-dark': '#333D2B',
                'violet-light': '#AA0160',
                'violet-dark': '#7C1A51',
                'yellow': '#FAEC02',
                'error-red': '#FF0000',
                'unchecked-gray': '#A5A5A4',
            },
            fontFamily: {
                // Custom font family for consistent design
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                // Custom spacings for padding and margin
                '8-plus': '2.25rem', // For form padding
            },
            borderRadius: {
                // Custom border-radius for smoother forms
                'lg-plus': '0.625rem',
            },
            boxShadow: {
                // Custom shadow styles for the form and buttons
                'custom-light': '0 4px 6px rgba(0, 0, 0, 0.1)',
                'custom-dark': '0 6px 8px rgba(0, 0, 0, 0.15)',
            },
            gridTemplateColumns: {
                // Custom grid layout for checkbox days
                'form-days': 'repeat(7, 1fr)', // Equal-width columns for 7 days
            },
            fontSize: {
                // Custom font size for form headers
                '2.5xl': ['1.75rem', { lineHeight: '2rem' }],
            },
        },
    },

    plugins: [
        forms, // Tailwind forms plugin for better form styling
    ],
};
