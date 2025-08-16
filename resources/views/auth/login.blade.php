@vite(['resources/css/app.css', 'resources/js/app.js'])


<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-900 dark:to-gray-800 px-4">
  <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100 dark:border-gray-700">
    
    <!-- Logo / Branding -->
    <div class="text-center">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 dark:bg-blue-900 mb-4">
        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
          <path d="M2 5a2 2 0 012-2h3.5a.5.5 0 01.5.5V5H16a2 2 0 012 2v1H2V5zM2 9h16v6a2 2 0 01-2 2H4a2 2 0 01-2-2V9z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">PPDB Online</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400">Masuk ke akun admin Anda</p>
    </div>

    <!-- Form -->
    <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" id="email" name="email" placeholder="name@example.com" required
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all duration-200" />
      </div>

      <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password" name="password" required
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all duration-200" />
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center">
          <input id="remember" name="remember" type="checkbox"
            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
          <span class="ml-2 text-sm text-gray-900 dark:text-gray-300">Ingat saya</span>
        </label>
        <a href="#" class="text-sm text-blue-600 hover:underline dark:text-blue-400">Lupa password?</a>
      </div>

      <button type="submit"
        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center transition-all duration-200 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
        Masuk
      </button>
    </form>
    <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600">
                ← Kembali ke Dashboard
            </a>
        </div>
  </div>
</div>
