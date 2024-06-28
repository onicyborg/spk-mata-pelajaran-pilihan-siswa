@extends('layouts.master')

@section('title')
    Kelola Data Siswa
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Kelola Nilai Siswa</h3>
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
                                <!-- Tombol untuk melihat data -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#lihatData{{ $no }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <!-- Tombol untuk menghapus data diubah menjadi tag <a> -->
                                <a href="/guru/penilaian-siswa/{{ $item->id }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-clipboard-check"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="lihatData{{ $no }}" tabindex="-1"
                            aria-labelledby="lihatData{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="lihatData{{ $no }}">Lihat Data
                                            Siswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="namaSiswa{{ $no }}"
                                                        class="form-label">Nama</label>
                                                    <input type="text" class="form-control"
                                                        id="namaSiswa{{ $no }}" name="name"
                                                        value="{{ $item->name }}" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="username{{ $no }}"
                                                        class="form-label">NISN</label>
                                                    <input type="number" class="form-control"
                                                        id="username{{ $no }}" name="username"
                                                        value="{{ $item->username }}" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="gender{{ $no }}"
                                                        class="form-label">Gender</label>
                                                    <input type="text" class="form-control"
                                                        id="gender{{ $no }}" name="gender"
                                                        value="{{ $item->biodata != null ? $item->biodata->gender : '' }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="jurusan{{ $no }}"
                                                        class="form-label">Jurusan</label>
                                                    <input type="text" class="form-control"
                                                        id="jurusan{{ $no }}" name="jurusan"
                                                        value="{{ $item->biodata != null ? $item->biodata->jurusan : '' }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="kelas{{ $no }}" class="form-label">Kelas</label>
                                                    <input type="text" class="form-control"
                                                        id="kelas{{ $no }}" name="kelas"
                                                        value="{{ $item->biodata != null ? $item->biodata->kelas : '' }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mapel_fav{{ $no }}" class="form-label">Mata
                                                        Pelajaran Yang Disukai</label>
                                                    <input type="text" class="form-control"
                                                        id="mapel_fav{{ $no }}" name="mapel_fav"
                                                        value="{{ $item->biodata != null && $item->biodata->mapel_fav != null ? $mapel->where('id', $item->biodata->mapel_fav)->first()->nama_mapel : '' }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="tempat_lahir{{ $no }}" class="form-label">Tempat
                                                        Lahir</label>
                                                    <input type="text" class="form-control"
                                                        id="tempat_lahir{{ $no }}" name="tempat_lahir"
                                                        value="{{ $item->biodata != null ? $item->biodata->tempat_lahir : '' }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tanggal_lahir{{ $no }}"
                                                        class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control"
                                                        id="tanggal_lahir{{ $no }}" name="tanggal_lahir"
                                                        value="{{ $item->biodata != null ? $item->biodata->tanggal_lahir : '' }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="email{{ $no }}" class="form-label">Email</label>
                                                    <input type="email" class="form-control"
                                                        id="email{{ $no }}" name="email"
                                                        value="{{ $item->biodata != null ? $item->biodata->email : '' }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="no_hp{{ $no }}" class="form-label">Nomor
                                                        Handphone</label>
                                                    <input type="text" class="form-control"
                                                        id="no_hp{{ $no }}" name="no_hp"
                                                        value="{{ $item->biodata != null ? $item->biodata->no_hp : '' }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addSiswaModal" tabindex="-1" aria-labelledby="addSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSiswaModalLabel">Add Data Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/guru/add-siswa" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="namaSiswa" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="namaSiswa" name="name"
                                placeholder="Nama Siswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">NISN</label>
                            <input type="number" class="form-control" id="username" name="username"
                                placeholder="12345" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option selected disabled hidden>- Pilih Gender -</option>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan" required>
                                <option selected disabled hidden>- Pilih Jurusan -</option>
                                <option value="Soshum">Soshum</option>
                                <option value="IPA Teknik">IPA Teknik</option>
                                <option value="IPA Kesehatan">IPA Kesehatan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas" required>
                                <option selected disabled hidden>- Pilih Kelas -</option>
                                <option value="X (Sepuluh)">X (Sepuluh)</option>
                                <option value="XI (Sebelas)">XI (Sebelas)</option>
                                <option value="XII (Dua Belas)">XII (Dua Belas)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mapel_fav" class="form-label">Mata Pelajaran Yang Disukai</label>
                            <select class="form-control" id="kelas" name="mapel_fav">
                                <option selected disabled hidden>- Pilih Mata Pelajaran -</option>
                                @foreach ($mapel as $i)
                                    <option value="{{ $i->id }}">{{ $i->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                placeholder="Tempat Lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="siswa@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                placeholder="+62813....">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Data</button>
                    </form>
                </div>
            </div>
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
