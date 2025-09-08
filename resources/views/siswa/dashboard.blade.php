

<div x-data="{ step: 1, konfirmasi: false, showModal: false, status: '{{ $siswa->status_pendaftaran }}' }" class="max-w-full mx-auto bg-white shadow-2xl rounded-xl p-4 sm:p-8 my-6 sm:my-10 border border-gray-200 relative">
    
    <div class="absolute top-4 right-4 md:top-6 md:right-6">
        <form action="{{ route('siswa.logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 flex items-center gap-2 text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="hidden sm:inline">Logout</span>
            </button>
        </form>
    </div>

    <h1 class="text-2xl md:text-3xl font-bold mb-2 text-center text-gray-800 pt-10 sm:pt-0">Formulir Pendaftaran Siswa Baru</h1>
    <p class="text-center text-gray-500 mb-8 px-4 sm:px-0">Silakan lengkapi semua data dengan benar.</p>

    @include('partials.siswa.stepper')

    <div class="mt-8">
        <form x-ref="pendaftaranForm" action="{{ route('siswa.dashboard.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            
            <fieldset :disabled="status !== 'pending'">
                @include('partials.siswa.step1')
                @include('partials.siswa.step2')
                @include('partials.siswa.step3')
                @include('partials.siswa.step4')
                @include('partials.siswa.step5')

                <div class="flex justify-between mt-10 pt-6 border-t">
                    <button type="button"
                            class="px-4 py-2 sm:px-6 text-sm sm:text-base bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            @click="if(step > 1) step--"
                            :disabled="step === 1">
                        Sebelumnya
                    </button>

                    <button type="button"
                            class="px-4 py-2 sm:px-6 text-sm sm:text-base bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300"
                            @click="if(step < 5) step++"
                            x-show="step < 5">
                        Berikutnya
                    </button>

                    <button type="button"
                            @click="showModal = true"
                            class="px-4 py-2 sm:px-6 text-sm sm:text-base bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            x-show="step === 5"
                            :disabled="!konfirmasi">
                        <span>{{ $siswa->orangTuaWali ? 'Simpan Perubahan' : 'Kirim Pendaftaran' }}</span>
                    </button>
                </div>
            </fieldset>
        </form>
    </div>

    <!-- Modal Konfirmasi -->
    <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-xl p-6 sm:p-8 w-11/12 max-w-md mx-auto">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                    <svg class="h-6 w-6 text-blue-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.546-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-5">Konfirmasi Pendaftaran</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Apakah Anda yakin semua data yang diisi sudah benar? Anda masih dapat mengubah data selama pendaftaran belum diverifikasi oleh panitia.
                    </p>
                </div>
                <div class="mt-6 flex justify-center gap-4">
                    <button type="button" @click="showModal = false" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                        Batal
                    </button>
                    <button type="button" @click="$refs.pendaftaranForm.submit()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Ya, Kirim Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>