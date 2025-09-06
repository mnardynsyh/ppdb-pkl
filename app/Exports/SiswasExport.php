<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
// [BARU] Menambahkan use statement untuk format kolom
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// [BARU] Menambahkan implementasi WithColumnFormatting
class SiswasExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $request;

    // Menerima parameter filter dari controller
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
    * Menentukan query untuk mengambil data siswa.
    */
    public function query()
    {
        $query = Siswa::query()->with('orangTuaWali'); // Load relasi

        if ($this->request->filled('status')) {
            $query->where('status_pendaftaran', $this->request->status);
        }

        if ($this->request->filled('search')) {
            $search = $this->request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        return $query->latest();
    }

    /**
    * Menentukan judul kolom (header) untuk file Excel.
    */
    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NISN',
            'NIK',
            'Jenis Kelamin',
            'Asal Sekolah',
            'Tahun Lulus',
            'Status',
            'Nama Ayah',
            'NIK Ayah',
            'Nama Ibu',
            'NIK Ibu',
        ];
    }

    /**
    * Memetakan setiap baris data siswa ke kolom yang sesuai.
    */
    public function map($siswa): array
    {
        return [
            $siswa->nama_lengkap,
            $siswa->nisn,
            $siswa->nik,
            $siswa->jenis_kelamin,
            $siswa->asal_sekolah,
            $siswa->tahun_lulus,
            $siswa->status_pendaftaran,
            $siswa->orangTuaWali->nama_ayah ?? '-',
            $siswa->orangTuaWali->nik_ayah ?? '-',
            $siswa->orangTuaWali->nama_ibu ?? '-',
            $siswa->orangTuaWali->nik_ibu ?? '-',
        ];
    }
    
    /**
     * [BARU] Menentukan format kolom agar NIK tidak menjadi notasi ilmiah.
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT, // Kolom NIK Siswa
            'I' => NumberFormat::FORMAT_TEXT, // Kolom NIK Ayah
            'K' => NumberFormat::FORMAT_TEXT, // Kolom NIK Ibu
        ];
    }

    /**
     * Menerapkan styling pada sheet Excel.
     */
    public function styles(Worksheet $sheet)
    {
        // Style baris pertama (heading)
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'], // Warna Teks: Putih
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF4F46E5', // Warna Latar: Biru (Indigo-600)
                ],
            ],
        ]);

        // Menambahkan border ke seluruh tabel
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FFD1D5DB'], // Warna Border: Abu-abu (Gray-300)
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())->applyFromArray($styleArray);
    }
}

