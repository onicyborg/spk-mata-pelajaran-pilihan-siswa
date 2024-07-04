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
                <h6 class="op-7 mb-2">List Siswa</h6>
            </div>
        </div>

        <div class="table-responsive">
            <table id="siswaTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Jurusan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->biodata != null ? $item->biodata->gender : '-' }}</td>
                            <td>{{ $item->biodata != null ? $item->biodata->jurusan : '-' }}</td>
                            <td>

                                <!-- Tombol untuk menghapus data diubah menjadi tag <a> -->
                                <a href="/guru/daftar-hasil-siswa/{{ $item->id }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-clipboard-check"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Tambahkan JS DataTables jika diperlukan -->
    <script>
        $(document).ready(function() {
            $('#siswaTable').DataTable();
        });
    </script>
@endpush
