@extends('layouts.master')

@section('title')
    Ketertarikan
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Ketertarikan</h3>
                <h6 class="op-7 mb-2">Jurusan dan mata pelajaran yang Anda sukai</h6>
            </div>
        </div>

        <!-- Current Interest -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Jurusan Saat Ini</h5>
                        @if (Auth::user()->biodata && Auth::user()->biodata->jurusan != null)
                            <span class="badge badge-success">{{ Auth::user()->biodata->jurusan }}</span>
                        @else
                            <span class="badge badge-danger">Belum Memilih Jurusan</span>
                        @endif
                        <br> <!-- Tambahkan baris ini untuk memberikan jarak antara badge dan tombol -->
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#editMajorModal">Ubah
                            Jurusan</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Mata Pelajaran yang Disukai</h5>
                        @if (Auth::user()->biodata != null && Auth::user()->biodata->mapel_fav != null)
                            <span
                                class="badge badge-success">{{ $mapel->where('id', Auth::user()->biodata->mapel_fav)->first()->nama_mapel }}</span>
                        @else
                            <span class="badge badge-danger">Belum Memilih Mata Pelajaran yang Disukai</span>
                        @endif
                        <br> <!-- Tambahkan baris ini untuk memberikan jarak antara badge dan tombol -->
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editSubjectsModal">Ubah
                            Mata Pelajaran</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Major Modal -->
    <div class="modal fade" id="editMajorModal" tabindex="-1" aria-labelledby="editMajorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMajorModalLabel">Ubah Jurusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/siswa/ubah-jurusan" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option @if (Auth::user()->biodata == null || Auth::user()->biodata->jurusan == null) selected @endif disabled hidden>- Pilih Jurusan -
                                </option>
                                <option value="Soshum"
                                    {{ Auth::user()->biodata != null && Auth::user()->biodata->jurusan == 'Soshum' ? 'selected' : '' }}>
                                    Soshum</option>
                                <option value="IPA Teknik"
                                    {{ Auth::user()->biodata != null && Auth::user()->biodata->jurusan == 'IPA Teknik' ? 'selected' : '' }}>
                                    IPA Teknik</option>
                                <option value="IPA Kesehatan"
                                    {{ Auth::user()->biodata != null && Auth::user()->biodata->jurusan == 'IPA Kesehatan' ? 'selected' : '' }}>
                                    IPA Kesehatan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Subjects Modal -->
    <div class="modal fade" id="editSubjectsModal" tabindex="-1" aria-labelledby="editSubjectsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubjectsModalLabel">Ubah Mata Pelajaran yang Disukai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/siswa/ubah-mapel-fav" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="mapel_fav" class="form-label">Mata Pelajaran yang Disukai</label>
                            <select class="form-control" id="mapel_fav" name="mapel_fav" required>
                                <option @if (Auth::user()->biodata == null || Auth::user()->biodata->mapel_fav == null) selected @endif disabled hidden>- Pilih Mata
                                    Pelajaran -</option>
                                @foreach ($mapel as $item)
                                    @if (
                                        $item->nama_mapel == 'IPA' ||
                                            $item->nama_mapel == 'Matematika' ||
                                            $item->nama_mapel == 'Informatika' ||
                                            $item->nama_mapel == 'IPS' ||
                                            $item->nama_mapel == 'Bahasa Indonesia')
                                        <option value="{{ $item->id }}"
                                            {{ Auth::user()->biodata != null && Auth::user()->biodata->mapel_fav == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_mapel }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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
