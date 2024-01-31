/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/**/*.php", "./views/**/*.php"],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: ["dark"],
  },
  plugins: [require("daisyui")],
}

