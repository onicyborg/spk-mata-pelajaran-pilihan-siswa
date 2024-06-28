@extends('layouts.master')

@section('title')
    Kelola Nilai Siswa
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Kelola Nilai Milik {{ $siswa->name }}</h3>
                <h6 class="op-7 mb-2">List Pelajaran Siswa</h6>
            </div>
        </div>

        <div class="table-responsive">
            <table id="siswaTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Keterangan</th>
                        <th>Nilai Siswa</th>
                        <th>Action</th>
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
                            <td>
                                @if ($nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first() != null)
                                    <!-- Tombol untuk update nilai -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateNilai{{ $no }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Modal untuk update nilai -->
                                    <div class="modal fade" id="updateNilai{{ $no }}" tabindex="-1"
                                        aria-labelledby="updateNilaiLabel{{ $no }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateNilaiLabel{{ $no }}">Update
                                                        Nilai Untuk
                                                        Pelajaran {{ $item->nama_mapel }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="/guru/update-nilai/{{ $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first()->id }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="user_id" value="{{ $siswa->id }}">
                                                        <div class="mb-3">
                                                            <label for="nilai{{ $no }}"
                                                                class="form-label">Nilai</label>
                                                            <input type="number" class="form-control"
                                                                id="nilai{{ $no }}" name="nilai"
                                                                value="{{ $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first() != null? $nilai->where('user_id', $siswa->id)->where('mata_pelajaran_id', $item->id)->first()->nilai: '' }}"
                                                                required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Tombol untuk input nilai baru -->
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#inputNilai{{ $no }}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <!-- Modal untuk input nilai baru -->
                                    <div class="modal fade" id="inputNilai{{ $no }}" tabindex="-1"
                                        aria-labelledby="inputNilaiLabel{{ $no }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="inputNilaiLabel{{ $no }}">Input
                                                        Nilai Baru Untuk Pelajaran {{ $item->nama_mapel }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/guru/input-nilai" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $siswa->id }}">
                                                        <input type="hidden" name="mata_pelajaran_id"
                                                            value="{{ $item->id }}">
                                                        <div class="mb-3">
                                                            <label for="nilai{{ $no }}"
                                                                class="form-label">Nilai</label>
                                                            <input type="number" class="form-control"
                                                                id="nilai{{ $no }}" name="nilai" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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
