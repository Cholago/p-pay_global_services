import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        fontFamily: {
            sans: ['Graphik', 'sans-serif'],
            serif: ['Merriweather', 'serif'],
        },
        extend: {
            colors: {
                //brand primary color
                primary: {
                  light: '#9C111A',  // Light shade
                  DEFAULT: '#9C111A', // Default brand color
                  dark: '#9C111A',    // Dark shade
                  50: '#FA4652',   // Lightest shade (almost white)
                  100: '#D62732',  // Very light
                  200: '#C9202B',  // Light
                  300: '#BF1722',  // Medium light
                  400: '#B2151F',  // Medium
                  500: '#A8131D',  // Default (medium dark)
                  600: '#9C111A',  // Darker (this will be bg-primary-600)
                  700: '#8F0F17',  // Dark
                  800: '#810D14',  // Very dark
                  900: '#710B11',  // Darkest
                },
              },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
