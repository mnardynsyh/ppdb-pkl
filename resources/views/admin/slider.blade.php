@extends('layouts.admin')

@section('title', 'Manajemen Slider')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold text-gray-800">Manajemen Slider</h1>
    <button data-modal-target="addSliderModal" data-modal-toggle="addSliderModal"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Tambah Slider
    </button>
</div>

{{-- Flash Message --}}
@if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

{{-- Daftar Slider --}}
<div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
    @forelse ($sliders as $slider)
        <div class="bg-white shadow rounded-xl overflow-hidden border">
            <img src="{{ $slider->image_url }}" class="w-full h-40 object-cover" alt="Slider">

            <div class="p-4 space-y-2">
                {{-- FORM UPDATE --}}
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-3">
                        <label class="block text-sm text-gray-700">Gambar (opsional)</label>
                        <input type="file" name="image"
                            class="w-full text-sm border border-gray-300 rounded-lg p-2">

                        <label class="block text-sm text-gray-700">Urutan</label>
                        <input type="number" name="order"
                            value="{{ $slider->order }}"
                            class="w-full text-sm border border-gray-300 rounded-lg p-2" required>

                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" name="is_active" {{ $slider->is_active ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>

                    <div class="flex justify-between mt-4">
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Update
                        </button>

                        {{-- Tombol hapus dibuat terpisah --}}
                        <button type="button"
                            onclick="document.getElementById('delete-slider-{{ $slider->id }}').submit();"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </div>
                </form>

                {{-- FORM DELETE TERPISAH --}}
                <form id="delete-slider-{{ $slider->id }}" action="{{ route('admin.slider.destroy', $slider->id) }}"
                    method="POST" class="hidden" onsubmit="return confirm('Yakin ingin menghapus slider ini?');">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-10 text-gray-500">
            Belum ada slider yang ditambahkan.
        </div>
    @endforelse
</div>
    

{{-- Modal Tambah Slider --}}
<div id="addSliderModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center w-full h-full bg-black/50 backdrop-blur-sm flex">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Tambah Slider Baru</h2>
        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm text-gray-700">Gambar</label>
                <input type="file" name="image" required
                    class="w-full text-sm border border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label class="block text-sm text-gray-700">Urutan</label>
                <input type="number" name="order"
                    class="w-full text-sm border border-gray-300 rounded-lg p-2" placeholder="0">
            </div>

            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="is_active" checked>
                <span class="text-sm text-gray-700">Aktif</span>
            </label>

            <div class="flex justify-end gap-2 pt-4">
                <button type="button" data-modal-hide="addSliderModal"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection



@push('scripts')
<script>
function sliderManager() {
    return {
        showModal: false,
        isEdit: false,
        formAction: '',
        form: {
            id: null,
            order: 0,
            is_active: true,
            image_url: ''
        },

        init() {},

        openAddModal() {
            this.isEdit = false;
            this.formAction = "{{ route('admin.slider.store') }}";
            this.form = { id: null, order: 0, is_active: true, image_url: '' };
            this.showModal = true;
        },

        openEditModal(slider) {
            this.isEdit = true;
            this.form = { ...slider };
            this.formAction = `{{ url('admin/slider') }}/${slider.id}`;
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
        }
    }
}
</script>
@endpush
