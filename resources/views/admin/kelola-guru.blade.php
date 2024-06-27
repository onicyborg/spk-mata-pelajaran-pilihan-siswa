@extends('layouts.master')

@section('title')
    Kelola Data Guru
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Kelola Data Guru</h3>
                <h6 class="op-7 mb-2">Master Data Guru</h6>
            </div>
            <div class="ms-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGuruModal">
                    <i class="fas fa-plus"></i> Add Data Guru
                </button>
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
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editGuruModal{{ $no }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteGuruModal{{ $no }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#resetPasswordModal{{ $no }}">
                                    <i class="fas fa-key"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editGuruModal{{ $no }}" tabindex="-1"
                            aria-labelledby="editGuruModalLabel{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editGuruModalLabel{{ $no }}">Edit Data Guru
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/update-guru/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="namaGuru{{ $no }}" class="form-label">Nama</label>
                                                <input type="text" class="form-control"
                                                    id="namaGuru{{ $no }}" name="name"
                                                    placeholder="Nama Guru" value="{{ $item->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="username{{ $no }}" class="form-label">NIP</label>
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
                        <div class="modal fade" id="deleteGuruModal{{ $no }}" tabindex="-1"
                            aria-labelledby="deleteGuruModalLabel{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteGuruModalLabel{{ $no }}">Delete Data
                                            Guru</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/delete-guru/{{ $item->id }}" method="post">
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
                                        <form action="/admin/reset-password-guru/{{ $item->id }}" method="POST">
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
    <div class="modal fade" id="addGuruModal" tabindex="-1" aria-labelledby="addGuruModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGuruModalLabel">Add Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/add-guru" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="namaGuru" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="namaGuru" name="name"
                                placeholder="Nama Guru" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">NIP</label>
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
