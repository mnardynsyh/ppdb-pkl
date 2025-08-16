<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendidikan;

class PendidikanController extends Controller
{
    public function index()
    {
        $pendidikan = Pendidikan::orderBy('id_pendidikan', 'asc')->get();
        return view('admin.pendidikan', compact('pendidikan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendidikan' => 'required|string|max:100',
        ]);

        Pendidikan::create([
            'pendidikan' => $request->pendidikan,
        ]);

        return redirect()->back()->with('success', 'Data pendidikan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pendidikan' => 'required|string|max:100',
        ]);

        $pendidikan = Pendidikan::findOrFail($id);
        $pendidikan->update([
            'pendidikan' => $request->pendidikan,
        ]);

        return redirect()->back()->with('success', 'Data pendidikan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
        $pendidikan->delete();

        return redirect()->back()->with('success', 'Data pendidikan berhasil dihapus.');
    }
}
