<div x-show="step === 5" class="space-y-8 animate-fade-in text-center">
    <div class="max-w-2xl mx-auto">
        {{-- Ikon dan Teks Header --}}
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="mt-4 text-2xl font-bold text-slate-800">Konfirmasi Akhir</h3>
        <p class="mt-2 text-slate-600">
            Anda hampir selesai! Mohon periksa kembali semua data yang telah Anda isikan pada langkah-langkah sebelumnya untuk memastikan tidak ada kesalahan.
        </p>
    </div>

    {{-- Kartu Konfirmasi --}}
    <div class="flex items-center justify-center p-6 bg-slate-50 border border-slate-200 rounded-lg max-w-lg mx-auto shadow-sm">
        <input id="konfirmasi-checkbox" type="checkbox" x-model="konfirmasi" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
        <label for="konfirmasi-checkbox" class="ml-3 text-base font-medium text-slate-700 text-left">
            Saya menyatakan bahwa semua data yang saya isikan adalah benar dan dapat dipertanggungjawabkan.
        </label>
    </div>

    {{-- Kotak Informasi --}}
    <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 rounded-r-lg max-w-lg mx-auto text-left" role="alert">
        <p class="font-bold">Informasi Penting</p>
        <p class="text-sm">Setelah pendaftaran dikirim, Anda masih dapat mengubah data selama status pendaftaran Anda masih <strong class="font-semibold">"Pending"</strong> dan belum diverifikasi oleh panitia.</p>
    </div>
</div>

