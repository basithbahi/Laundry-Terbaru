@extends('layouts.cekTransaksi')

@section('title', 'Data Transaksi')

@section('contents')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="{{ route('transaksi.search') }}" method="GET">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" name="query" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
            <tr>
              <th>No</th>
              <th>ID Transaksi</th>
              <th>User</th>
              <th>Jenis Cucian</th>
              <th>Tipe Laundry</th>
              <th>Jenis Pencuci</th>
            </tr>
          </thead>
          <tbody>
            @php($no = 1)
            @foreach ($data as $row)
              <tr>
                <th>{{ $no++ }}</th>
                <td>{{ $row->id_transaksi }}</td>
                <td>{{ $row->user->nama }}</td>
                <td>{{ $row->jenis_cucian->jenis_cucian }}</td>
                <td>{{ $row->tipe_laundry->tipe_laundry }}</td>
                <td>{{ $row->jenis_pencuci->jenis_pencuci }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
