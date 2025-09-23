/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js" // <- ini penting untuk Flowbite
  ],
  theme: {
    extend: {
      colors: {
        'cream': '#fefae0',
        'olive': '#606c38',
        'dark-olive': '#283618',
        'ochre': '#dda15e',
        'terracotta': '#bc6c25',
      },
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}
