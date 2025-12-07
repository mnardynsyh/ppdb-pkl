<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $siswa->nama_lengkap }}</title>
    <style>
        @page {
            size: A4;
            margin: 1cm; /* Margin tipis untuk printer */
        }
        
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt; /* Ukuran font diperkecil agar muat */
            line-height: 1.2; /* Spasi baris lebih rapat */
            color: #000;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        /* Kop Surat Compact */
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 8px;
            margin-bottom: 15px;
            display: table;
            width: 100%;
        }
        .kop-logo img { width: 100%; height: auto; }
        .kop-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }
        .kop-text h3 { margin: 0; font-size: 12pt; font-weight: bold; }
        .kop-text h2 { margin: 2px 0; font-size: 16pt; font-weight: bold; text-transform: uppercase; }
        .kop-text p { margin: 0; font-size: 9pt; }

        /* Judul */
        .judul {
            text-align: center;
            margin-bottom: 15px;
        }
        .judul h1 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
        }
        .judul p { margin: 2px 0 0; font-size: 11pt; font-weight: bold; }

        /* Section Header */
        .section-header {
            font-weight: bold;
            border-bottom: 1px solid #000;
            margin-top: 10px;
            margin-bottom: 5px;
            font-size: 11pt;
            display: inline-block;
        }

        /* Tabel Data Biasa */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .table-data td {
            vertical-align: top;
            padding: 2px 0;
        }
        .label { width: 28%; }
        .sep { width: 2%; text-align: center; }
        .val { width: 70%; font-weight: bold; }

        /* Tabel Orang Tua (Side by Side) */
        .parent-container {
            width: 100%;
            margin-bottom: 5px;
        }
        .parent-col {
            width: 48%;
            vertical-align: top;
        }
        /* Tabel kecil di dalam kolom orang tua */
        .table-mini { width: 100%; border-collapse: collapse; }
        .table-mini td { vertical-align: top; padding: 1px 0; font-size: 10pt; }
        .mini-label { width: 35%; color: #444; }
        .mini-sep { width: 5%; text-align: center; }
        .mini-val { width: 60%; font-weight: bold; }

        /* Kotak Status */
        .status-box {
            border: 2px solid #000;
            padding: 8px;
            text-align: center;
            margin: 15px auto;
            width: 80%;
        }
        .status-text { font-size: 18pt; font-weight: bold; text-decoration: underline; display: block; margin-top: 5px; }

        /* Tanda Tangan */
        .ttd-wrapper {
            width: 100%;
            margin-top: 20px;
            display: table;
        }
        .ttd-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        .foto-kotak {
            width: 3cm; height: 4cm;
            border: 1px solid #000;
            margin: 0 auto;
            display: flex; align-items: center; justify-content: center;
            font-size: 9pt; color: #aaa;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT --}}
    <div class="kop-surat">
        <div class="kop-text">
            <h2>PANITIA PENERIMAAN PESERTA DIDIK BARU</h2>
            <p>{{ $global_pengaturan->alamat_sekolah ?? 'Alamat sekolah belum diatur.' }}</p>
            <p>Email: {{ $global_pengaturan->email ?? '-' }} | Telp: {{ $global_pengaturan->telepon ?? '-' }}</p>
        </div>
    </div>

    {{-- JUDUL --}}
    <div class="judul">
        <h1>BUKTI TANDA DITERIMA</h1>
        <p>TAHUN AJARAN {{ $tahun_ajaran ?? date('Y').'/'.(date('Y')+1) }}</p>
    </div>

    <div style="margin-bottom: 10px; font-size: 11pt;">
        Berdasarkan hasil seleksi administrasi dan verifikasi data, Panitia PPDB menyatakan calon siswa berikut:
    </div>

    {{-- A. DATA SISWA --}}
    <div class="section-header">A. DATA CALON SISWA</div>
    <table class="table-data">
        <tr>
            <td class="label">No. Pendaftaran</td><td class="sep">:</td>
            <td class="val">{{ str_pad($siswa->id, 5, '0', STR_PAD_LEFT) }}/PPDB/{{ date('Y') }}</td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td><td class="sep">:</td>
            <td class="val">{{ strtoupper($siswa->nama_lengkap) }}</td>
        </tr>
        <tr>
            <td class="label">NISN / NIK</td><td class="sep">:</td>
            <td class="val">{{ $siswa->nisn }} / {{ $siswa->nik }}</td>
        </tr>
        <tr>
            <td class="label">TTL</td><td class="sep">:</td>
            <td class="val">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td><td class="sep">:</td>
            <td class="val">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td class="label">Asal Sekolah</td><td class="sep">:</td>
            <td class="val">{{ $siswa->sekolahAsal->nama_sekolah ?? '-' }}</td>
        </tr>
    </table>

    {{-- B. DATA ORANG TUA (SIDE BY SIDE) --}}
    <div class="section-header">B. DATA ORANG TUA</div>
    <table class="parent-container">
        <tr>
            {{-- DATA AYAH --}}
            <td class="parent-col" style="padding-right: 15px; border-right: 1px dashed #ccc;">
                <div style="font-weight: bold; margin-bottom: 5px; text-decoration: underline;">1. Data Ayah</div>
                <table class="table-mini">
                    <tr><td class="mini-label">Nama</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ayah->nama_lengkap ?? '-' }}</td></tr>
                    <tr><td class="mini-label">NIK</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ayah->nik ?? '-' }}</td></tr>
                    <tr><td class="mini-label">Pekerjaan</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ayah->pekerjaan ?? '-' }}</td></tr>
                    <tr><td class="mini-label">No. HP</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ayah->no_hp ?? '-' }}</td></tr>
                </table>
            </td>
            {{-- DATA IBU --}}
            <td class="parent-col" style="padding-left: 15px;">
                <div style="font-weight: bold; margin-bottom: 5px; text-decoration: underline;">2. Data Ibu</div>
                <table class="table-mini">
                    <tr><td class="mini-label">Nama</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ibu->nama_lengkap ?? '-' }}</td></tr>
                    <tr><td class="mini-label">NIK</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ibu->nik ?? '-' }}</td></tr>
                    <tr><td class="mini-label">Pekerjaan</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ibu->pekerjaan ?? '-' }}</td></tr>
                    <tr><td class="mini-label">No. HP</td><td class="mini-sep">:</td><td class="mini-val">{{ $siswa->ibu->no_hp ?? '-' }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- ALAMAT ORANG TUA (Full Width di bawah) --}}
    <div style="margin-top: 5px; font-size: 10pt;">
        <strong>Alamat Orang Tua:</strong> <span style="border-bottom: 1px dotted #000;">{{ $siswa->alamat }}, Desa {{ $siswa->desa->nama ?? '-' }}, Kec. {{ $siswa->kecamatan->nama ?? '-' }}, {{ $siswa->kabupaten->nama ?? '-' }}</span>
    </div>

    {{-- STATUS KELULUSAN --}}
    <div class="status-box">
        DINYATAKAN: 
        <span class="status-text">DITERIMA</span>
    </div>

    {{-- Info Daftar Ulang --}}
    <div style="font-size: 10pt; margin-bottom: 20px;">
        <strong>Catatan:</strong> Bukti ini wajib dibawa saat <strong>Daftar Ulang</strong> beserta berkas fisik asli (KK, Akta, SKL) pada jam kerja.
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd-wrapper">
        <div class="ttd-box">
            <div class="foto-kotak">FOTO 3x4</div>
        </div>
        <div class="ttd-box">
            <p style="margin: 0;">{{ $siswa->kabupaten->nama ?? 'Tempat' }}, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p style="margin: 0;">Ketua Panitia PPDB,</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold; margin: 0;">( ........................................... )</p>
        </div>
    </div>

</body>
</html>