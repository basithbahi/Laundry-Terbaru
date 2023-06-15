[19.39, 15/6/2023] tarista 1h poltek: <!DOCTYPE html>
<html>
<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            color: #333;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #b3d7ff;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #e5e5e5;
        }

        h4 {
            margin-bottom: 20px;
            text-align: center;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            width: 100px;
            border-radius: 50%;
        }

        .center {
            text-align: center;
        }

        .date-cell {
            white-space: nowrap;
        }

        .date-cell span {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            background-color: #f2f2f2;
            font-size: 8pt;
        }

        .highlight {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{ public_path('images/logo.jpeg') }}" alt="Logo">
    </div>
    <h4>Laporan Laundry</h4>
    <table>
        <thead>
            <tr>
                <th class="center">No</th>
                <th>ID Transaksi</th>
                <th>Nama</th>
                <th>Jenis Cucian</th>
                <th>Tipe Laundry</th>
                <th>Jenis Pencuci</th>
                <th>Berat Cucian</th>
                <th>Harga</th>
                <th class="date-cell">Tanggal Cuci</th>
                <th class="date-cell">Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($transaksi as $row)
            <tr>
                <td class="center">{{ $no++ }}</td>
                <td>{{ $row->id_transaksi }}</td>
                <td>{{ $row->user->nama }}</td>
                <td>{{ $row->jenis_cucian->jenis_cucian }}</td>
                <td>{{ $row->tipe_laundry->tipe_laundry }}</td>
                <td>{{ $row->jenis_pencuci->jenis_pencuci }}</td>
                <td>{{ $row->berat_cucian }}</td>
                <td>Rp{{ number_format(($row->berat_cucian * $row->jenis_cucian->harga) + ($row->berat_cucian * $row->tipe_laundry->harga) + ($row->berat_cucian * $row->jenis_pencuci->harga)) }}</td>
                <td class="date-cell"><span>{{ $row->tanggal_cuci }}</span></td>
                <td class="date-cell"><span>{{ $row->tanggal_selesai }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
[20.22, 15/6/2023] tarista 1h poltek: public function cetak($id_transaksi)
    {
        $transaksi =  Transaksi::all();
        $pdf = PDF::loadview('transaksi.cetak', ['transaksi' => $transaksi]);
        return $pdf->stream();
    }
[20.23, 15/6/2023] tarista 1h poltek: <!DOCTYPE html>
<html>
<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            color: #333;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #b3d7ff;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #e5e5e5;
        }

        h4 {
            margin-bottom: 20px;
            text-align: center;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            width: 100px;
            border-radius: 50%;
        }

        .center {
            text-align: center;
        }

        .date-cell {
            white-space: nowrap;
        }

        .date-cell span {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            background-color: #f2f2f2;
            font-size: 8pt;
        }

        .highlight {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <img src="{{ public_path('images/logo.jpeg') }}" alt="Logo">
    </div>
    <h4>Laporan Laundry</h4>
    <table>
        <thead>
            <tr>
                <th class="center">No</th>
                <th>ID Transaksi</th>
                <th>Nama</th>
                <th>Jenis Cucian</th>
                <th>Tipe Laundry</th>
                <th>Jenis Pencuci</th>
                <th>Berat Cucian</th>
                <th>Harga</th>
                <th class="date-cell">Tanggal Cuci</th>
                <th class="date-cell">Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @php($no = 1)
            @foreach($transaksi as $row)
            <tr>
                <td class="center">{{ $no++ }}</td>
                <td>{{ $row->id_transaksi }}</td>
                <td>{{ $row->user->nama }}</td>
                <td>{{ $row->jenis_cucian->jenis_cucian }}</td>
                <td>{{ $row->tipe_laundry->tipe_laundry }}</td>
                <td>{{ $row->jenis_pencuci->jenis_pencuci }}</td>
                <td>{{ $row->berat_cucian }}</td>
                <td>Rp{{ number_format(($row->berat_cucian * $row->jenis_cucian->harga) + ($row->berat_cucian * $row->tipe_laundry->harga) + ($row->berat_cucian * $row->jenis_pencuci->harga)) }}</td>
                <td class="date-cell"><span>{{ $row->tanggal_cuci }}</span></td>
                <td class="date-cell"><span>{{ $row->tanggal_selesai }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
