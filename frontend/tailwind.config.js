/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#FF7A00',
        'secondary': '#FFA14A',
      }
    },
  },
  plugins: [
    require('daisyui'),
  ],
  daisyui: {
    themes: [
      {
        orange: {
          'primary': '#FF7A00',
          'secondary': '#FFA14A',
        }
      }
    ]
  }
}