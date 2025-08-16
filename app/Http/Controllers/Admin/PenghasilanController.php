<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penghasilan;

class PenghasilanController extends Controller
{
    public function index()
    {
        $penghasilan = Penghasilan::orderBy('id_penghasilan', 'asc')->get();
        return view('admin.penghasilan', compact('penghasilan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penghasilan' => 'required|string|max:100',
        ]);

        Penghasilan::create([
            'penghasilan' => $request->penghasilan,
        ]);

        return redirect()->back()->with('success', 'Data penghasilan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penghasilan' => 'required|string|max:100',
        ]);

        $penghasilan = Penghasilan::findOrFail($id);
        $penghasilan->update([
            'penghasilan' => $request->penghasilan,
        ]);

        return redirect()->back()->with('success', 'Data penghasilan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penghasilan = Penghasilan::findOrFail($id);
        $penghasilan->delete();

        return redirect()->back()->with('success', 'Data penghasilan berhasil dihapus.');
    }
}
