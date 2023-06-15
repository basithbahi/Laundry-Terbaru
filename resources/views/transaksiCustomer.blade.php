@extends('layouts.customer')

@section('title', 'Form Transaksi')

@section('contents')

    @php
        use App\Models\User;
        use App\Models\JenisCucian;
        use App\Models\TipeLaundry;
        use App\Models\JenisPencuci;

        $user = User::get();
        $jenis_cucian = JenisCucian::get();
        $tipe_laundry = TipeLaundry::get();
        $jenis_pencuci = JenisPencuci::get();

        $id_transaksi = 'TR' . mt_rand(1000, 9999);
        $existing_ids = \App\Models\Transaksi::pluck('id_transaksi')->toArray();
        while (in_array($id_transaksi, $existing_ids)) {
            $id_transaksi = 'TR' . mt_rand(1000, 9999);
        }
    @endphp

    <form action="{{ route('transaksi.tambahCustomer.simpanCustomer') }}" method="post">
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
                            <input type="text" class="form-control" id="id_user" name="id_user"
                                value="{{ auth()->user()->id }}" hidden>
                            <input type="text" class="form-control" id="id_jadwal" value="{{ auth()->user()->nama }}"
                                readonly>
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
                            <label for="catatan">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ isset($transaksi) ? $transaksi->catatan : '' }}</textarea>
                        </div>

                        <p><strong>Petunjuk Pembayaran Offline Laundry Qyalin</strong></p>
                        <ol>
                            <li>Silahkan Anda Datang Langsung Ke Gerai <b>Laundry Qyalin</b></li>
                            <li>Alamat <b>Laundry Qyalin</b> Ada Pada Bio IG Kami <b>Silahkan Akses Link Tersebut</b></li>
                            <li><b>Berikan</b> Laundry Yang Anda Pesan Pada <b>Ibu Siti Badriyah</b> Untuk Pengambilan Nota
                                Yang Akan Gunakan Untuk Mengambil Pakaian Anda</li>
                            <li>Kembali Pada <b>Tanggal Selesai</b>,
                                Untuk Mengambil Serta Membayar Laundry Anda Atas Nama <b>
                                    {{ auth()->user()->nama }}. </b></li>
                            <li>Selesai. <b>Kami Menyambut Anda Dengan Hangat</b> Terima Kasih</li>
                        </ol>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="submit" class="btn btn-primary" name="pesan_lagi" value="true">Pesan Lagi</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

@endsection
