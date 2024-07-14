@extends('layouts.master')

@section('title')
    Dashboard Siswa
@endsection

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-center flex-column pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 text-center">Dashboard Siswa</h3>
                <h6 class="op-7 mb-2 text-center">Selamat datang, {{ Auth::user()->name }}</h6>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">SMA Negeri 2 Bojonegoro</h4>
                        <center><img src="{{ asset('assets/img/sman2.png') }}" alt="Logo SMA Negeri 2 Bojonegoro" class="img-fluid my-3" style="width: 150px;"></center>
                        <p><strong>Alamat:</strong> Jl. HOS Cokroaminoto No. 09, Ledok Wetan, Kecamatan Bojonegoro, Kabupaten Bojonegoro, Jawa Timur.</p>
                        <p><strong>Akreditasi:</strong> A</p>
                        <p>SMA Negeri 2 Bojonegoro, yang dikenal dengan sebutan SMADA Bojonegoro, adalah salah satu sekolah menengah atas negeri terkemuka di Kabupaten Bojonegoro, Jawa Timur. Sekolah ini memiliki akreditasi A dari Badan Akreditasi Nasional dengan nilai 93, yang menunjukkan kualitas pendidikan yang tinggi.</p>
                        <p>Sekolah ini dilengkapi dengan berbagai fasilitas seperti 25 ruang kelas, laboratorium biologi, kimia, fisika, bahasa, dan komputer, serta perpustakaan. SMAN 2 Bojonegoro juga telah meraih berbagai prestasi di tingkat kabupaten dan nasional, antara lain:</p>
                        <ul class="text-left">
                            <li>Juara 3 Vokal Solo tingkat kabupaten</li>
                            <li>Juara 2 MTQ Putra tingkat kabupaten</li>
                            <li>Juara 1 Jambore UKS tingkat kabupaten</li>
                            <li>Juara 3 Bola Basket PORSENI tingkat kabupaten</li>
                        </ul>
                        <p>Untuk informasi lebih lanjut, Anda dapat mengunjungi <a href="http://www.sma2bojonegoro.sch.id">situs resmi sekolah</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if ($errors->any())
        <script>
            swal({
                title: "Error!",
                text: "{{ implode(', ', $errors->all()) }}",
                icon: "error",
                buttons: {
                    confirm: {
                        text: "Ok",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true,
                    },
                },
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            swal({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                buttons: {
                    confirm: {
                        text: "Ok",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true,
                    },
                },
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            swal({
                title: "Sukses!",
                text: "{{ session('success') }}",
                icon: "success",
                buttons: {
                    confirm: {
                        text: "Ok",
                        value: true,
                        visible: true,
                        className: "btn btn-success",
                        closeModal: true,
                    },
                },
            });
        </script>
    @endif
@endpush
