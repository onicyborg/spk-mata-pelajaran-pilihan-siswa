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
        // Mengambil data C1 (Mapel yang disukai)
        $mapel_disukai = MataPelajaran::where('id', Biodata::where('user_id', $id)->first()->mapel_fav)->first();
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
        $jurusan = Biodata::where('user_id', $id)->first()->jurusan;
        if ($jurusan == 'IPA Teknik') {
            $c2 = 5;
        } else if ($jurusan == 'IPA Kesehatan') {
            $c2 = 4;
        } else {
            $c2 = 3;
        }

        // Mengambil nilai C3, C4, dan C5
        $id_c3 = MataPelajaran::where('nama_mapel', 'Matematika')->first()->id;
        $c3 = Nilai::where('mata_pelajaran_id', $id_c3)->where('user_id', $id)->first()->nilai;
        $id_c4 = MataPelajaran::where('nama_mapel', 'IPA')->first()->id;
        $c4 = Nilai::where('mata_pelajaran_id', $id_c4)->where('user_id', $id)->first()->nilai;
        $id_c5 = MataPelajaran::where('nama_mapel', 'IPS')->first()->id;
        $c5 = Nilai::where('mata_pelajaran_id', $id_c5)->where('user_id', $id)->first()->nilai;

        // Normalisasi nilai
        $maxValues = [
            'c3' => 100,
            'c4' => 100,
            'c5' => 100,
        ];

        $student = [
            'c1' => $c1,
            'c2' => $c2,
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

        // Hitung skor WP
        $S = calculateWpScore($student, $weights);

        // Threshold untuk kelayakan
        $threshold = 2;

        // Tentukan rekomendasi paket
        $recommendedPaket = $S >= $threshold ? 'Paket 1' : 'Paket 2';

        // Return hasil rekomendasi dan data perhitungan ke view
        return view('siswa.hasil', [
            'c1' => $c1,
            'c2' => $c2,
            'c3' => $c3,
            'c4' => $c4,
            'c5' => $c5,
            'c3_normalized' => $student['c3'],
            'c4_normalized' => $student['c4'],
            'c5_normalized' => $student['c5'],
            's' => $S,
            'recommendedPaket' => $recommendedPaket,
            'mapel_fav' => $mapel_disukai->nama_mapel,
            'jurusan' => $jurusan
        ]);
    }
}
