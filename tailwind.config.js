module.exports = {
    theme: {
        extend: {
            width: {
                '96': '24rem',
            }
        },
        spinner: (theme) => ({
            default: {
                color: '#dae1e7', // color you want to make the spinner
                size: '1em', // size of the spinner (used for both width and height)
                border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
                speed: '500ms', // the speed at which the spinner should rotate
            },
        }),
		fontFamily: {
			'sans': ['Roboto', 'Helvetica', 'Arial', 'sans-serif']
		}
    },
    variants: {
        boxShadow: ['responsive', 'hover', 'focus'],
        dropShadow: ['responsive', 'hover', 'focus'],
    },
    plugins: [
        require('tailwindcss-spinner')(),
        require('tailwindcss'),
        require('autoprefixer'),
        require('@tailwindcss/aspect-ratio'),
    ],
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
}
