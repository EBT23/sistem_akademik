<!DOCTYPE html>
<html>

<head>
    <title>Laporan Nilai Siswa</title>
    <style>
        /* Gaya CSS untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; line-height:6px;">Data Nilai Siswa</h1>
    <h3 style="text-align: center; line-height:6px;">Baken Mirae Hakwon</h3>
    <p style="text-align: center; line-height:6px;">Gomboroli, Sawangan, Kec. Kebasen, Kab. Banyumas, Jawa Tengah</p>
    <table style="text-align: center">
        <tr>
            <th>No</th>
            <th>No Induk Siswa</th>
            <th>Nama Siswa</th>
            <th>Materi</th>
            <th>Nilai</th>
        </tr>
        @foreach ($nilai_lpk as $no => $item)
        <tr>
            <td>{{ $no+1 }}</td>
            <td>{{ $item->nis }}</td>
            <td>{{ $item->full_name }}</td>
            <td>{{ $item->nama_materi }}</td>
            <td>{{ $item->nilai }}</td>
        </tr>
        @endforeach
        <!-- Tambahkan baris data siswa lainnya di sini -->
    </table>
    <script>
        window.print();
    </script>
</body>

</html>