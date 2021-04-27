const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            spacing: {
                '13': '3.25rem',
                '15': '3.75rem',
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
              },
            backgroundImage: (theme) => ({
                'gas-logo' : "url('/images/logo.jpg')"
            }),
            backgroundSize: {
                'auto': 'auto',
                'cover': 'cover',
                'contain': 'contain',
                '50%': '50%',
                '40%': '40%',
                '25%': '25%',
                '16': '4rem',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            screens :{
                'print' : {'raw': 'print'}
            },
            colors: {
                primary: defaultTheme.colors.green
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
