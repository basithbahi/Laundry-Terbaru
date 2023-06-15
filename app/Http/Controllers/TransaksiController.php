<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\JenisCucian;
use App\Models\TipeLaundry;
use App\Models\JenisPencuci;
use App\Models\RiwayatTransaksi;
use App\Http\Controllers\Exception;
use Exception as GlobalException;
use FFI\Exception as FFIException;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::get();

        return view('transaksi.index', ['data' => $transaksi]);
    }

    public function cekTransaksi()
    {
        $transaksi = Transaksi::orderBy('status_pencucian')->get();

        return view('cekTransaksi', ['data' => $transaksi]);
    }

    public function tambah()
    {
        $user = User::get();
        $jenis_cucian = JenisCucian::get();
        $tipe_laundry = TipeLaundry::get();
        $jenis_pencuci = JenisPencuci::get();

        $id_transaksi = session('id_transaksi');
        $id_user = session('id_user');

        $transaksi = null;
        if ($id_transaksi && $id_user) {
            $transaksi = new Transaksi();
            $transaksi->id_transaksi = $id_transaksi;
            $transaksi->id_user = $id_user;
        }

        return view('transaksi.form', [
            'user' => $user,
            'jenis_cucian' => $jenis_cucian,
            'tipe_laundry' => $tipe_laundry,
            'jenis_pencuci' => $jenis_pencuci,
            'transaksi' => $transaksi
        ]);
    }



    public function simpan(Request $request)
    {
        $data = [
            'id_transaksi' => $request->id_transaksi,
            'id_user' => $request->id_user,
            'id_jenis_cucian' => $request->id_jenis_cucian,
            'id_tipe_laundry' => $request->id_tipe_laundry,
            'id_jenis_pencuci' => $request->id_jenis_pencuci,
            'berat_cucian' => $request->berat_cucian,
            'tanggal_cuci' => $request->tanggal_cuci,
            'tanggal_selesai' => $request->tanggal_selesai,
            'catatan' => $request->catatan,
        ];

        $transaksi = Transaksi::create($data);

        if ($request->has('pesan_lagi') && $request->pesan_lagi === 'true') {
            return redirect()->route('transaksi.tambah')->with('id_transaksi', $request->id_transaksi)->with('id_user', $request->id_user);
        }

        return redirect()->route('transaksi');
    }

    public function tambahCustomer()
    {
        $user = User::get();
        $jenis_cucian = JenisCucian::get();
        $tipe_laundry = TipeLaundry::get();
        $jenis_pencuci = JenisPencuci::get();

        $id_transaksi = session('id_transaksi');
        $id_user = session('id_user');

        $transaksi = null;
        if ($id_transaksi && $id_user) {
            $transaksi = new Transaksi();
            $transaksi->id_transaksi = $id_transaksi;
            $transaksi->id_user = $id_user;
        }

        return view('transaksiCustomer', [
            'user' => $user,
            'jenis_cucian' => $jenis_cucian,
            'tipe_laundry' => $tipe_laundry,
            'jenis_pencuci' => $jenis_pencuci,
            'transaksi' => $transaksi
        ]);
    }



    public function simpanCustomer(Request $request)
    {
        $data = [
            'id_transaksi' => $request->id_transaksi,
            'id_user' => $request->id_user,
            'id_jenis_cucian' => $request->id_jenis_cucian,
            'id_tipe_laundry' => $request->id_tipe_laundry,
            'id_jenis_pencuci' => $request->id_jenis_pencuci,
            'berat_cucian' => $request->berat_cucian,
            'tanggal_cuci' => $request->tanggal_cuci,
            'tanggal_selesai' => $request->tanggal_selesai,
            'catatan' => $request->catatan,
        ];

        $transaksi = Transaksi::create($data);

        if ($request->has('pesan_lagi') && $request->pesan_lagi === 'true') {
            return redirect()->route('transaksi.tambahCustomer')->with('id_transaksi', $request->id_transaksi)->with('id_user', $request->id_user);
        }

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $user = User::get();
        $jenis_cucian = JenisCucian::get();
        $tipe_laundry = TipeLaundry::get();
        $jenis_pencuci = JenisPencuci::get();

        return view('transaksi.form', ['transaksi' => $transaksi, 'user' => $user, 'jenis_cucian'
        => $jenis_cucian, 'tipe_laundry' => $tipe_laundry, 'jenis_pencuci' => $jenis_pencuci]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'id_transaksi' => $request->id_transaksi,
            'id_user' => $request->id_user,
            'id_jenis_cucian' => $request->id_jenis_cucian,
            'id_tipe_laundry' => $request->id_tipe_laundry,
            'id_jenis_pencuci' => $request->id_jenis_pencuci,
            'berat_cucian' => $request->berat_cucian,
            'tanggal_cuci' => $request->tanggal_cuci,
            'tanggal_selesai' => $request->tanggal_selesai,
            'catatan' => $request->catatan,
        ];

        Transaksi::find($id)->update($data);

        return redirect()->route('transaksi');
    }

    public function hapus($id)
    {
        Transaksi::find($id)->delete();

        return redirect()->route('transaksi');
    }

    public function bayar($id)
    {
        $transaksi = Transaksi::find($id);

        return view('transaksi.bayar', ['transaksi' => $transaksi]);
    }

    public function upload(Request $request)
    {
        $data = [
            'id_riwayat_transaksi' => $request->id_riwayat_transaksi,
            'id_transaksi' => $request->id_transaksi,
        ];

        RiwayatTransaksi::create($data);

        return redirect()->route('riwayat_transaksi');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $data = Transaksi::with('user', 'jenis_cucian', 'tipe_laundry', 'jenis_pencuci')
                ->whereHas('user', function ($q) use ($query) {
                    $q->where('nama', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('jenis_cucian', function ($q) use ($query) {
                    $q->where('jenis_cucian', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('tipe_laundry', function ($q) use ($query) {
                    $q->where('tipe_laundry', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('jenis_pencuci', function ($q) use ($query) {
                    $q->where('jenis_pencuci', 'LIKE', '%' . $query . '%');
                })
                ->get();
        } else {
            $data = Transaksi::get();
        }

        return view('transaksi.index', ['data' => $data]);
    }

    public function searchRiwayat(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $data = Transaksi::with('user', 'jenis_cucian', 'tipe_laundry', 'jenis_pencuci')
                ->whereHas('user', function ($q) use ($query) {
                    $q->where('nama', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('jenis_cucian', function ($q) use ($query) {
                    $q->where('jenis_cucian', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('tipe_laundry', function ($q) use ($query) {
                    $q->where('tipe_laundry', 'LIKE', '%' . $query . '%');
                })
                ->orWhereHas('jenis_pencuci', function ($q) use ($query) {
                    $q->where('jenis_pencuci', 'LIKE', '%' . $query . '%');
                })
                ->get();
        } else {
            $data = Transaksi::get();
        }

        return view('riwayat_transaksi.index', ['data' => $data]);
    }

    public function cetak()
    {
        $transaksi = Transaksi::where('status_pencucian', 'SELESAI')->get();
        $pdf = PDF::loadView('transaksi.cetak', ['transaksi' => $transaksi]);
        return $pdf->stream();
    }

    public function cetakNota($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->get();
        $pdf = PDF::loadview('transaksi.cetakNota', compact('transaksi'));
        return $pdf->stream();
    }

    public function selesai($id)
    {
        $data = [
            'status_pencucian' => 'SELESAI',
        ];

        Transaksi::find($id)->update($data);

        return redirect()->route('transaksi');
    }
}