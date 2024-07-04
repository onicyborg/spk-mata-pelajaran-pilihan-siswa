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
                <h3 class="fw-bold mb-3">Hasil Rekomendasi Paket Mata Pelajaran Siswa</h3>
                <h6 class="op-7 mb-2">Hasil Rekomendasi Ini Menggunakan Perhitungan SAW dan WP</h6>
            </div>
        </div>

        <div class="row">
            <!-- Card Perhitungan SAW -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Perhitungan SAW</h4>
                        <p><strong>Jurusan: </strong>{{ $jurusan }}</p>
                        <p><strong>Mata Pelajaran yang Disukai: </strong>{{ $mapel_fav }}</p>

                        <!-- Matriks Keputusan -->
                        <h5 class="mt-4">1. Matriks Keputusan</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mata Pelajaran</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilaiArray as $mapel => $value)
                                    <tr>
                                        <td>{{ $mapel }}</td>
                                        <td>{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @php
                            $no = 2;
                        @endphp

                        @foreach ($saw_results as $package => $result)
                            <!-- Tampilkan Matriks Normalisasi -->
                            <h5 class="mt-4">{{ $no }}. Matriks Normalisasi untuk {{ $package }}</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Nilai Normalisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result['normalized_matrix'] as $mapel => $value)
                                        <tr>
                                            <td>{{ $mapel }}</td>
                                            <td>{{ number_format($value, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @php
                                $no++;
                            @endphp
                            <!-- Tampilkan Matriks Normalisasi Terbobot -->
                            <h5 class="mt-4">{{ $no }}. Matriks Normalisasi Terbobot untuk {{ $package }}</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Nilai Normalisasi Terbobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result['weighted_matrix'] as $mapel => $value)
                                        <tr>
                                            <td>{{ $mapel }}</td>
                                            <td>{{ number_format($value, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @php
                                $no++;
                            @endphp
                            <!-- Tampilkan Hasil Akhir -->
                            <h5 class="mt-4">{{ $no }}. Hasil Akhir untuk {{ $package }}</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Paket Mata Pelajaran</th>
                                        <th>Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $package }}</td>
                                        <td>{{ number_format($result['final_score'], 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @php
                                $no++;
                            @endphp
                        @endforeach

                        <h5 class="mt-4">Rekomendasi Paket Mata Pelajaran: {{ $recommended_package }}</h5>
                        <p>Mata pelajaran yang termasuk: <strong>
                            @foreach ($recommended_packages[$recommended_package] as $mapel)
                                {{ $mapel }},
                            @endforeach
                        </strong></p>
                    </div>
                </div>
            </div>

            <!-- Card Perhitungan WP -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Perhitungan WP</h4>
                        <p>Proses perhitungan WP akan ditambahkan di sini.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Tambahkan JS DataTables jika diperlukan -->
@endpush
