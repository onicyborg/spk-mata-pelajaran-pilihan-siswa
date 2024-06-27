<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaDataSiswaController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'Siswa')->get();
        $mapel = MataPelajaran::all();

        return view('admin.kelola-siswa', ['data' => $data, 'mapel' => $mapel]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'gender' => 'required|in:Pria,Wanita',
            'jurusan' => 'required',
            'kelas' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        $data = new User();
        $biodata = new Biodata();

        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = Hash::make($request->username);
        $data->role = 'Siswa';
        $data->save();

        $biodata->gender = $request->gender;
        $biodata->jurusan = $request->jurusan;
        $biodata->kelas = $request->kelas;
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tanggal_lahir = $request->tanggal_lahir;
        if ($request->email != '') {
            $biodata->email = $request->email;
        }
        if ($request->no_hp != '') {
            $biodata->no_hp = $request->no_hp;
        }
        if ($request->mapel_fav != '') {
            $biodata->mapel_fav = $request->mapel_fav;
        }
        $biodata->user_id = $data->id;

        $biodata->save();

        return redirect('/admin/kelola-siswa')->with('success', 'Berhasil Menambah Data Siswa Baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'gender' => 'required|in:Pria,Wanita',
            'jurusan' => 'required',
            'kelas' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ]);

        // Mencari data user berdasarkan id
        $data = User::findOrFail($id);
        // Mencari data biodata terkait user
        $biodata = $data->biodata;

        // Update data user
        $data->name = $request->name;
        $data->username = $request->username;
        $data->save();

        // Update data biodata
        $biodata->gender = $request->gender;
        $biodata->jurusan = $request->jurusan;
        $biodata->kelas = $request->kelas;
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tanggal_lahir = $request->tanggal_lahir;

        if ($request->email != '') {
            $biodata->email = $request->email;
        }
        if ($request->no_hp != '') {
            $biodata->no_hp = $request->no_hp;
        }
        if ($request->mapel_fav != '') {
            $biodata->mapel_fav = $request->mapel_fav;
        }

        $biodata->save();

        return redirect('/admin/kelola-siswa')->with('success', 'Berhasil Memperbarui Data Siswa');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $biodata = $data->biodata;

        $biodata->delete();
        $data->delete();

        return redirect('/admin/kelola-siswa')->with('success', 'Berhasil Menghapus Data Siswa');
    }

    public function reset_password($id)
    {
        $data = User::find($id);

        $data->password = Hash::make($data->username);
        $data->save();

        return redirect('/admin/kelola-siswa')->with('success', 'Berhasil Reset Password Siswa');
    }
}
