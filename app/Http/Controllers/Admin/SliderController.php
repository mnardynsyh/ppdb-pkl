<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Tampilkan daftar slider.
     */
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.slider', compact('sliders'));
    }

    /**
     * Simpan slider baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'nullable|integer|min:0',
        ]);

        // Simpan gambar
        $path = $request->file('image')->store('sliders', 'public');

        // Tentukan urutan otomatis jika kosong
        $maxOrder = Slider::max('order') ?? 0;
        $order = $validated['order'] ?? $maxOrder + 1;

        Slider::create([
            'image_path' => $path,
            'order' => $order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Slide baru berhasil ditambahkan.');
    }

    /**
     * Perbarui slider.
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'order' => $validated['order'],
            'is_active' => $request->boolean('is_active'),
        ];

        // Jika ada file baru, hapus lama dan simpan baru
        if ($request->hasFile('image')) {
            if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
                Storage::disk('public')->delete($slider->image_path);
            }

            $data['image_path'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Slide berhasil diperbarui.');
    }

    /**
     * Hapus slider.
     */
    public function destroy(Slider $slider)
    {
        if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
            Storage::disk('public')->delete($slider->image_path);
        }

        $slider->delete();

        return redirect()
            ->route('admin.slider.index')
            ->with('success', 'Slide berhasil dihapus.');
    }
}
