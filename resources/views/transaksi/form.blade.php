@extends('layouts.app')

@section('title', 'Form Transaksi')

@section('contents')

    @php
        $id_transaksi = 'TR' . mt_rand(1000, 9999);
        $existing_ids = \App\Models\Transaksi::pluck('id_transaksi')->toArray();
        while (in_array($id_transaksi, $existing_ids)) {
            $id_transaksi = 'TR' . mt_rand(1000, 9999);
        }
    @endphp
    <form
        action="{{ isset($transaksi) ? route('transaksi.tambah.update', $transaksi->id) : route('transaksi.tambah.simpan') }}"
        method="post" enctype="multipart/form-data" id="transaksi-form">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            {{ isset($transaksi) ? 'Form Edit Transaksi' : 'Form Tambah Transaksi' }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_transaksi">ID Transaksi</label>
                            <input type="text" class="form-control" id="id_transaksi" name="id_transaksi"
                                value="{{ isset($transaksi) ? $transaksi->id_transaksi : $id_transaksi }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_user">User</label>
                            <select name="id_user" id="id_user" class="custom-select">
                                <option value="" selected disabled hidden>-- Pilih User --</option>
                                @foreach ($user as $row)
                                    <option value="{{ $row->id }}"
                                        {{ isset($transaksi) ? ($transaksi->id_user == $row->id ? 'selected' : '') : '' }}>
                                        {{ $row->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_jenis_cucian">Jenis Cucian</label>
                            <select name="id_jenis_cucian" id="id_jenis_cucian" class="custom-select">
                                <option value="" selected disabled hidden>-- Pilih Jenis Cucian --</option>
                                @foreach ($jenis_cucian as $row)
                                    <option value="{{ $row->id }}"
                                        {{ isset($transaksi) ? ($transaksi->id_jenis_cucian == $row->id ? 'selected' : '') : '' }}>
                                        {{ $row->jenis_cucian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_tipe_laundry">Tipe Laundry</label>
                            <select name="id_tipe_laundry" id="id_tipe_laundry" class="custom-select">
                                <option value="" selected disabled hidden>-- Pilih Tipe Laundry --</option>
                                @foreach ($tipe_laundry as $row)
                                    <option value="{{ $row->id }}"
                                        {{ isset($transaksi) ? ($transaksi->id_tipe_laundry == $row->id ? 'selected' : '') : '' }}>
                                        {{ $row->tipe_laundry }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_jenis_pencuci">Jenis Pencuci</label>
                            <select name="id_jenis_pencuci" id="id_jenis_pencuci" class="custom-select">
                                <option value="" selected disabled hidden>-- Pilih Jenis Pencuci --</option>
                                @foreach ($jenis_pencuci as $row)
                                    <option value="{{ $row->id }}"
                                        {{ isset($transaksi) ? ($transaksi->id_jenis_pencuci == $row->id ? 'selected' : '') : '' }}>
                                        {{ $row->jenis_pencuci }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="berat_cucian">Berat (Kg)</label>
                            <input type="text" class="form-control" id="berat_cucian" name="berat_cucian"
                                value="{{ isset($transaksi) ? $transaksi->berat_cucian : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_cuci">Tanggal Cuci</label>
                            <input type="date" class="form-control" id="tanggal_cuci" name="tanggal_cuci"
                                value="{{ date('Y-m-d') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                            value="{{ isset($transaksi) ? $transaksi->tanggal_selesai : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ isset($transaksi) ? $transaksi->catatan : '' }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        @if (request()->is('transaksi/edit/*'))
                            <!-- Tombol "Pesan Lagi" tidak akan ditampilkan saat halaman dalam mode edit -->
                        @else
                            <button type="submit" class="btn btn-primary" name="pesan_lagi" value="true">Pesan
                                Lagi</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection
