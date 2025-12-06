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
        // Palet Semantic 'Soft Teal'
        primary: {
          50: '#F0FDFA',  // Latar belakang sangat muda (active state di sidebar)
          100: '#CCFBF1', // Aksen ringan
          200: '#99F6E4', // Border lembut
          300: '#5EEAD4',
          400: '#2DD4BF',
          500: '#14B8A6', // Warna Utama (Tombol, Icon, Link) - Soft Teal Standard
          600: '#0D9488', // Hover state
          700: '#0F766E', // Active state / Text headings
          800: '#115E59', // Sidebar background (opsi gelap)
          900: '#134E4A', // Text sangat gelap
          950: '#042F2E',
        },
        // Warna netral yang hangat (bukan gray/slate standar yang dingin)
        neutral: {
          50: '#F8FAFC',  // Pengganti bg-[#F0F2F5]
          100: '#F1F5F9',
          200: '#E2E8F0', // Border card
          300: '#CBD5E1',
          400: '#94A3B8', // Text secondary
          500: '#64748B',
          600: '#475569',
          700: '#334155',
          800: '#1E293B', // Text primary
          900: '#0F172A',
        }
      },
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'sans-serif'], // Pertahankan Poppins untuk kesan modern
      }
    }
  },
  plugins: [
    require('flowbite/plugin')
  ],
}