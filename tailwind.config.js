/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
        "node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx,vue}",
    ],
    theme: {
        extend: {
            fontFamily: {
                Poppins: "Poppins",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
