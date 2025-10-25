/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/**/*.{js,jsx}',
    './templates/**/*.html',
    './parts/**/*.html',
    './patterns/**/*.php',
    './*.php',
  ],
  safelist: [
    'text-red-500',
    'font-bold',
    'text-4xl',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
