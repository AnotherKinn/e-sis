<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Izin</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .kop-surat {
            width: 100%;
            border-bottom: 3px solid black;
            display: table;
        }

        .kop-surat .logo {
            width: 15%;
            text-align: left;
            display: table-cell;
            vertical-align: top;
        }

        .kop-surat .text {
            width: 85%;
            text-align: center;
            display: table-cell;
            vertical-align: top;
        }

        .kop-surat h2 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
        }

        .kop-surat p {
            margin: 1px 0;
            font-size: 10pt;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }

        .tanda-tangan{
            width: 100%;
            margin-top: 50px;
            text-align: center;
            display: table;
        }

        .tanda-tangan td {
            width: 50%;
            padding: 10px;
            display: table-cell;
        }

        .tanda-tangan .jarak{
            height: 80px;
        }

        /* .footer {
            margin-top: 40px;
            text-align: right;
        } */

    </style>
</head>

<body>
    <div class="kop-surat">
        <div class="logo">
            <img src="{{asset('storage/asset/skiel-logo.png')}}" width="80" style="margin-top: 5px;">
        </div>
        <div class="text">
            <h2 style='font-size: 18px;'>SEKOLAH MENENGAH KEJURUAN NEGERI 1 GUNUNG PUTRI</h2>
            <p>Jln. Barokah No.06 Desa Wanaherang, Kec. Gunung Putri 16965</p>
            <p>Telp/Fax. (021)8673310 | Email: smkn1gnp@... | Web: www.smkn1gnputri.sch.id</p>
        </div>
    </div>


    <div class="header">
        <h2>Surat Izin Siswa</h2>
        <p>Tanggal: {{ $izin->tanggal }}</p>
    </div>

    {{-- <div class="content">
        <h2>Surat Izin</h2>
        <p><strong>Nama Siswa:</strong> {{ $izin->user->nama }}</p>
        <p><strong>Kelas:</strong> {{ $izin->walikelas->kelas->nama_kelas ?? '-' }}</p>
        <p><strong>Wali Kelas:</strong> {{ $walikelas->nama_walikelas ?? '-' }}</p>
        <p><strong>Petugas:</strong> {{ $petugas->nama ?? '-' }}</p>
        <p><strong>Jenis Izin:</strong> {{ ucfirst($izin->jenis_izin) }}</p>
        <p><strong>Keterangan:</strong> {{ $izin->keterangan }}</p>
        <p><strong>Tanggal:</strong> {{ $izin->tanggal }}</p>
    </div> --}}

    <table class="content">
        <tr>
            <td>Nama Siswa</td>
            <td>: {{ $izin->user->nama }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: {{ $izin->walikelas->kelas->nama_kelas ?? '-' }}</td>
        </tr>
        <tr>
            <td>Wali Kelas</td>
            <td>: {{ $walikelas->nama_walikelas ?? '-' }}</td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td>: {{ $petugas->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jenis Izin</td>
            <td>: {{ ucfirst($izin->jenis_izin) }}</td>
        </tr>
        <tr>
            <td>Tanggal Izin</td>
            <td>: {{ $izin->tanggal }}</td>
        </tr>
        <tr>
            <td>Jam Keluar</td>
            <td>: {{ date('H:i', strtotime($izin->jam_keluar)) }} WIB</td>
        </tr>
    </table>

    <div class="penutup">
        <p>Dengan ini menerangkan bahwa siswa di atas mengajukan izin '{{ ucfirst($izin->jenis_izin) }}' dengan keterangan:</p>
        <p style="margin-top: 10px; font-style: italic; border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9;">
            "{{ $izin->keterangan }}"
        </p>
        <p style="margin-top: 15px;">
            Surat izin ini dibuat untuk digunakan sebagaimana mestinya. Siswa diizinkan meninggalkan lingkungan sekolah terhitung sejak jam yang tertera.
        </p>
    </div>

    {{-- <div class="footer">
        <p>Mengetahui,</p>
        <p>___________________</p>
    </div> --}}

    <table class="tanda-tangan">
        <tr>
            <td style="text-align: left;">
                Mengetahui,<br>
                Walikelas <br>
                <div class="jarak"></div>
                ___________________
                <p>{{$walikelas->nama_walikelas}}</p>
            </td>

            <td style="text-align: right;">
                <span style="font-size: 10pt;">Gunung Putri, {{ $izin->tanggal }}</span><br>
                Disetujui oleh, <br>
                <div class="jarak"></div>
                ___________________
                <p>{{ $petugas->nama ?? '___________________' }}</p>
            </td>
        </tr>


    </table>
</body>

</html>
