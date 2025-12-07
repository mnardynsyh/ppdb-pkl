<div class="relative">
    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-neutral-100 rounded-full -z-10"></div>
    <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-primary-500 rounded-full -z-10 transition-all duration-500 ease-out"
         :style="'width: ' + ((step - 1) / 4 * 100) + '%'"></div>

    <ol class="flex items-center justify-between w-full">
        @foreach(['Data Diri', 'Orang Tua', 'Sekolah', 'Berkas', 'Selesai'] as $index => $label)
            @php $num = $index + 1; @endphp
            <li class="relative flex flex-col items-center group cursor-pointer" @click="if(step > {{ $num }}) step = {{ $num }}">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold border-4 transition-all duration-300 z-10"
                     :class="step >= {{ $num }} ? 'bg-primary-600 border-white text-white shadow-lg shadow-primary-500/30 scale-110' : 'bg-white border-neutral-100 text-neutral-300'">
                    <span x-show="step > {{ $num }}"><i class="fa-solid fa-check"></i></span>
                    <span x-show="step <= {{ $num }}">{{ $num }}</span>
                </div>
                <span class="absolute top-12 text-[10px] sm:text-xs font-bold uppercase tracking-wider text-center w-32 transition-all duration-300"
                      :class="step >= {{ $num }} ? 'text-primary-700 font-extrabold translate-y-0' : 'text-neutral-400 translate-y-1 opacity-80'">
                    {{ $label }}
                </span>
            </li>
        @endforeach
    </ol>
</div>
<div class="h-10 md:h-8"></div>