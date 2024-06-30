<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaNilaiController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'Siswa')->get();
        $mapel = MataPelajaran::all();

        if (Auth::user()->role == 'Admin') {
            return view('admin.kelola-nilai', ['data' => $data, 'mapel' => $mapel]);
        } else if (Auth::user()->role == 'Guru') {
            return view('guru.kelola-nilai', ['data' => $data, 'mapel' => $mapel]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function detail_nilai($id)
    {
        $siswa = User::find($id);
        $data = MataPelajaran::all();
        $nilai = Nilai::all();

        if (Auth::user()->role == 'Admin') {
            return view('admin.detail-nilai', ['siswa' => $siswa, 'data' => $data, 'nilai' => $nilai]);
        } else if (Auth::user()->role == 'Guru') {
            return view('guru.detail-nilai', ['siswa' => $siswa, 'data' => $data, 'nilai' => $nilai]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function store_nilai(Request $request)
    {
        $nilai = new Nilai();

        $nilai->user_id = $request->user_id;
        $nilai->mata_pelajaran_id = $request->mata_pelajaran_id;
        $nilai->nilai = $request->nilai;
        if ($request->keterangan != null) {
            $nilai->keterangan = $request->keterangan;
        }
        $nilai->save();

        if (Auth::user()->role == 'Admin') {
            return redirect('/admin/penilaian-siswa/' . $request->user_id)->with('success', 'Berhasil Menambahkan Nilai');
        } else if (Auth::user()->role == 'Guru') {
            return redirect('/guru/penilaian-siswa/' . $request->user_id)->with('success', 'Berhasil Menambahkan Nilai');
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function update_nilai(Request $request, $id)
    {
        $nilai = Nilai::find($id);

        $nilai->nilai = $request->nilai;
        if ($request->keterangan != null) {
            $nilai->keterangan = $request->keterangan;
        }
        $nilai->save();

        if (Auth::user()->role == 'Admin') {
            return redirect('/admin/penilaian-siswa/' . $request->user_id)->with('success', 'Berhasil Memperbarui Nilai');
        } else if (Auth::user()->role == 'Guru') {
            return redirect('/guru/penilaian-siswa/' . $request->user_id)->with('success', 'Berhasil Memperbarui Nilai');
        } else {
            abort(403, 'Unauthorized');
        }
    }
}
