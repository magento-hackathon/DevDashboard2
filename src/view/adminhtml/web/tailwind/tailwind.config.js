const colors = require("tailwindcss/colors");

module.exports = {
    purge: ["../../templates/**/*.phtml"],
    darkMode: false,
    theme: {
        colors: {
            green: colors.green,
        },
        textColor: {
        },
        backgroundColor: {
            green: colors.green,
        },
        borderColor: {
        },
    },
};
