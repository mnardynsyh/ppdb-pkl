<ol class="flex w-full items-start text-sm font-medium text-center text-gray-500">
    {{-- Step 1 --}}
    <li class="flex-1">
        <div :class="step >= 1 ? 'text-blue-600' : ''" class="flex flex-col items-center w-full">
            <div :class="step >= 1 ? 'border-blue-600' : 'border-gray-500'" class="flex items-center justify-center w-10 h-10 rounded-full shrink-0 border-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z"/></svg>
            </div>
            {{-- Kontainer teks dengan tinggi tetap untuk menjaga alignment --}}
            <div class="mt-2 h-10 flex items-center justify-center">
                <span class="font-bold text-xs leading-tight text-center">Data Diri<br>Siswa</span>
            </div>
        </div>
    </li>

    {{-- Connector --}}
    <li class="flex-1 flex items-center pt-5 px-1 sm:px-2">
        <div class="w-full h-0.5" :class="step > 1 ? 'bg-blue-600' : 'bg-gray-200'"></div>
    </li>

    {{-- Step 2 --}}
    <li class="flex-1">
        <div :class="step >= 2 ? 'text-blue-600' : ''" class="flex flex-col items-center w-full">
            <div :class="step >= 2 ? 'border-blue-600' : 'border-gray-500'" class="flex items-center justify-center w-10 h-10 rounded-full shrink-0 border-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0110 9c-1.55 0-2.958.5-4.07 1.332A6.97 6.97 0 004 16c0 .34.024.673.07 1h8.86zM8 20a1 1 0 100-2 1 1 0 000 2z"/></svg>
            </div>
            <div class="mt-2 h-10 flex items-center justify-center">
                <span class="font-bold text-xs leading-tight text-center">Data<br>Ortu/Wali</span>
            </div>
        </div>
    </li>

    {{-- Connector --}}
    <li class="flex-1 flex items-center pt-5 px-1 sm:px-2">
        <div class="w-full h-0.5" :class="step > 2 ? 'bg-blue-600' : 'bg-gray-200'"></div>
    </li>

    {{-- Step 3 --}}
    <li class="flex-1">
        <div :class="step >= 3 ? 'text-blue-600' : ''" class="flex flex-col items-center w-full">
            <div :class="step >= 3 ? 'border-blue-600' : 'border-gray-500'" class="flex items-center justify-center w-10 h-10 rounded-full shrink-0 border-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>
            </div>
            <div class="mt-2 h-10 flex items-center justify-center">
                <span class="font-bold text-xs leading-tight text-center">Sekolah<br>Asal</span>
            </div>
        </div>
    </li>

    {{-- Connector --}}
    <li class="flex-1 flex items-center pt-5 px-1 sm:px-2">
        <div class="w-full h-0.5" :class="step > 3 ? 'bg-blue-600' : 'bg-gray-200'"></div>
    </li>

    {{-- Step 4 --}}
    <li class="flex-1">
        <div :class="step >= 4 ? 'text-blue-600' : ''" class="flex flex-col items-center w-full">
            <div :class="step >= 4 ? 'border-blue-600' : 'border-gray-500'" class="flex items-center justify-center w-10 h-10 rounded-full shrink-0 border-2">
                 <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>
            </div>
            <div class="mt-2 h-10 flex items-center justify-center">
                 <span class="font-bold text-xs leading-tight text-center">Unggah<br>Berkas</span>
            </div>
        </div>
    </li>

    {{-- Connector --}}
    <li class="flex-1 flex items-center pt-5 px-1 sm:px-2">
        <div class="w-full h-0.5" :class="step > 4 ? 'bg-blue-600' : 'bg-gray-200'"></div>
    </li>

    {{-- Step 5 --}}
    <li class="flex-1">
        <div :class="step >= 5 ? 'text-blue-600' : ''" class="flex flex-col items-center w-full">
            <div :class="step >= 5 ? 'border-blue-600' : 'border-gray-500'" class="flex items-center justify-center w-10 h-10 rounded-full shrink-0 border-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            </div>
            <div class="mt-2 h-10 flex items-center justify-center">
                <span class="font-bold text-xs leading-tight text-center">Konfirmasi<br>Data</span>
            </div>
        </div>
    </li>
</ol>

