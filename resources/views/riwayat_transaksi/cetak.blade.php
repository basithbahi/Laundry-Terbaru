<!DOCTYPE html>
<html>
<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px dotted #999;
        }

        .footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Laundry</h2>
    </div>

    <div class="content">
        <table>
            @php($no = 1)
            @foreach($transaksi as $row)
                <tr>
                    <td colspan="2" style="text-align: center;"><strong>No: {{ $no++ }}</strong></td>
                </tr>
                <tr>
                    <td><strong>ID Transaksi:</strong></td>
                    <td>{{ $row->id_transaksi }}</td>
                </tr>
                <tr>
                    <td><strong>Nama:</strong></td>
                    <td>{{ $row->user->nama }}</td>
                </tr>
                <tr>
                    <td><strong>Jenis Cucian:</strong></td>
                    <td>{{ $row->jenis_cucian->jenis_cucian }}</td>
                </tr>
                <tr>
                    <td><strong>Tipe Laundry:</strong></td>
                    <td>{{ $row->tipe_laundry->tipe_laundry }}</td>
                </tr>
                <tr>
                    <td><strong>Jenis Pencuci:</strong></td>
                    <td>{{ $row->jenis_pencuci->jenis_pencuci }}</td>
                </tr>
                <tr>
                    <td><strong>Berat Cucian:</strong></td>
                    <td>{{ $row->berat_cucian }} kg</td>
                </tr>
                <tr>
                    <td><strong>Harga:</strong></td>
                    <td>Rp{{ number_format(($row->berat_cucian * $row->jenis_cucian->harga) + ($row->berat_cucian * $row->tipe_laundry->harga) + ($row->berat_cucian * $row->jenis_pencuci->harga)) }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top: 1px dotted #999;"></td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 10px;"></td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda</p>
    </div>
</body>
</html>
