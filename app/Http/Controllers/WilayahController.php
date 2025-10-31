<?php

namespace App\Http\Controllers;

// Pastikan Anda membuat model-model ini
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Mengambil daftar kabupaten berdasarkan provinsi_id.
     */
    public function getKabupaten(Request $request)
    {
        $kabupaten = Kabupaten::where('provinsi_id', $request->provinsi_id)
                              ->orderBy('nama')
                              ->get();
        return response()->json($kabupaten);
    }

    /**
     * Mengambil daftar kecamatan berdasarkan kabupaten_id.
     */
    public function getKecamatan(Request $request)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $request->kabupaten_id)
                              ->orderBy('nama')
                              ->get();
        return response()->json($kecamatan);
    }

    /**
     * Mengambil daftar desa berdasarkan kecamatan_id.
     */
    public function getDesa(Request $request)
    {
        $desa = Desa::where('kecamatan_id', $request->kecamatan_id)
                       ->orderBy('nama')
                       ->get();
        return response()->json($desa);
    }
}
