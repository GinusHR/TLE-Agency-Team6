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
            },
            fontFamily: {
                sans: ['Figtree', ...require('tailwindcss/defaultTheme').fontFamily.sans],
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
