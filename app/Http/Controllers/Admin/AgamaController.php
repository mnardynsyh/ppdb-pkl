<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agama;

class AgamaController extends Controller
{
    public function index()
    {
        $agama = Agama::orderBy('id', 'asc')->get();
        return view('admin.agama', compact('agama'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'agama' => 'required|string|max:100',
        ]);

        Agama::create([
            'agama' => $request->agama,
        ]);

        return redirect()->back()->with('success', 'Data agama berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'agama' => 'required|string|max:100',
        ]);

        $agama = Agama::findOrFail($id);
        $agama->update([
            'agama' => $request->agama,
        ]);

        return redirect()->back()->with('success', 'Data agama berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penghasilan = Agama::findOrFail($id);
        $penghasilan->delete();

        return redirect()->back()->with('success', 'Data agama berhasil dihapus.');
    }
}
