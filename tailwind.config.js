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
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "orange": '#DB5A0F',
                "dark-orange": '#D6550A',
                "dark-gray": '#424242',
                "medium-gray": '#6F6B69',
                "light-gray": '#F5F5F5',
            }
        },
    },
    plugins: [],
};
