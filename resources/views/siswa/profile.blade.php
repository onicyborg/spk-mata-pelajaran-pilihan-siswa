@extends('layouts.master')

@section('title')
    Kelola Profile
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Kelola Profile</h3>
                <h6 class="op-7 mb-2">Profile Anda</h6>
            </div>
        </div>

        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-4 text-center p-4 d-flex flex-column align-items-center">
                    @if (Auth::user()->profile == null)
                        <img src="{{ asset('assets/img/profile.jpg') }}" class="img-fluid rounded-circle mb-3"
                            style="max-width: 200px; max-height: 200px;" alt="Foto Profil">
                    @else
                        <img src="{{ asset('storage/profile/' . Auth::user()->profile) }}"
                            class="img-fluid rounded-circle mb-3" style="max-width: 200px; max-height: 200px;"
                            alt="Foto Profil">
                    @endif

                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#updateFotoModal">
                        Update Foto Profil
                    </button>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Nama: {{ $siswa->name }}</h5>
                        <p class="card-text mt-2">NISN: {{ $siswa->username }}</p>
                        <p class="card-text">Kelas: {{ $siswa->biodata ? $siswa->biodata->kelas : '-' }}</p>
                        <p class="card-text">Gender: {{ $siswa->biodata ? $siswa->biodata->gender : '-' }}</p>
                        <p class="card-text">Tempat Lahir: {{ $siswa->biodata ? $siswa->biodata->tempat_lahir : '-' }}</p>
                        <p class="card-text">Tanggal Lahir: {{ $siswa->biodata ? $siswa->biodata->tanggal_lahir : '-' }}</p>
                        <p class="card-text">Email: {{ $siswa->biodata ? $siswa->biodata->email : '-' }}</p>
                        <p class="card-text">No. Handphone: {{ $siswa->biodata ? $siswa->biodata->no_hp : '-' }}</p>
                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateDataModal">
                                Update Data
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                                Ubah Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Foto Profil -->
    <div class="modal fade" id="updateFotoModal" tabindex="-1" aria-labelledby="updateFotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFotoModalLabel">Update Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update-foto-profile" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="foto" class="form-label">Pilih Foto</label>
                            <input type="file" class="form-control" id="foto" name="avatar" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Foto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Data -->
    <div class="modal fade" id="updateDataModal" tabindex="-1" aria-labelledby="updateDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDataModalLabel">Update Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update-profile" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="namaGuru" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="namaGuru" name="name"
                                value="{{ $siswa->name }}" placeholder="Nama Guru" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">NIP</label>
                            <input type="number" class="form-control" id="username" name="username"
                                value="{{ $siswa->username }}" placeholder="12345" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option {{ $siswa->biodata && $siswa->gender != null ? '' : 'selected' }} disabled hidden>-
                                    Pilih Gender -</option>
                                <option value="Pria"
                                    {{ $siswa->biodata && $siswa->biodata->gender == 'Pria' ? 'selected' : '' }}>Pria
                                </option>
                                <option value="Wanita"
                                    {{ $siswa->biodata && $siswa->biodata->gender == 'Wanita' ? 'selected' : '' }}>Wanita
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas"
                                value="{{ $siswa->biodata ? $siswa->biodata->kelas : '' }}" name="kelas"
                                placeholder="Kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir"
                                value="{{ $siswa->biodata ? $siswa->biodata->tempat_lahir : '' }}" name="tempat_lahir"
                                placeholder="Tempat Lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir"
                                value="{{ $siswa->biodata ? $siswa->biodata->tanggal_lahir : '' }}" name="tanggal_lahir"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                value="{{ $siswa->biodata ? $siswa->biodata->email : '' }}" name="email"
                                placeholder="siswa@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="no_hp"
                                value="{{ $siswa->biodata ? $siswa->biodata->no_hp : '' }}" name="no_hp"
                                placeholder="+62813....">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Reset Password -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/ubah-password" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
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
