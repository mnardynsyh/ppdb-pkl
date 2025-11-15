/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
        colors: {
          'primary-dark': '#253D2C',
          'primary-mid': '#2E6F40',
          'accent-green': '#68BA7F',
          'accent-light': '#CFFFDC',
        }
      }

  },
  plugins: [
    require('flowbite/plugin')
  ],
}
