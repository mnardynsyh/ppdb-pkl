<div x-show="step === 5" class="text-center animate-fade-in">
    <h3 class="text-2xl font-semibold text-gray-800">Langkah 5: Konfirmasi Akhir</h3>
    <div class="flex justify-center my-6">
        <svg class="w-24 h-24 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <p class="text-gray-600">
        Anda telah mencapai langkah terakhir. Silakan periksa kembali semua data yang telah Anda isikan pada langkah-langkah sebelumnya untuk memastikan tidak ada kesalahan.
    </p>

    <div class="mt-6 flex items-center justify-center">
        <input id="konfirmasi-checkbox" type="checkbox" x-model="konfirmasi" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
        <label for="konfirmasi-checkbox" class="ml-2 text-sm font-medium text-gray-900">Saya menyatakan bahwa seluruh data yang saya isikan adalah benar dan dapat dipertanggungjawabkan.</label>
    </div>
</div>
