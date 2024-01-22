/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.php", "./views/**/*.php"],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
}

