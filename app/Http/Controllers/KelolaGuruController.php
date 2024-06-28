<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaGuruController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'Guru')->get();

        return view('admin.kelola-guru', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'gender' => 'required|in:Pria,Wanita',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ], [
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'NIP harus diisi.',
            'username.unique' => 'NIP sudah terdaftar.',
            'gender.required' => 'Jenis kelamin harus dipilih.',
            'gender.in' => 'Jenis kelamin harus Pria atau Wanita.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
        ]);


        $data = new User();
        $biodata = new Biodata();

        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = Hash::make($request->username);
        $data->role = 'Guru';
        $data->save();

        $biodata->gender = $request->gender;
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tanggal_lahir = $request->tanggal_lahir;
        if ($request->email != '') {
            $biodata->email = $request->email;
        }
        if ($request->no_hp != '') {
            $biodata->no_hp = $request->no_hp;
        }
        $biodata->user_id = $data->id;

        $biodata->save();

        return redirect('/admin/kelola-guru')->with('success', 'Berhasil Menambah Data Guru Baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'gender' => 'required|in:Pria,Wanita',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ],
        [
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'NIP harus diisi.',
            'username.unique' => 'NIP sudah terdaftar.',
            'gender.required' => 'Jenis kelamin harus dipilih.',
            'gender.in' => 'Jenis kelamin harus Pria atau Wanita.',
            'tempat_lahir.required' => 'Tempat lahir harus diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
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
        $biodata->tempat_lahir = $request->tempat_lahir;
        $biodata->tanggal_lahir = $request->tanggal_lahir;

        if ($request->email != '') {
            $biodata->email = $request->email;
        }
        if ($request->no_hp != '') {
            $biodata->no_hp = $request->no_hp;
        }

        $biodata->save();

        return redirect('/admin/kelola-guru')->with('success', 'Berhasil Memperbarui Data Guru');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $biodata = $data->biodata;

        $biodata->delete();
        $data->delete();

        return redirect('/admin/kelola-guru')->with('success', 'Berhasil Menghapus Data Guru');
    }

    public function reset_password($id)
    {
        $data = User::find($id);

        $data->password = Hash::make($data->username);
        $data->save();

        return redirect('/admin/kelola-guru')->with('success', 'Berhasil Reset Password Guru');
    }
}
