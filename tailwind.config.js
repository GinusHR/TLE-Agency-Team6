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
                'cream' : '#FBFCF6',
                'moss-light': '#E2ECC8',
                'moss-medium': '#92AA83',
                'moss-dark' : '#333D2B',
                'violet-light': '#AA0160',
                'violet-dark': '#7C1A51',
                'yellow' : '#FAEC02',
                'unchecked-gray' : '#A5A5A4',
                'info-gray' : '#E1E2DB',
            },
            fontFamily: {
                sans: ['Figtree', ...require('tailwindcss/defaultTheme').fontFamily.sans],
                'playfair': ['Playfair Display', 'serif'],  // Gebruik de naam van het font zoals opgegeven in de Google Fonts URL
                radikal: ['Radikal', 'sans-serif'], // Voeg je nieuwe font toe
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
