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
                <h3 class="fw-bold mb-3">Kelola Data Siswa</h3>
                <h6 class="op-7 mb-2">Master Data Siswa</h6>
            </div>
            <div class="ms-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSiswaModal">
                    <i class="fas fa-plus"></i> Add Data Siswa
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="siswaTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
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
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->biodata != null ? $item->biodata->gender : '-' }}</td>
                            <td>{{ $item->biodata != null ? $item->biodata->jurusan : '-' }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editSiswaModal{{ $no }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteSiswaModal{{ $no }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#resetPasswordModal{{ $no }}">
                                    <i class="fas fa-key"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editSiswaModal{{ $no }}" tabindex="-1"
                            aria-labelledby="editSiswaModalLabel{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSiswaModalLabel{{ $no }}">Edit Data Siswa
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/update-siswa/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="namaSiswa{{ $no }}" class="form-label">Nama</label>
                                                <input type="text" class="form-control"
                                                    id="namaSiswa{{ $no }}" name="name"
                                                    placeholder="Nama Siswa" value="{{ $item->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username{{ $no }}" class="form-label">NISN</label>
                                                <input type="number" class="form-control" id="username{{ $no }}"
                                                    name="username" placeholder="12345" value="{{ $item->username }}"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="gender{{ $no }}" class="form-label">Gender</label>
                                                <select class="form-control" id="gender{{ $no }}" name="gender"
                                                    required>
                                                    <option selected disabled hidden>- Pilih Gender -</option>
                                                    <option value="Pria"
                                                        {{ $item->biodata != null && $item->biodata->gender == 'Pria' ? 'selected' : '' }}>
                                                        Pria</option>
                                                    <option value="Wanita"
                                                        {{ $item->biodata != null && $item->biodata->gender == 'Wanita' ? 'selected' : '' }}>
                                                        Wanita</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jurusan{{ $no }}" class="form-label">Jurusan</label>
                                                <select class="form-control" id="jurusan{{ $no }}" name="jurusan"
                                                    required>
                                                    <option selected disabled hidden>- Pilih Jurusan -</option>
                                                    <option value="Soshum"
                                                        {{ $item->biodata != null && $item->biodata->jurusan == 'Soshum' ? 'selected' : '' }}>
                                                        Soshum</option>
                                                    <option value="IPA Teknik"
                                                        {{ $item->biodata != null && $item->biodata->jurusan == 'IPA Teknik' ? 'selected' : '' }}>
                                                        IPA Teknik</option>
                                                    <option value="IPA Kesehatan"
                                                        {{ $item->biodata != null && $item->biodata->jurusan == 'IPA Kesehatan' ? 'selected' : '' }}>
                                                        IPA Kesehatan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kelas{{ $no }}" class="form-label">Kelas</label>
                                                <select class="form-control" id="kelas{{ $no }}" name="kelas"
                                                    required>
                                                    <option selected disabled hidden>- Pilih Kelas -</option>
                                                    <option value="X (Sepuluh)"
                                                        {{ $item->biodata != null && $item->biodata->kelas == 'X (Sepuluh)' ? 'selected' : '' }}>
                                                        X (Sepuluh)</option>
                                                    <option value="XI (Sebelas)"
                                                        {{ $item->biodata != null && $item->biodata->kelas == 'XI (Sebelas)' ? 'selected' : '' }}>
                                                        XI (Sebelas)</option>
                                                    <option value="XII (Dua Belas)"
                                                        {{ $item->biodata != null && $item->biodata->kelas == 'XII (Dua Belas)' ? 'selected' : '' }}>
                                                        XII (Dua Belas)</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mapel_fav{{ $no }}" class="form-label">Mata Pelajaran
                                                    Yang
                                                    Disukai</label>
                                                <select class="form-control" id="kelas{{ $no }}"
                                                    name="mapel_fav">
                                                    <option selected disabled hidden>- Pilih Mata Pelajaran -</option>
                                                    @foreach ($mapel as $i)
                                                        <option value="{{ $i->id }}"
                                                            {{ $item->biodata != null && $item->biodata->mapel_fav == $i->id ? 'selected' : '' }}>
                                                            {{ $i->nama_mapel }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tempat_lahir{{ $no }}" class="form-label">Tempat
                                                    Lahir</label>
                                                <input type="text" class="form-control"
                                                    id="tempat_lahir{{ $no }}" name="tempat_lahir"
                                                    placeholder="Tempat Lahir"
                                                    value="{{ $item->biodata != null ? $item->biodata->tempat_lahir : '' }}"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_lahir{{ $no }}" class="form-label">Tanggal
                                                    Lahir</label>
                                                <input type="date" class="form-control"
                                                    id="tanggal_lahir{{ $no }}" name="tanggal_lahir"
                                                    value="{{ $item->biodata != null ? $item->biodata->tanggal_lahir : '' }}"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email{{ $no }}" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email{{ $no }}"
                                                    name="email" placeholder="siswa@example.com"
                                                    value="{{ $item->biodata != null ? $item->biodata->email : '' }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="no_hp{{ $no }}" class="form-label">Nomor
                                                    Handphone</label>
                                                <input type="text" class="form-control" id="no_hp{{ $no }}"
                                                    name="no_hp" placeholder="+62813...."
                                                    value="{{ $item->biodata != null ? $item->biodata->no_hp : '' }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteSiswaModal{{ $no }}" tabindex="-1"
                            aria-labelledby="deleteSiswaModalLabel{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteSiswaModalLabel{{ $no }}">Delete Data
                                            Siswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/delete-siswa/{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Reset Password -->
                        <div class="modal fade" id="resetPasswordModal{{ $no }}" tabindex="-1"
                            aria-labelledby="resetPasswordModalLabel{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resetPasswordModalLabel{{ $no }}">Reset
                                            Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin mereset password siswa ini? password akan sama dengan nim siswa setelah di reset
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/reset-password-siswa/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-info">Reset Password</button>
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
                    <form action="/admin/add-siswa" method="POST">
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
