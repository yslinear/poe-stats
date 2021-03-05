module.exports = {
    important: true,
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        maxWidth: {
            'fit-content': 'fit-content',
        },
        extend: {},
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
