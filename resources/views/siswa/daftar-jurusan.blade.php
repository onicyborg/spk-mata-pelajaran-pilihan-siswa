@extends('layouts.master')

@section('title')
    Daftar Jurusan
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Daftar Jurusan</h3>
                <h6 class="op-7 mb-2">Jurusan perkuliahan yang banyak diminati dan sedikit diminati</h6>
            </div>
        </div>

        <!-- Jurusan yang Banyak Diminati -->
        <div class="row">
            <h4 class="fw-bold mb-3">Paling Banyak Diminati</h4>
            @php
                $jurusanBanyakDiminati = [
                    [
                        'Ilmu Komunikasi',
                        asset('assets/img/ilmu-komunikasi.svg'),
                        'Ilmu yang mempelajari cara berkomunikasi yang efektif dalam berbagai konteks.',
                        'Kurikulum meliputi: Teori Komunikasi, Komunikasi Bisnis, Media Massa, Public Relations.',
                    ],
                    [
                        'Ilmu Hukum',
                        asset('assets/img/ilmu-hukum.svg'),
                        'Studi tentang sistem hukum, hak dan kewajiban hukum.',
                        'Kurikulum meliputi: Hukum Perdata, Hukum Pidana, Hukum Tata Negara, Hukum Internasional.',
                    ],
                    [
                        'Desain Komunikasi Visual',
                        asset('assets/img/dkv.svg'),
                        'Fokus pada desain grafis dan media visual untuk komunikasi.',
                        'Kurikulum meliputi: Desain Grafis, Fotografi, Ilustrasi, Desain Interaktif.',
                    ],
                    [
                        'Ekonomi',
                        asset('assets/img/ekonomi.svg'),
                        'Ilmu yang mempelajari produksi, distribusi, dan konsumsi barang dan jasa.',
                        'Kurikulum meliputi: Mikroekonomi, Makroekonomi, Ekonomi Keuangan, Ekonomi Internasional.',
                    ],
                    [
                        'Ilmu Komputer',
                        asset('assets/img/ilkom.svg'),
                        'Studi tentang komputasi, perangkat lunak, dan sistem informasi.',
                        'Kurikulum meliputi: Pemrograman Komputer, Basis Data, Jaringan Komputer, Keamanan Informasi.',
                    ],
                    [
                        'Kedokteran',
                        asset('assets/img/kedokteran.svg'),
                        'Ilmu yang mempelajari kesehatan manusia dan praktik medis.',
                        'Kurikulum meliputi: Anatomi, Fisiologi, Patologi, Klinik Medis, Bedah.',
                    ],
                    [
                        'Psikologi',
                        asset('assets/img/psikologi.svg'),
                        'Studi tentang perilaku dan proses mental manusia.',
                        'Kurikulum meliputi: Psikologi Perkembangan, Psikologi Klinis, Psikologi Sosial, Psikologi Industri dan Organisasi.',
                    ],
                    [
                        'Matematika',
                        asset('assets/img/matematika.svg'),
                        'Ilmu yang mempelajari struktur, ruang, dan perubahan melalui angka dan simbol.',
                        'Kurikulum meliputi: Kalkulus, Aljabar, Statistika, Matematika Diskrit.',
                    ],
                    [
                        'Teknik Mesin',
                        asset('assets/img/enginer.svg'),
                        'Fokus pada desain, analisis, dan pembuatan mesin.',
                        'Kurikulum meliputi: Mekanika, Termodinamika, Desain Mesin, Teknologi Manufaktur.',
                    ],
                    [
                        'Teknik Elektro',
                        asset('assets/img/elektro.svg'),
                        'Ilmu yang mempelajari aplikasi listrik, elektronika, dan elektromagnetisme.',
                        'Kurikulum meliputi: Sirkuit Elektronik, Sistem Kontrol, Komunikasi Elektro, Energi Terbarukan.',
                    ],
                ];
            @endphp

            @foreach ($jurusanBanyakDiminati as $jurusan)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($jurusan[1]) }}" class="card-img-top mx-auto d-block" alt="{{ $jurusan[0] }}"
                            style="max-height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $jurusan[0] }}</h5>
                            <p class="card-text">{{ $jurusan[2] }}</p>
                            <p class="card-text"><small class="text-muted">{{ $jurusan[3] }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Jurusan yang Sedikit Diminati -->
        <div class="row mt-5">
            <h4 class="fw-bold mb-3">Paling Sedikit Diminati</h4>
            @php
                $jurusanSedikitDiminati = [
                    ['Sastra Jawa', asset('assets/img/sastra-jawa.svg'), 'Studi tentang bahasa, sastra, dan budaya Jawa.', 'Kurikulum meliputi: Sastra Jawa Klasik, Sastra Jawa Modern, Sejarah dan Kebudayaan Jawa.'],
                    ['Sastra Rusia', asset('assets/img/sastra-rusia.svg'), 'Fokus pada bahasa dan sastra Rusia.', 'Kurikulum meliputi: Sastra Rusia Klasik, Sastra Rusia Modern, Sastra Soviet.'],
                    ['Sastra Belanda', asset('assets/img/sastra-belanda.svg'), 'Studi tentang bahasa dan sastra Belanda.', 'Kurikulum meliputi: Sastra Belanda Klasik, Sastra Belanda Modern, Sastra Flamand.'],
                    ['Mikrobiologi Pertanian', asset('assets/img/mikrobiologi.svg'), 'Ilmu tentang mikroorganisme dalam pertanian.', 'Kurikulum meliputi: Mikrobiologi Tanah, Mikrobiologi Tumbuhan, Biokimia Pertanian.'],
                    ['Manajemen Sumber Daya Akuatik', asset('assets/img/akuatik.svg'), 'Fokus pada pengelolaan sumber daya air dan ekosistemnya.', 'Kurikulum meliputi: Ekologi Perairan, Teknologi Akuakultur, Konservasi Sumber Daya Akuatik.'],
                    ['Hasil Perikanan', asset('assets/img/fisher.svg'), 'Ilmu tentang produksi dan pengelolaan produk perikanan.', 'Kurikulum meliputi: Teknik Perikanan, Pengolahan Hasil Perikanan, Pemasaran Produk Perikanan.'],
                    ['Sastra Jerman', asset('assets/img/jerman.svg'), 'Studi tentang bahasa dan sastra Jerman.', 'Kurikulum meliputi: Sastra Jerman Klasik, Sastra Jerman Modern, Sejarah dan Budaya Jerman.'],
                    ['Geofisika', asset('assets/img/geofisika.svg'), 'Ilmu tentang fisika bumi dan sekitarnya.', 'Kurikulum meliputi: Geologi Struktur, Seismologi, Geofisika Terapan.'],
                    ['Akuakultur', asset('assets/img/akuakultur.svg'), 'Fokus pada budidaya organisme air.', 'Kurikulum meliputi: Manajemen Akuakultur, Nutrisi Organisme Air, Teknik Budidaya Organisme Air.'],
                    ['Sastra Perancis', asset('assets/img/prancis.svg'), 'Studi tentang bahasa dan sastra Perancis.', 'Kurikulum meliputi: Sastra Perancis Klasik, Sastra Perancis Modern, Sastra Belgia.'],
                ];
            @endphp

            @foreach ($jurusanSedikitDiminati as $jurusan)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($jurusan[1]) }}" class="card-img-top mx-auto d-block" alt="{{ $jurusan[0] }}"
                            style="max-height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $jurusan[0] }}</h5>
                            <p class="card-text">{{ $jurusan[2] }}</p>
                            <p class="card-text"><small class="text-muted">{{ $jurusan[3] }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
@endpush
