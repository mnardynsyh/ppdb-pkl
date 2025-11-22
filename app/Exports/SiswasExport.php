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
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SiswasExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = Siswa::query()->with(['ayah', 'ibu', 'sekolahAsal']); 

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

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'NISN',         
            'NIK',
            'Jenis Kelamin',
            'Asal Sekolah', 
            'Alamat Sekolah',
            'Tahun Lulus',  
            'Status',       
            'Nama Ayah',    
            'NIK Ayah',
            'Nama Ibu',     
            'NIK Ibu',
        ];
    }

    public function map($siswa): array
    {
        $namaAyah = $siswa->ayah->nama_lengkap ?? $siswa->ayah->nama ?? '-';
        $nikAyah  = $siswa->ayah->nik ?? '-';
        $namaIbu  = $siswa->ibu->nama_lengkap ?? $siswa->ibu->nama ?? '-';
        $nikIbu   = $siswa->ibu->nik ?? '-';

        $sekolahAsal = $siswa->sekolahAsal; 

        return [
            $siswa->nama_lengkap,
            $siswa->nisn,
            $siswa->nik,
            $siswa->jenis_kelamin,
            $sekolahAsal->nama_sekolah ?? '-',
            $sekolahAsal->alamat_sekolah ?? '-',
            $sekolahAsal->tahun_lulus ?? '-',
            $siswa->status_pendaftaran,
            $namaAyah,
            $nikAyah,
            $namaIbu,
            $nikIbu,
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF4F46E5',
                ],
            ],
        ]);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FFD1D5DB'],
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())->applyFromArray($styleArray);
    }
}