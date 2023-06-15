@extends('layouts.app')

@section('title', 'Data Transaksi')

@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('riwayat_transaksi.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" name="query"
                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        @if (auth()->user()->level == 'Admin')
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>User</th>
                                <th>Jenis Cucian</th>
                                <th>Tipe Laundry</th>
                                <th>Jenis Pencuci</th>
                                <th>Berat Cucian (Kg)</th>
                                <th>Total Harga</th>
                                <th>Tanggal Cuci</th>
                                <th>Tanggal Selesai</th>
                                <th>Catatan</th>
                                <th>Status Pencucian</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($data as $row)
                        @if ($row->status_pencucian === 'SELESAI')
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $row->id_transaksi }}</td>
                                <td>{{ $row->user->nama }}</td>
                                <td>{{ $row->jenis_cucian->jenis_cucian }}</td>
                                <td>{{ $row->tipe_laundry->tipe_laundry }}</td>
                                <td>{{ $row->jenis_pencuci->jenis_pencuci }}</td>
                                <td>{{ $row->berat_cucian }}</td>
                                <td>Rp{{ number_format($row->berat_cucian * $row->jenis_cucian->harga + $row->berat_cucian * $row->tipe_laundry->harga + $row->berat_cucian * $row->jenis_pencuci->harga) }}
                                </td>
                                <td>{{ $row->tanggal_cuci }}</td>
                                <td>{{ $row->tanggal_selesai }}</td>
                                <td>{{ $row->catatan }}</td>
                                <td>{{ $row->status_pencucian }}</td>
                            </tr>
                            @endif
                        @endforeach
                        <a href="{{ route('transaksi.cetak') }}" class="btn btn-primary"
                            target="_blank"><i class="fas fa-print "></i>&nbsp;&nbsp;&nbsp;&nbsp;Cetak</a>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
