<div x-show="step === 3" class="space-y-6 animate-fade-in">
    <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">Langkah 3: Data Sekolah Asal</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="asal_sekolah" class="block mb-2 text-sm font-medium text-gray-900">Nama Sekolah Asal</label>
            <input type="text" id="asal_sekolah" name="asal_sekolah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: SMP Negeri 1 Jakarta" required>
        </div>
        <div>
            <label for="tahun_lulus" class="block mb-2 text-sm font-medium text-gray-900">Tahun Lulus</label>
            <input type="number" id="tahun_lulus" name="tahun_lulus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: 2024" required>
        </div>
        <div class="md:col-span-2">
            <label for="alamat_sekolah" class="block mb-2 text-sm font-medium text-gray-900">Alamat Sekolah Asal</label>
            <textarea id="alamat_sekolah" name="alamat_sekolah" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Alamat lengkap sekolah asal"></textarea>
        </div>
    </div>
</div>
