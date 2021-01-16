const colors = require("tailwindcss/colors");

module.exports = {
    purge: ["./resources/views/**/*.blade.php", "./resources/js/**/*.vue"],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            height: {
                liveticker: "32rem"
            },
            padding: {
                40: "10rem"
            },
            colors: {
                teal: colors.teal
            }
        }
    },
    variants: {
        extend: {}
    },
    plugins: []
};
