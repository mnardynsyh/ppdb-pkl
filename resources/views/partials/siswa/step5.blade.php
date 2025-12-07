<div x-show="step === 5" class="space-y-8 animate-fade-in text-center py-8">
    <div class="max-w-lg mx-auto">
        <div class="w-16 h-16 bg-primary-50 rounded-full flex items-center justify-center mx-auto mb-4 text-primary-600 border-4 border-primary-100"><i class="fa-solid fa-list-check text-2xl"></i></div>
        <h3 class="text-2xl font-bold text-neutral-900">Konfirmasi Akhir</h3>
        <p class="text-neutral-500 text-sm">Pastikan data sudah benar sebelum dikirim.</p>
    </div>

    <div class="max-w-xl mx-auto">
        <label class="flex items-start gap-4 p-5 bg-white border border-neutral-200 rounded-2xl cursor-pointer hover:border-primary-300 transition-all">
            <input type="checkbox" x-model="konfirmasi" class="mt-1 w-5 h-5 text-primary-600 rounded border-neutral-300 focus:ring-primary-500" {{ $isLocked ? 'disabled' : '' }}>
            <span class="text-sm text-left text-neutral-600">Saya menyatakan data yang diisi adalah benar dan dapat dipertanggungjawabkan.</span>
        </label>
    </div>
</div>