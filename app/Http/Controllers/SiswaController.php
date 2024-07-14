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
    public function dashboard()
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();
        $c1 = MataPelajaran::where('id', $biodata->mapel_fav ?? null)->first();
        $c2 = $biodata->jurusan ?? null;

        $id_c3 = MataPelajaran::where('nama_mapel', 'Matematika')->first()->id ?? null;
        $c3 =
            Nilai::where('mata_pelajaran_id', $id_c3)->where('user_id', Auth::id())->first()->nilai ??
            null;

        $id_c4 = MataPelajaran::where('nama_mapel', 'IPA')->first()->id ?? null;
        $c4 =
            Nilai::where('mata_pelajaran_id', $id_c4)->where('user_id', Auth::id())->first()->nilai ??
            null;

        $id_c5 = MataPelajaran::where('nama_mapel', 'IPS')->first()->id ?? null;
        $c5 =
            Nilai::where('mata_pelajaran_id', $id_c5)->where('user_id', Auth::id())->first()->nilai ??
            null;

        $isProfileComplete = $c1 && $c2 && $c3 && $c4 && $c5;

        return view('siswa.dashboard', ['isProfileComplete' => $isProfileComplete]);
    }

    public function nilai_siswa()
    {
        $siswa = User::find(Auth::id());
        $data = MataPelajaran::all();
        $nilai = Nilai::all();

        $biodata = Biodata::where('user_id', Auth::id())->first();
        $c1 = MataPelajaran::where('id', $biodata->mapel_fav ?? null)->first();
        $c2 = $biodata->jurusan ?? null;

        $id_c3 = MataPelajaran::where('nama_mapel', 'Matematika')->first()->id ?? null;
        $c3 =
            Nilai::where('mata_pelajaran_id', $id_c3)->where('user_id', Auth::id())->first()->nilai ??
            null;

        $id_c4 = MataPelajaran::where('nama_mapel', 'IPA')->first()->id ?? null;
        $c4 =
            Nilai::where('mata_pelajaran_id', $id_c4)->where('user_id', Auth::id())->first()->nilai ??
            null;

        $id_c5 = MataPelajaran::where('nama_mapel', 'IPS')->first()->id ?? null;
        $c5 =
            Nilai::where('mata_pelajaran_id', $id_c5)->where('user_id', Auth::id())->first()->nilai ??
            null;

        $isProfileComplete = $c1 && $c2 && $c3 && $c4 && $c5;

        return view('siswa.nilai-siswa', ['siswa' => $siswa, 'data' => $data, 'nilai' => $nilai, 'isProfileComplete' => $isProfileComplete]);
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
