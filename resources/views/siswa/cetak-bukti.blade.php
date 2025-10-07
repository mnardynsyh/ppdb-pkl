<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $siswa->nama_lengkap }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; }
        .container { width: 100%; margin: 0 auto; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0 0; font-size: 14px; }
        .content { margin-top: 30px; }
        .content h2 { font-size: 18px; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td { padding: 8px; vertical-align: top; }
        td.label { width: 30%; font-weight: bold; color: #555; }
        .footer { text-align: center; margin-top: 50px; font-size: 10px; color: #777; }
        .signature { margin-top: 60px; text-align: right; }
        .signature .name { margin-top: 70px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BUKTI KELULUSAN PENDAFTARAN</h1>
            <p>SMP MUHAMMADIYAH 1 SIRAMPOG TAHUN AJARAN {{ date('Y') }}/{{ date('Y')+1 }}</p>
        </div>

        <div class="content">
            <p>Dengan ini menyatakan bahwa siswa dengan data di bawah ini telah dinyatakan <strong>DITERIMA</strong> sebagai calon siswa baru:</p>

            <h2>A. DATA CALON SISWA</h2>
            <table>
                <tr><td class="label">Nama Lengkap</td><td>: {{ $siswa->nama_lengkap }}</td></tr>
                <tr><td class="label">NISN</td><td>: {{ $siswa->nisn }}</td></tr>
                <tr><td class="label">NIK</td><td>: {{ $siswa->nik }}</td></tr>
                <tr><td class="label">Jenis Kelamin</td><td>: {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                <tr><td class="label">Tempat, Tanggal Lahir</td><td>: {{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM Y') }}</td></tr>
                 <tr><td class="label">Asal Sekolah</td><td>: {{ $siswa->asal_sekolah }}</td></tr>
            </table>

            <h2>B. KETERANGAN</h2>
            <p>Harap membawa bukti pendaftaran ini saat melakukan proses daftar ulang di sekolah sesuai dengan jadwal yang telah ditentukan. Informasi mengenai jadwal daftar ulang dapat dilihat di halaman jadwal pada website PPDB.</p>
        </div>

        <div class="signature">
            <p>Sirampog, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
            <p>Kepala Sekolah,</p>
            <p class="name">Nama Kepala Sekolah, S.Pd., M.Pd.</p>
        </div>

        <div class="footer">
            Dokumen ini dicetak melalui Sistem PPDB Online SMP Muhammadiyah 1 Sirampog.
        </div>
    </div>
</body>
</html>
