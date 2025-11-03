<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard Siswa') - PPDB Online</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gray-50" x-data="{ profileModalOpen: false }" @keydown.escape.window="profileModalOpen = false">

    @include('partials.nav-siswa')

    <main>
        @yield('content')
    </main>
    
    <div x-show="profileModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" style="display: none;">
        <div @click.away="profileModalOpen = false" class="bg-white rounded-lg shadow-xl p-6 sm:p-8 w-11/12 max-w-2xl mx-auto max-h-[90vh] overflow-y-auto">
            <div class="mb-4 flex items-start justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Ubah Profil Saya</h2>
                <button type="button" @click="profileModalOpen = false" class="rounded p-1 text-gray-500 hover:bg-gray-100">✕</button>
            </div>
            
            <form action="{{ route('siswa.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-1 text-center" x-data="{ photoPreview: '{{ Auth::user()->pas_foto ? Storage::url(Auth::user()->pas_foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->nama_lengkap) }}' }">
                        <img :src="photoPreview" alt="Foto Profil" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-gray-200">
                        <label for="modal_pas_foto" class="mt-4 inline-block cursor-pointer px-4 py-2 text-sm text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">Ganti Foto</label>
                        <input type="file" name="pas_foto" id="modal_pas_foto" class="hidden" @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                        <p class="text-xs text-gray-500 mt-2">JPG, PNG maks. 2MB</p>
                    </div>

                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <label for="modal_nama_lengkap" class="block text-sm font-medium">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="modal_nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->nama_lengkap) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="modal_email" class="block text-sm font-medium">Alamat Email</label>
                            <input type="email" name="email" id="modal_email" value="{{ old('email', Auth::user()->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="border-t pt-6">
                            <label class="block text-sm font-medium">Ubah Kata Sandi</label>
                            <p class="text-xs text-gray-500 mb-2">Kosongkan jika tidak ingin mengubah.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div><label for="modal_password" class="block text-sm font-medium">Kata Sandi Baru</label><input type="password" name="password" id="modal_password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                                <div><label for="modal_password_confirmation" class="block text-sm font-medium">Konfirmasi</label><input type="password" name="password_confirmation" id="modal_password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-5 border-t flex justify-end gap-3">
                    <button type="button" @click="profileModalOpen = false" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Batal</button>
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    @stack('scripts')
    {{-- Flowbite dan AOS --}}
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
        @if ($errors->any())
            window.addEventListener('alpine:init', () => {
                Alpine.data('page', () => ({
                    init() {
                        this.$store.app.profileModalOpen = true;
                    }
                }))
            });
        @endif
    </script>
</body>
</html>

