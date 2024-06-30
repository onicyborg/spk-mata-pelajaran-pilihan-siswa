@extends('layouts.master')

@section('title')
    Daftar Kepribadian
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Daftar Kepribadian</h3>
                <h6 class="op-7 mb-2">Daftar Kepribadian dan Rekomendasi Jurusan yang Cocok</h6>
            </div>
        </div>

        <!-- Daftar Kepribadian -->
        <div class="row">
            @php
                $personalities = [
                    [
                        'name' => 'ISTJ',
                        'image' => asset('assets/img/istj.svg'),
                        'description' => 'Memiliki tipe kepribadian ISTJ cenderung menjadi individu yang praktis, sistematis, dan berorientasi pada fakta. Kamu sangat terorganisir, bertanggung jawab, dan memperhatikan detail. Selain itu, ISTJ punya kemampuan yang baik dalam mengikuti prosedur dan tugas yang terstruktur.',
                        'recommended_majors' => ['Akuntansi', 'Administrasi Bisnis', 'Teknik'],
                    ],
                    [
                        'name' => 'ISFJ',
                        'image' => asset('assets/img/isfj.svg'),
                        'description' => 'ISFJ adalah sosok yang berhati lembut dan penuh perhatian. Mereka sangat ramah, suka menolong, dan punya keterampilan sosial yang baik meskipun tergolong dalam kepribadian Introvert. Sayangnya, kebaikan ISFJ sering dimanfaatkan berlebihan. Kalau temanmu adalah seorang ISFJ, jangan lupa untuk mengapresiasi kebaikan mereka ya!',
                        'recommended_majors' => ['Pendidikan', 'Kedokteran', 'Keperawatan'],
                    ],
                    [
                        'name' => 'INFJ',
                        'image' => asset('assets/img/infj.svg'),
                        'description' => 'Tahukah kamu hanya 1% dari populasi di dunia yang memiliki kepribadian ini? Meski terlihat pendiam, INFJ adalah individu yang peka terhadap perasaan orang lain, memiliki tekad yang kuat untuk mewujudkan keinginannya, serta berjiwa kreatif. Psstt, banyak yang bilang INFJ adalah tipe kepribadian yang paling introvert lho. Apakah kamu seorang INFJ?',
                        'recommended_majors' => ['Psikologi', 'Sastra', 'Desain'],
                    ],
                    [
                        'name' => 'INTJ',
                        'image' => asset('assets/img/intj.svg'),
                        'description' => 'Selain INFJ, ada pula kepribadian MBTI lainnya yang langka ditemui di dunia, sekitar 0,8 hingga 2% dari populasi.  Di kehidupan sosial, INTJ sering dijuluki “si kutu buku” dan terkenal sebagai pribadi yang kaku. Namun, dibalik itu semua, INTJ merupakan sosok yang ambisius, tegas, punya rasa keingintahuan yang tinggi, dan menjaga privasi.',
                        'recommended_majors' => ['Ilmu Komputer', 'Teknik', 'Manajemen'],
                    ],
                    [
                        'name' => 'ISTP',
                        'image' => asset('assets/img/istp.svg'),
                        'description' => 'Lebih senang praktik dibanding teori? Mungkin kepribadian kamu adalah ISTP! Tipe kepribadian ini mempelajari sesuatu dengan cara terjun langsung dibanding membaca. ISTP tidak takut dengan kegagalan, memiliki keinginan tinggi untuk mencoba sesuatu yang baru, spontan, dan membiarkan orang lain terlibat atau masuk dalam hidupnya.',
                        'recommended_majors' => ['Teknik Mesin', 'Seni Rupa', 'Olahraga'],
                    ],
                    [
                        'name' => 'ISFP',
                        'image' => asset('assets/img/isfp.svg'),
                        'description' => 'Pernah nggak punya teman yang diam-diam tapi ternyata punya bakat terpendam? Atau mungkin itu kamu sendiri? Ciri ini melekat pada kepribadian ISFP. Dijuluki sebagai seniman sejati, ISFP adalah individu yang kreatif, spontan, serta peka terhadap lingkungan sekitar. Meski begitu, ISFP sering memendam sesuatu karena tidak ingin menimbulkan masalah.',
                        'recommended_majors' => ['Seni', 'Desain Interior', 'Musik'],
                    ],
                    [
                        'name' => 'INFP',
                        'image' => asset('assets/img/infp.svg'),
                        'description' => 'INFP adalah sosok yang sangat idealis dan penuh empati. Nggak heran, mereka mempunyai kemampuan untuk memahami emosi orang lain. INFP senang menolong orang di sekitarnya, terutama yang berkaitan dengan luka batin. INFP sering mengamati keadaan di sekelilingnya sehingga memudakan mereka untuk berkomunikasi secara mendalam dengan orang lain.',
                        'recommended_majors' => ['Jurnalisme', 'Psikologi', 'Seni Pertunjukan'],
                    ],
                    [
                        'name' => 'INTP',
                        'image' => asset('assets/img/intp.svg'),
                        'description' => 'Logika adalah hal yang terpenting bagi tipe kepribadian INTP. Angka dan pola yang rumit justru jadi tantangan bagi mereka. INTP biasanya terlihat pada individu yang menyukai Matematika. Orang dengan kepribadian INTP sering dianggap pemalu dan pendiam, padahal mereka hanya terlalu sering berpikir dan mengamati lingkungan sekitar.',
                        'recommended_majors' => ['Ilmu Komputer', 'Matematika', 'Fisika'],
                    ],
                    [
                        'name' => 'ESTP',
                        'image' => asset('assets/img/estp.svg'),
                        'description' => 'Mereka yang memiliki tipe kepribadian ESTP biasanya senang menjadi pusat perhatian. Sangat menyenangkan, berani, menyukai tantangan, dan fleksibel. Nggak heran kalau ESTP punya teman yang banyak serta mudah beradaptasi dalam kondisi apapun. ESTP juga bertindak spontan tanpa memikirkan sesuatu terlalu lama.',
                        'recommended_majors' => ['Bisnis', 'Olahraga', 'Pemasaran'],
                    ],
                    [
                        'name' => 'ESFP',
                        'image' => asset('assets/img/esfp.svg'),
                        'description' => 'Kepribadian ESFP banyak dimiliki oleh aktor dan pemain di industri hiburan. Mereka ingin orang lain merasakan kebahagiaan dan kembali bersemangat. ESFP juga punya selera yang tinggi dalam modeserta tidak takut mengekspresikan gaya mereka. Sayangnya, ESFP kurang cocok dengan pekerjaan yang kompleks dan berhubungan dengan statistik.',
                        'recommended_majors' => ['Komunikasi', 'Pariwisata', 'Seni Pertunjukan'],
                    ],
                    [
                        'name' => 'ENFP',
                        'image' => asset('assets/img/enfp.svg'),
                        'description' => 'Kepribadian ENFP berfokus pada hubungan emosional dan sosial yang mereka bangun dengan orang lain. Mereka juga mandiri, penuh inovasi, serta dapat memberikan solusi atas masalah yang ada. ENFP haus akan ilmu pengetahuan tetapi tidak menjadikan mereka sebagai pribadi yang sombong. Justru, kebanyakan ENFP menghindari percakapan yang menyinggung.',
                        'recommended_majors' => ['Ilmu Politik', 'Jurnalisme', 'Sosiologi'],
                    ],
                    [
                        'name' => 'ENTP',
                        'image' => asset('assets/img/entp.svg'),
                        'description' => 'Berbanding terbalik dengan ENFP, kepribadian ENTP menyukai perdebatan. Punya ide-ide brilian, karismatik, dan senang beradu argumen dengan orang lain. Intinya, mereka sangat tertarik berada di keramaian, terlebih jika terlibat dalam percakapan tentang sesuatu yang mereka minati. Kualitas utama dari ENTP adalah mentalnya yang kuat.',
                        'recommended_majors' => ['Bisnis', 'Hukum', 'Hubungan Internasional'],
                    ],
                    [
                        'name' => 'ESTJ',
                        'image' => asset('assets/img/estj.svg'),
                        'description' => 'Apakah kamu sering dipercaya menjadi Panitia Acara di sekolah? Mungkin tipe kepribadian kamu adalah ESTJ. Sosok ini dikenal berjiwa pemimpin, terorganisir, percaya diri, dan dapat diandalkan. Mereka mampu menyatukan orang-orang di sebuah acara. Namun, ESTJ sering dianggap kaku, keras kepala, dan sulit beradaptasi dengan perubahan.',
                        'recommended_majors' => ['Manajemen', 'Administrasi Bisnis', 'Keuangan'],
                    ],
                    [
                        'name' => 'ESFJ',
                        'image' => asset('assets/img/esfj.svg'),
                        'description' => 'Kata siapa extrovert itu nggak sensitif? Tipe kepribadian ESFJ adalah orang-orang yang berhati lembut, lho. Mereka mudah tersentuh sehingga tak segan membantu orang lain yang kesusahan. ESFJ juga menyukai interaksi dengan orang banyak, ramah, populer, teliti, berorientasi pada pelayanan, serta easy going.',
                        'recommended_majors' => ['Komunikasi', 'Psikologi', 'Keperawatan'],
                    ],
                    [
                        'name' => 'ENFJ',
                        'image' => asset('assets/img/enfj.svg'),
                        'description' => 'Wah, kalau ini sih tipe kepribadian aku, hihihi. ENFJ termasuk karakter yang idealis dan terkadang berusaha untuk mengubah orang lain menjadi lebih baik dari sebelumnya. Ketika ada 1 hal yang bertentangan, mereka ingin mengubahnya menjadi kesamaan, ini yang membuat ENFJ punya kemampuan komunikasi yang cukup mumpuni.',
                        'recommended_majors' => ['Psikologi', 'Pendidikan', 'Hubungan Internasional'],
                    ],
                    [
                        'name' => 'ENTJ',
                        'image' => asset('assets/img/entj.svg'),
                        'description' => 'Sampai juga di tipe kepribadian MBTI yang terakhir yaitu ENTJ. Mereka adalah individu yang ambisius, mendominasi, berpikir strategis, dan tidak mudah menyerah. Terkadang ENTJ dianggap terlalu mengintimidasi, padahal mereka hanya gigih untuk mencapai apa yang diinginkan. Mereka juga sulit mengekpresikan emosi.',
                        'recommended_majors' => ['Ilmu Pemerintahan', 'Ilmu Politik', 'Manajemen'],
                    ],
                ];
            @endphp

            @foreach ($personalities as $personality)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <img src="{{ $personality['image'] }}" alt="{{ $personality['name'] }}" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h5 class="card-title fw-bold">{{ $personality['name'] }}</h5>
                                <p class="card-text">{{ $personality['description'] }}</p>
                                <p class="card-text fw-bold">Jurusan yang cocok:</p>
                                <ul>
                                    @foreach ($personality['recommended_majors'] as $major)
                                    <li>{{ $major }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- End Daftar Kepribadian -->

    </div>
@endsection

@push('scripts')
    <!-- Tambahkan script DataTables jika diperlukan -->
@endpush
