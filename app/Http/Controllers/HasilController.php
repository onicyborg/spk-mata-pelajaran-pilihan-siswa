<?php

namespace App\Http\Controllers;

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

        if (Auth::user()->role == 'Siswa') {
            return view('admin.kelola-nilai', ['data' => $data, 'mapel' => $mapel]);
        } else if (Auth::user()->role == 'Guru') {
            return view('guru.hasil', ['data' => $data, 'mapel' => $mapel]);
        } else {
            abort(403, 'Unauthorized');
        }
    }

    public function hasil($id)
    {
        $mapel = MataPelajaran::all();
        $nilai = Nilai::where('user_id', $id)->get()->pluck('nilai', 'mata_pelajaran_id');
        $user = User::find($id);

        if ($user && $user->biodata) {
            $jurusan = $user->biodata->jurusan;
            $mapel_fav = $user->biodata->mapel_fav->nama_mapel ?? null;
        } else {
            $jurusan = null;
            $mapel_fav = null;
        }

        $nilaiArray = [];
        foreach ($mapel as $item) {
            $nilaiArray[$item->nama_mapel] = $nilai[$item->id] ?? 0;
        }

        $paket1 = [
            'Matematika' => 0.2,
            'IPA' => 0.2,
            'IPS' => 0.2,
            'Bahasa Indonesia' => 0,
            'Bahasa Inggris' => 0.2,
            'Informatika' => 0.2,
            'Pancasila' => 0,
            'Agama' => 0,
            'PJOK' => 0,
        ];

        $paket2 = [
            'Matematika' => 0.14,
            'IPA' => 0,
            'IPS' => 0.29,
            'Bahasa Indonesia' => 0,
            'Bahasa Inggris' => 0.14,
            'Informatika' => 0.29,
            'Pancasila' => 0,
            'Agama' => 0,
            'PJOK' => 0,
        ];

        $paket3 = [
            'Matematika' => 0.2,
            'IPA' => 0.4,
            'IPS' => 0.2,
            'Bahasa Indonesia' => 0,
            'Bahasa Inggris' => 0.2,
            'Informatika' => 0,
            'Pancasila' => 0,
            'Agama' => 0,
            'PJOK' => 0,
        ];

        $paket4 = [
            'Matematika' => 0,
            'IPA' => 0,
            'IPS' => 0.6,
            'Bahasa Indonesia' => 0,
            'Bahasa Inggris' => 0.2,
            'Informatika' => 0,
            'Pancasila' => 0,
            'Agama' => 0,
            'PJOK' => 0,
        ];

        $paket5 = [
            'Matematika' => 0,
            'IPA' => 0,
            'IPS' => 0.2,
            'Bahasa Indonesia' => 0.2,
            'Bahasa Inggris' => 0.2,
            'Informatika' => 0,
            'Pancasila' => 0.2,
            'Agama' => 0,
            'PJOK' => 0.2,
        ];

        $packages = [$paket1, $paket2, $paket3, $paket4, $paket5];

        function calculateSAW($nilai, $paket)
        {
            $normalized_matrix = [];
            $weighted_matrix = [];
            $final_score = 0;

            foreach ($nilai as $mapel => $nilai_mapel) {
                $normalized_value = $nilai_mapel / 100; // Normalisasi (nilai max 100)
                $weighted_value = $normalized_value * $paket[$mapel]; // Pembobotan
                $normalized_matrix[$mapel] = $normalized_value;
                $weighted_matrix[$mapel] = $weighted_value;
                $final_score += $weighted_value;
            }

            return [$normalized_matrix, $weighted_matrix, $final_score];
        }

        $saw_results = [];
        foreach ($packages as $index => $paket) {
            [$norm_matrix, $weight_matrix, $score] = calculateSAW($nilaiArray, $paket);
            $saw_results['Paket ' . ($index + 1)] = [
                'normalized_matrix' => $norm_matrix,
                'weighted_matrix' => $weight_matrix,
                'final_score' => $score
            ];
        }

        // Define recommended packages
        $recommended_packages = [
            'Paket 1' => ['Fisika', 'Matematika Lanjut', 'Informatika', 'Geografi', 'Bahasa Inggris', 'Bahasa Jepang'],
            'Paket 2' => ['Ekonomi', 'Matematika Lanjut', 'Informatika', 'Bahasa Inggris', 'Bahasa Jepang', 'Sosiologi'],
            'Paket 3' => ['Biologi', 'Kimia', 'Matematika Lanjut', 'Bahasa Inggris', 'Sosiologi'],
            'Paket 4' => ['Ekonomi', 'Geografi', 'Sosiologi', 'Bahasa Inggris Tingkat Lanjut', 'Bahasa Jepang'],
            'Paket 5' => ['Seni Budaya', 'Kewirausahaan', 'Sejarah', 'Bahasa Indonesia', 'Bahasa Inggris', 'PPKn', 'PJOK'],
        ];

        $sorted_saw_results = $saw_results; // Buat salinan dari $saw_results
        arsort($sorted_saw_results); // Urutkan salinan dari $saw_results

        $recommended_package = key($sorted_saw_results); // Ambil kunci dari array yang sudah diurutkan

        return view('guru.detail-hasil', compact('nilaiArray', 'jurusan', 'mapel_fav', 'saw_results', 'recommended_package', 'recommended_packages'));
    }
}
