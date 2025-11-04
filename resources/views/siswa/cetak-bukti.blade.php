<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $siswa->nama_lengkap }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
            background: #fff;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        h2 {
            font-size: 16px;
            border-bottom: 1px solid #aaa;
            padding-bottom: 5px;
            margin-top: 30px;
            color: #222;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        td {
            padding: 6px 8px;
            vertical-align: top;
        }
        td.label {
            width: 35%;
            font-weight: bold;
            color: #555;
        }
        .section {
            margin-bottom: 25px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature .name {
            margin-top: 70px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    {{-- Header --}}
    <div class="header">
        <h1>BUKTI KELULUSAN PENDAFTARAN</h1>
        <p>SMP MUHAMMADIYAH 1 SIRAMPOG<br>
           Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
    </div>

    {{-- Keterangan awal --}}
    <p>Dengan ini menyatakan bahwa siswa dengan data berikut telah <strong>DITERIMA</strong> sebagai calon siswa baru di SMP Muhammadiyah 1 Sirampog:</p>

    {{-- A. Data Calon Siswa --}}
    <div class="section">
        <h2>A. DATA CALON SISWA</h2>
        <table>
            <tr><td class="label">Nama Lengkap</td><td>: {{ $siswa->nama_lengkap }}</td></tr>
            <tr><td class="label">NISN</td><td>: {{ $siswa->nisn }}</td></tr>
            <tr><td class="label">NIK</td><td>: {{ $siswa->nik }}</td></tr>
            <tr><td class="label">Jenis Kelamin</td><td>: {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
            <tr><td class="label">Tempat, Tanggal Lahir</td><td>: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') }}</td></tr>
            <tr><td class="label">Agama</td><td>: {{ $siswa->agama }}</td></tr>
            <tr><td class="label">Alamat Lengkap</td><td>: {{ $siswa->alamat }}, Desa {{ $siswa->desa->nama ?? '-' }}, Kecamatan {{ $siswa->kecamatan->nama ?? '-' }}, Kabupaten {{ $siswa->kabupaten->nama ?? '-' }}</td></tr>
            <tr><td class="label">Asal Sekolah</td><td>: {{ $siswa->asal_sekolah }}</td></tr>
            <tr><td class="label">Tahun Lulus</td><td>: {{ $siswa->tahun_lulus }}</td></tr>
        </table>
    </div>

    {{-- B. Data Orang Tua --}}
    @if($siswa->orangTuaWali)
        <div class="section">
            <h2>B. DATA ORANG TUA</h2>

            {{-- Ayah --}}
            <h4 style="margin: 10px 0 5px 0;">1. Data Ayah</h4>
            <table>
                <tr><td class="label">Nama Lengkap</td><td>: {{ $siswa->orangTuaWali->nama_ayah }}</td></tr>
                <tr><td class="label">NIK</td><td>: {{ $siswa->orangTuaWali->nik_ayah }}</td></tr>
                <tr><td class="label">Tempat, Tanggal Lahir</td><td>: {{ $siswa->orangTuaWali->tempat_lahir_ayah }}, {{ $siswa->orangTuaWali->tanggal_lahir_ayah ? \Carbon\Carbon::parse($siswa->orangTuaWali->tanggal_lahir_ayah)->isoFormat('D MMMM Y') : '-' }}</td></tr>
                <tr><td class="label">Pendidikan</td><td>: {{ $siswa->orangTuaWali->pendidikan_ayah }}</td></tr>
                <tr><td class="label">Pekerjaan</td><td>: {{ $siswa->orangTuaWali->pekerjaanAyah->pekerjaan ?? '-' }}</td></tr>
                <tr><td class="label">Penghasilan</td><td>: {{ $siswa->orangTuaWali->penghasilan_ayah }}</td></tr>
                <tr><td class="label">Agama</td><td>: {{ $siswa->orangTuaWali->agama_ayah }}</td></tr>
                <tr><td class="label">Alamat</td><td>: {{ $siswa->orangTuaWali->alamat_ayah }}</td></tr>
            </table>

            {{-- Ibu --}}
            <h4 style="margin: 15px 0 5px 0;">2. Data Ibu</h4>
            <table>
                <tr><td class="label">Nama Lengkap</td><td>: {{ $siswa->orangTuaWali->nama_ibu }}</td></tr>
                <tr><td class="label">NIK</td><td>: {{ $siswa->orangTuaWali->nik_ibu }}</td></tr>
                <tr><td class="label">Tempat, Tanggal Lahir</td><td>: {{ $siswa->orangTuaWali->tempat_lahir_ibu }}, {{ $siswa->orangTuaWali->tanggal_lahir_ibu ? \Carbon\Carbon::parse($siswa->orangTuaWali->tanggal_lahir_ibu)->isoFormat('D MMMM Y') : '-' }}</td></tr>
                <tr><td class="label">Pendidikan</td><td>: {{ $siswa->orangTuaWali->pendidikan_ibu }}</td></tr>
                <tr><td class="label">Pekerjaan</td><td>: {{ $siswa->orangTuaWali->pekerjaanIbu->pekerjaan ?? '-' }}</td></tr>
                <tr><td class="label">Penghasilan</td><td>: {{ $siswa->orangTuaWali->penghasilan_ibu }}</td></tr>
                <tr><td class="label">Agama</td><td>: {{ $siswa->orangTuaWali->agama_ibu }}</td></tr>
                <tr><td class="label">Alamat</td><td>: {{ $siswa->orangTuaWali->alamat_ibu }}</td></tr>
            </table>

            {{-- Wali (Opsional) --}}
            @if($siswa->orangTuaWali->nama_wali)
                <h4 style="margin: 15px 0 5px 0;">3. Data Wali</h4>
                <table>
                    <tr><td class="label">Nama Lengkap</td><td>: {{ $siswa->orangTuaWali->nama_wali }}</td></tr>
                    <tr><td class="label">NIK</td><td>: {{ $siswa->orangTuaWali->nik_wali }}</td></tr>
                    <tr><td class="label">Tempat, Tanggal Lahir</td><td>: {{ $siswa->orangTuaWali->tempat_lahir_wali }}, {{ $siswa->orangTuaWali->tanggal_lahir_wali ? \Carbon\Carbon::parse($siswa->orangTuaWali->tanggal_lahir_wali)->isoFormat('D MMMM Y') : '-' }}</td></tr>
                    <tr><td class="label">Pendidikan</td><td>: {{ $siswa->orangTuaWali->pendidikan_wali }}</td></tr>
                    <tr><td class="label">Pekerjaan</td><td>: {{ $siswa->orangTuaWali->pekerjaanWali->pekerjaan ?? '-' }}</td></tr>
                    <tr><td class="label">Penghasilan</td><td>: {{ $siswa->orangTuaWali->penghasilan_wali }}</td></tr>
                    <tr><td class="label">Agama</td><td>: {{ $siswa->orangTuaWali->agama_wali }}</td></tr>
                    <tr><td class="label">Alamat</td><td>: {{ $siswa->orangTuaWali->alamat_wali }}</td></tr>
                </table>
            @endif
        </div>
    @endif

    {{-- C. Keterangan Tambahan --}}
    <div class="section">
        <h2>C. KETERANGAN</h2>
        <p>Harap membawa bukti pendaftaran ini saat melakukan proses daftar ulang di sekolah sesuai dengan jadwal yang telah ditentukan. 
           Informasi lebih lanjut mengenai jadwal daftar ulang dapat dilihat di halaman jadwal pada website PPDB Online.</p>
    </div>

    {{-- Tanda tangan --}}
    <div class="signature">
        <p>Sirampog, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p>Kepala Sekolah,</p>
        <p class="name">Nama Kepala Sekolah, S.Pd., M.Pd.</p>
    </div>

    {{-- Footer --}}
    <div class="footer">
        Dokumen ini dicetak melalui Sistem PPDB Online SMP Muhammadiyah 1 Sirampog<br>
        {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y, HH:mm') }}
    </div>
</div>
</body>
</html>
