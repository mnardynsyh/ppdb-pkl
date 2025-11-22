{{-- Footer --}}
<footer class="bg-gray-800 text-white py-8">
    <div class="max-w-screen-xl mx-auto px-4 text-center">
        <p>&copy; {{ date('Y') }} PPDB Online. All Rights Reserved.</p>
        <p class="text-sm text-gray-400 mt-2">{{$global_pengaturan->alamat_sekolah ?? 'Data belum dikonfigurasi'}}</p>
    </div>
</footer>