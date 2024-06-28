<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class KelolaMapelController extends Controller
{
    public function index()
    {
        $data = MataPelajaran::all();

        return view('admin.kelola-mapel', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required'
        ],[
            'nama_mapel.required' => 'Nama mata pelajaran harus diisi.'
        ]);

        $data = new MataPelajaran();

        $data->nama_mapel = $request->nama_mapel;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('/admin/kelola-mapel')->with('success', 'Berhasil menambahkan mata pelajaran baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mapel' => 'required'
        ],[
            'nama_mapel.required' => 'Nama mata pelajaran harus diisi.'
        ]);

        $data = MataPelajaran::find($id);

        $data->nama_mapel = $request->nama_mapel;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('/admin/kelola-mapel')->with('success', 'Berhasil memperbarui data mata pelajaran');
    }

    public function destroy($id)
    {
        $data = MataPelajaran::find($id);

        $data->delete();

        return redirect('/admin/kelola-mapel')->with('success', 'Berhasil menghapus data mata pelajaran');
    }
}
