@extends('layouts.app')

@section('title', 'Data Transaksi')
@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('transaksi.search') }}" method="GET">
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
            @if (auth()->user()->level == 'Admin')
                <a href="{{ route('transaksi.tambah') }}" class="btn btn-success mb-3"><i
                        class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Transaksi</a>
            @endif
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
                                <th>Status Pencucian</th>
                                <th>Aksi</th>
                        @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($data as $row)
                        @if ($row->status_pencucian === 'BELUM SELESAI')
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
                                <td>{{ $row->status_pencucian }}</td>
                                @if (auth()->user()->level == 'Admin')
                                    <td>
                                        <a href="{{ route('transaksi.edit', $row->id) }}" class="btn btn-warning"><i
                                                class="fas fa-pen"></i></a>
                                        <a href="{{ route('transaksi.hapus', $row->id) }}" class="btn btn-danger"><i
                                                class="fas fa-trash-alt "></i></a>

                                        @if ($loop->first || $row->id_transaksi != $data[$loop->index - 1]->id_transaksi)
                                            <a href="{{ route('transaksi.cetakNota', $row->id_transaksi) }}"
                                                class="btn btn-primary" target="_blank"><i class="fas fa-print "></i></a>
                                        @endif
                                        <br>
                                        <a href="{{ route('transaksi.selesai', $row->id) }}">Pencucian Selesai</i></a>

                                    </td>
                                @endif
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
