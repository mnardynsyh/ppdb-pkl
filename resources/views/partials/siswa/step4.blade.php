<div x-show="step === 4" class="space-y-6 animate-fade-in">
    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">Langkah 4: Unggah Berkas Pendaftaran</h3>
    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
        <p class="font-bold">Perhatian!</p>
        <p>Pastikan file yang diunggah adalah format <span class="font-semibold">.jpg, .jpeg,</span> atau <span class="font-semibold">.png</span>. Ukuran maksimal 2MB.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="pas_foto" class="block mb-2 text-sm font-medium text-gray-900">Pas Foto (3x4)</label>
            <input type="file" id="pas_foto" name="pas_foto" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
        </div>
        <div>
            <label for="scan_kk" class="block mb-2 text-sm font-medium text-gray-900">Scan Kartu Keluarga</label>
            <input type="file" id="scan_kk" name="scan_kk" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
        </div>
        <div>
            <label for="scan_akta" class="block mb-2 text-sm font-medium text-gray-900">Scan Akta Kelahiran</t_sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
        </div>
        <div>
            <label for="scan_ijazah" class="block mb-2 text-sm font-medium text-gray-900">Scan Ijazah / SKL</label>
            <input type="file" id="scan_ijazah" name="scan_ijazah" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
        </div>
    </div>
</div>
