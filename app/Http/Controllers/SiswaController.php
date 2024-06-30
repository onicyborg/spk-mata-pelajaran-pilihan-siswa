<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function nilai_siswa()
    {
        $siswa = User::find(Auth::id());
        $data = MataPelajaran::all();
        $nilai = Nilai::all();

        return view('siswa.nilai-siswa', ['siswa' => $siswa, 'data' => $data, 'nilai' => $nilai]);
    }

    public function ketertarikan()
    {
        $mapel = MataPelajaran::all();

        return view('siswa.ketertarikan', ['mapel' => $mapel]);
    }

    public function ubah_jurusan(Request $request)
    {
        $biodata = Biodata::firstOrCreate(
            ['user_id' => Auth::id()],
            ['user_id' => Auth::id()]
        );

        $biodata->jurusan = $request->jurusan;
        $biodata->save();

        return redirect()->back()->with('success', 'Jurusan Berhasil Diperbarui');
    }

    public function ubah_mapel_fav(Request $request)
    {
        $biodata = Biodata::firstOrCreate(
            ['user_id' => Auth::id()],
            ['user_id' => Auth::id()]
        );

        $biodata->mapel_fav = $request->mapel_fav;
        $biodata->save();

        return redirect()->back()->with('success', 'Mata Pelajaran yang Disukai Berhasil Diperbarui');
    }
}
