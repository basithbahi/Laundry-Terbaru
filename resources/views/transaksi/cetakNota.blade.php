<!DOCTYPE html>
<html>
<head>
    <title>Nota Laundry</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            padding: 20px;
            background-color: #f0f5f9;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img{
            margin-bottom: 10px;
            width:70px;
            height:70px;
            float:left;
            margin-right: 10px;
            border-radius:50%;
        }

        .content {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4287f5;
            color: #fff;
        }

        .footer {
            text-align: center;
            color: #777;
        }

        .total {
            float: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
    <img src="{{ public_path('images/logo.jpeg') }}" alt="Logo">
        <h2 style="color: black;">Nota Laundry</h2>
    </div>

    <div class="content">
        @php($no = 1)
        @php($total = 0)
        @foreach($transaksi as $row)
            @if($no == 1)
            <table>
                    <tr>
                        <th>ID Transaksi</th>
                        <th colspan="3">Tanggal Cuci</th>
                    </tr>
                    <tr>
                        <td>{{ $row->id_transaksi }}</td>
                        <td>{{ $row->tanggal_cuci }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Nama Pengguna</th>
                        <th colspan="3">Tanggal Selesai</th>
                    </tr>
                    <tr>
                        <td>{{ $row->user->nama }}</td>
                        <td>{{ $row->tanggal_selesai }}</td>
                        <td colspan="3"></td>
                    </tr>
                </table>
                <br>
                <br>
                <table>
                    <tr>
                        <th>No</th>
                        <th>Jenis Cucian</th>
                        <th>Tipe Laundry</th>
                        <th>Jenis Pencuci</th>
                        <th>Berat Cucian (kg)</th>
                        <th>Harga</th>
                    </tr>
            @endif
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->jenis_cucian->jenis_cucian }}</td>
                <td>{{ $row->tipe_laundry->tipe_laundry }}</td>
                <td>{{ $row->jenis_pencuci->jenis_pencuci }}</td>
                <td>{{ $row->berat_cucian }}</td>
                <td>Rp{{ number_format(($row->berat_cucian * $row->jenis_cucian->harga) + ($row->berat_cucian * $row->tipe_laundry->harga) + ($row->berat_cucian * $row->jenis_pencuci->harga)) }}</td>
            </tr>
            @php($total += ($row->berat_cucian * $row->jenis_cucian->harga) + ($row->berat_cucian * $row->tipe_laundry->harga) + ($row->berat_cucian * $row->jenis_pencuci->harga))
        @endforeach
        </table>
    </div>

    <div class="total">
        <strong>Total Harga: Rp{{ number_format($total) }}</strong>
    </div>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda</p>
    </div>
</body>
</html>
