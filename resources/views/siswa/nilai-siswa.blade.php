@extends('layouts.master')

@section('title')
    Nilai Anda
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Nilai</h3>
                <h6 class="op-7 mb-2">List Nilai Anda Berdasarkan Mata Pelajaran</h6>
            </div>
        </div>

        <div class="table-responsive">
            <table id="siswaTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Keterangan Mata Pelajaran</th>
                        <th>Nilai Anda</th>
                        <th>Kriteria ketuntasan minimal (KKM)</th>
                        <th>Keterangan Nilai Anda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $item->nama_mapel }}</td>
                            <td>{{ $item->keterangan ? $item->keterangan : '-' }}</td>
                            <td>{{ $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first() != null? $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first()->nilai: '-' }}
                            </td>
                            <td>70</td>
                            <td>{{ $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first() != null && $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first()->keterangan != null ? $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first()->keterangan : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
