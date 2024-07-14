@extends('layouts.master')

@section('title')
    Hasil Rekomendasi Paket Mata Pelajaran Siswa
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Hasil Rekomendasi Paket Mata Pelajaran untuk Anda</h3>
                <h6 class="op-7 mb-2">Hasil Rekomendasi Ini Menggunakan Perhitungan SAW dan WP</h6>
            </div>
        </div>

        <div class="row">
            <!-- Card Perhitungan SAW -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Perhitungan SAW</h4>
                        <!-- Letakkan perhitungan SAW di sini jika diperlukan -->
                    </div>
                </div>
            </div>

            <!-- Card Perhitungan WP -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Perhitungan WP</h4>
                        <p><strong>Nilai Kriteria:</strong></p>
                        <ul>
                            <li>C1 (Mapel yang disukai): {{ $mapel_fav }} ({{ $c1 }})</li>
                            <li>C2 (Jurusan yang dipilih): {{ $jurusan }} ({{ $c2 }})</li>
                            <li>C3 (Nilai Matematika): {{ $c3 }}</li>
                            <li>C4 (Nilai IPA): {{ $c4 }}</li>
                            <li>C5 (Nilai IPS): {{ $c5 }}</li>
                        </ul>

                        <p><strong>Normalisasi Nilai:</strong></p>
                        <ul>
                            <li>C3': {{ $c3_normalized }}</li>
                            <li>C4': {{ $c4_normalized }}</li>
                            <li>C5': {{ $c5_normalized }}</li>
                        </ul>

                        <p><strong>Bobot Kriteria:</strong></p>
                        <ul>
                            <li>C1: 0.30</li>
                            <li>C2: 0.25</li>
                            <li>C3: 0.20</li>
                            <li>C4: 0.15</li>
                            <li>C5: 0.10</li>
                        </ul>

                        <p><strong>Perhitungan Nilai Vektor S:</strong></p>
                        <p>S = ({{ $c1 }}^0.30) x ({{ $c2 }}^0.25) x ({{ $c3_normalized }}^0.20) x
                            ({{ $c4_normalized }}^0.15) x ({{ $c5_normalized }}^0.10)</p>
                        <p>S = {{ $s }}</p>

                        <p><strong>Hasil Rekomendasi:</strong></p>
                        <p>Nilai akhir dari perhitungan data anda adalah {{ $s }} dan nilai tersebut masuk dalam
                            kategori <strong>{{ $recommendedPaket == 'Paket 1' ? 'Paket Mata Pelajaran Pendukung 1' : 'Paket Mata Pelajaran Pendukung 2' }}</strong> karena nilainya
                            {{ $recommendedPaket == 'Paket 1' ? '> 2' : '< 2' }}</p>
                        <p>Sehingga paket yang direkomendasikan untuk anda adalah: <strong>{{ $recommendedPaket == 'Paket 1' ? 'Paket Mata Pelajaran Pendukung 1' : 'Paket Mata Pelajaran Pendukung 2' }}</strong></p>

                        @if ($recommendedPaket == 'Paket 1')
                            <p>Mata pelajaran pendukung yang direkomendasikan mencakup:</p>
                            <ul>
                                <li>Fisika</li>
                                <li>Matematika Lanjut</li>
                                <li>Informatika</li>
                                <li>Biologi</li>
                                <li>Kimia</li>
                                <li>Bhs Indonesia</li>
                                <li>Bhs Inggris</li>
                                <li>Seni Budaya dan Prakarya</li>
                                <li>Pancasila</li>
                                <li>PJOK</li>
                                <li>Agama</li>
                            </ul>
                        @else
                            <p>Mata pelajaran pendukung yang direkomendasikan mencakup:</p>
                            <ul>
                                <li>Ekonomi</li>
                                <li>Matematika</li>
                                <li>Sosiologi</li>
                                <li>Geografi</li>
                                <li>Sejarah</li>
                                <li>Bhs Indonesia</li>
                                <li>Bhs Inggris</li>
                                <li>Seni Budaya dan Prakarya</li>
                                <li>Pancasila</li>
                                <li>PJOK</li>
                                <li>Agama</li>
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Tambahkan JS DataTables jika diperlukan -->
@endpush
