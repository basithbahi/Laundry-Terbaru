<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', ['user' => $user]);
    }

    public function index()
    {
        $user = User::get()->where('level', 'User');

        return view('user/index', ['user' => $user]);
    }

    public function tambah()
    {
        return view('user.form');
    }

    public function simpan(Request $request)
    {
        $image_name = '';
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'ttl' => $request->ttl,
            'jk' => $request->jk,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto_profil' => $image_name,
            'level' => 'User'
        ]);
        return redirect()->route('user');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('user.form', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $image_name = '';
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        User::find($id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'ttl' => $request->ttl,
            'jk' => $request->jk,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'password' => ($request->password),
            'foto_profil' => $image_name,
        ]);

        return redirect()->route('user');
    }

    public function editProfile(Request $request)
    {
        $user = $request->user();

        return view('pilihProfile', ['user' => $user]);
    }

    public function simpanProfile(Request $request)
    {
        $image_name = '';
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'ttl' => $request->ttl,
            'jk' => $request->jk,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'password' => ($request->password),
            'foto_profil' => $image_name,
            'level' => 'User'
        ]);

        return redirect()->route('profile');
    }

    public function updateProfile(Request $request)
    {
        $image_name = '';
        if ($request->file('image')) {
            $image_name = $request->file('image')->store('images', 'public');
        }

        $user = $request->user();
        $user->nik = $request->input('nik');
        $user->nama = $request->input('nama');
        $user->alamat = $request->input('alamat');
        $user->ttl = $request->input('ttl');
        $user->jk = $request->input('jk');
        $user->nomor_telepon = $request->input('nomor_telepon');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->foto_profil = $image_name;
        $user->save();

        return redirect()->route('profile');
    }

    public function hapus($id)
    {
        // try {
        //     $user = User::find($id);

        //     if ($user->jadwal()->exists()) {
        //         throw new GlobalException("Tidak dapat menghapus user yang masih memiliki jadwal terkait.");
        //     }

        //     $user->delete();

        //     return redirect()->route('user')->with('success', 'Data user berhasil dihapus');
        // } catch (FFIException $e) {
        //     return redirect()->back()->withErrors([$e->getMessage()]);

        // }
        User::find($id)->delete();

        return redirect()->route('user');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $user = User::query()
                ->where('nik', 'like', "%$query%")
                ->orWhere('nama', 'like', "%$query%")
                ->orWhere('alamat', 'like', "%$query%")
                ->orderBy('jk', 'asc')
                ->paginate(10);
        } else {
            $user = User::get();
        }

        return view('user.index', ['user' => $user, 'query' => $query]);
    }
}