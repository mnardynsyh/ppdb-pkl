@vite(['resources/css/app.css', 'resources/js/app.js']) 

<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <div class="w-full max-w-3xl bg-white border border-gray-200 rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Silahkan Registrasi Agar Bisa Login ke Dalam Web PPDB Kami</h2>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('wali.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @csrf
            <div>
                <label for="nama_wali" class="block mb-1 text-sm font-medium text-gray-900">Nama Wali Murid</label>
                <input type="text" name="nama_wali" id="nama_wali" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>

            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>

            <div>
                <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>

            <div>
                <label for="password_confirmation" class="block mb-1 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>

            <div>
                <label for="no_hp" class="block mb-1 text-sm font-medium text-gray-900">No HP</label>
                <input type="text" name="no_hp" id="no_hp" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>

            <div class="sm:col-span-2">
                <label for="alamat" class="block mb-1 text-sm font-medium text-gray-900">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
            </div>

            <div class="sm:col-span-2">
                <button type="submit" 
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none 
                           focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Daftar
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600">
                ← Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
