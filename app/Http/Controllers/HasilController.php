<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class HasilController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'Siswa')->get();
        $mapel = MataPelajaran::all();
        $nilai = Nilai::all();

        if (Auth::user()->role == 'Siswa') {
            return view('admin.kelola-nilai', ['data' => $data, 'mapel' => $mapel]);
        } else if (Auth::user()->role == 'Guru') {
            return view('guru.hasil', ['data' => $data, 'mapel' => $mapel, 'nilai' => $nilai]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function hasil($id)
    {

        $user = User::find($id);
        // Mengambil data C1 (Mapel yang disukai)
        $biodata = Biodata::where('user_id', $id)->first();
        $mapel_disukai = MataPelajaran::where('id', $biodata->mapel_fav ?? null)->first();

        if (!$mapel_disukai || !$biodata->jurusan) {
            return redirect()->back()->withErrors('Harap lengkapi profile anda sebelum mengakses menu hasil');
        }

        if ($mapel_disukai->nama_mapel == 'IPA') {
            $c1 = 5;
        } else if ($mapel_disukai->nama_mapel == 'Matematika') {
            $c1 = 4;
        } else if ($mapel_disukai->nama_mapel == 'Informatika') {
            $c1 = 3;
        } else if ($mapel_disukai->nama_mapel == 'IPS') {
            $c1 = 2;
        } else if ($mapel_disukai->nama_mapel == 'Bahasa Indonesia') {
            $c1 = 1;
        } else {
            $c1 = 0;
        }

        // Mengambil data C2 (Jurusan yang dipilih)
        $jurusan = $biodata->jurusan;
        if ($jurusan == 'IPA Teknik') {
            $c2 = 5;
        } else if ($jurusan == 'IPA Kesehatan') {
            $c2 = 4;
        } else {
            $c2 = 3;
        }

        // Mengambil nilai C3, C4, dan C5
        $id_c3 = MataPelajaran::where('nama_mapel', 'Matematika')->first()->id ?? null;
        $c3 = Nilai::where('mata_pelajaran_id', $id_c3)->where('user_id', $id)->first()->nilai ?? null;

        $id_c4 = MataPelajaran::where('nama_mapel', 'IPA')->first()->id ?? null;
        $c4 = Nilai::where('mata_pelajaran_id', $id_c4)->where('user_id', $id)->first()->nilai ?? null;

        $id_c5 = MataPelajaran::where('nama_mapel', 'IPS')->first()->id ?? null;
        $c5 = Nilai::where('mata_pelajaran_id', $id_c5)->where('user_id', $id)->first()->nilai ?? null;

        // Pengecekan apakah data lengkap
        if (is_null($c1) || is_null($c2) || is_null($c3) || is_null($c4) || is_null($c5)) {
            if (Auth::user()->role == 'Guru') {
                return redirect()->back()->with('error', 'Anda belum bisa mengakses hasil dari siswa ini karena mungkin profile dari siswa ini belum lengkap atau nilai mata pelajarannya belum terisi sepenuhnya');
            } else {
                return redirect()->back()->with('error', 'Anda belum bisa mengakses menu ini karena mungkin profile anda belum lengkap dan nilai mata pelajaran anda belum terisi sepenuhnya');
            }
        }

        // Normalisasi nilai
        $maxValues = [
            'c3' => 100,
            'c4' => 100,
            'c5' => 100,
        ];

        $student_wp = [
            'c1' => $c1,
            'c2' => $c2,
            'c3' => $c3 / $maxValues['c3'],
            'c4' => $c4 / $maxValues['c4'],
            'c5' => $c5 / $maxValues['c5'],
        ];

        $student_saw = [
            'c1' => $c1 / 5,
            'c2' => $c2 / 5,
            'c3' => $c3 / $maxValues['c3'],
            'c4' => $c4 / $maxValues['c4'],
            'c5' => $c5 / $maxValues['c5'],
        ];

        // Bobot kriteria
        $weights = [
            'c1' => 0.30,
            'c2' => 0.25,
            'c3' => 0.20,
            'c4' => 0.15,
            'c5' => 0.10,
        ];

        // Fungsi untuk menghitung skor WP
        function calculateWpScore($criteria, $weights)
        {
            $score = 1;
            foreach ($criteria as $key => $value) {
                $score *= pow($value, $weights[$key]);
            }
            return $score;
        }

        // Fungsi untuk menghitung skor SAW
        function calculateSawScore($criteria, $weights)
        {
            $score = 0;
            foreach ($criteria as $key => $value) {
                $score += $value * $weights[$key];
            }
            return $score;
        }

        // Hitung skor WP dan SAW
        $S_wp = calculateWpScore($student_wp, $weights);
        $S_saw = calculateSawScore($student_saw, $weights);

        // Threshold untuk kelayakan
        $threshold_wp = 2.0;
        $threshold_saw = 0.70;

        // Tentukan rekomendasi paket berdasarkan WP
        $recommendedPaket_wp = $S_wp >= $threshold_wp ? 'Paket 1' : 'Paket 2';

        // Tentukan rekomendasi paket berdasarkan SAW
        $recommendedPaket_saw = $S_saw >= $threshold_saw ? 'Paket 1' : 'Paket 2';

        // Return hasil rekomendasi dan data perhitungan ke view
        if (Auth::user()->role == 'Siswa') {
            return view('siswa.hasil', [
                'c1' => $c1,
                'c2' => $c2,
                'c3' => $c3,
                'c4' => $c4,
                'c5' => $c5,
                'c1_normalized' => $student_saw['c1'],
                'c2_normalized' => $student_saw['c2'],
                'c3_normalized' => $student_saw['c3'],
                'c4_normalized' => $student_saw['c4'],
                'c5_normalized' => $student_saw['c5'],
                's_wp' => $S_wp,
                's_saw' => $S_saw,
                'recommendedPaket_wp' => $recommendedPaket_wp,
                'recommendedPaket_saw' => $recommendedPaket_saw,
                'mapel_fav' => $mapel_disukai->nama_mapel,
                'jurusan' => $jurusan
            ]);
        }else{
            return view('guru.detail-hasil', [
                'user' => $user,
                'c1' => $c1,
                'c2' => $c2,
                'c3' => $c3,
                'c4' => $c4,
                'c5' => $c5,
                'c1_normalized' => $student_saw['c1'],
                'c2_normalized' => $student_saw['c2'],
                'c3_normalized' => $student_saw['c3'],
                'c4_normalized' => $student_saw['c4'],
                'c5_normalized' => $student_saw['c5'],
                's_wp' => $S_wp,
                's_saw' => $S_saw,
                'recommendedPaket_wp' => $recommendedPaket_wp,
                'recommendedPaket_saw' => $recommendedPaket_saw,
                'mapel_fav' => $mapel_disukai->nama_mapel,
                'jurusan' => $jurusan
            ]);
        }
    }
}
