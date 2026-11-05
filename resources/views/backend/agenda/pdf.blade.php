<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Agenda Kegiatan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        h2 {
            text-align: center;
            margin: 0 0 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background: #e9ecef;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>KEGIATAN KEPALA KANTOR DAN KEPALA SEKSI<br>
        KSOP KELAS II TANJUNGPINANG&bull;BULAN {{ $bulan }} TAHUN {{ $tahun }}</h2>
    <p style="text-align:center; margin:-6px 0 10px;">
        Periode : {{ \Carbon\Carbon::parse($dari)->translatedFormat('d F Y') }}
        s.d. {{ \Carbon\Carbon::parse($sampai)->translatedFormat('d F Y') }}
        @if (!empty($status))
            &nbsp;|&nbsp; Status : {{ $status }}
        @endif
    </p>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Hari, Tanggal</th>
                <th>Waktu & Tempat</th>
                <th>Agenda Kegiatan</th>
                <th>Disposisi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($agendaKegiatan as $agenda)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($agenda->tgl_mulai)->translatedFormat('l, d F Y') }}<br>
                        s.d. {{ \Carbon\Carbon::parse($agenda->tgl_selesai)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ $agenda->pukul }} WIB<br>{{ $agenda->tempat }}</td>
                    <td>{{ $agenda->uraian }}</td>
                    <td>
                        @forelse ($agenda->pegawai as $pegawai)
                            {{ $pegawai->nama }}@if (!$loop->last)
                                ,
                            @endif @empty -
                        @endforelse
                    </td>
                    <td>{{ $agenda->keterangan ?: '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center">Data agenda tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
