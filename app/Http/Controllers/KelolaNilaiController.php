<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaNilaiController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'Siswa')->get();
        $mapel = MataPelajaran::all();

        return view('admin.kelola-nilai', ['data' => $data, 'mapel' => $mapel]);
    }

    public function detail_nilai($id)
    {
        $siswa = User::find($id);
        $data = MataPelajaran::all();
        $nilai = Nilai::all();

        return view('admin.detail-nilai', ['siswa' => $siswa, 'data' => $data, 'nilai' => $nilai]);
    }

    public function store_nilai(Request $request)
    {
        $nilai = new Nilai();

        $nilai->user_id = $request->user_id;
        $nilai->mata_pelajaran_id = $request->mata_pelajaran_id;
        $nilai->nilai = $request->nilai;
        $nilai->save();

        return redirect('/admin/penilaian-siswa/'. $request->user_id)->with('success', 'Berhasil Menambahkan Nilai');
    }

    public function update_nilai(Request $request, $id)
    {
        $nilai = Nilai::find($id);

        $nilai->nilai = $request->nilai;
        $nilai->save();

        return redirect('/admin/penilaian-siswa/'. $request->user_id)->with('success', 'Berhasil Memperbarui Nilai');
    }
}
