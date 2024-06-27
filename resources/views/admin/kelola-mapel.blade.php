@extends('layouts.master')

@section('title')
    Kelola Data Mata Pelajaran
@endsection

@push('styles')
    <!-- Tambahkan CSS DataTables jika diperlukan -->
@endpush

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Kelola Data Mata Pelajaran</h3>
                <h6 class="op-7 mb-2">Master Data Mata Pelajaran</h6>
            </div>
            <div class="ms-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMataPelajaranModal">
                    <i class="fas fa-plus"></i> Add Data Mata Pelajaran
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="siswaTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $item->nama_mapel }}</td>
                            <td>{{ $item->keterangan == null ? '-' : $item->keterangan }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editMataPelajaranModal{{ $no }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteMataPelajaranModal{{ $no }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editMataPelajaranModal{{ $no }}" tabindex="-1"
                            aria-labelledby="editMataPelajaranModalLabel{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editMataPelajaranModalLabel{{ $no }}">Edit Data Mata Pelajaran
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/admin/update-mapel/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="nama_mapel{{ $no }}" class="form-label">Nama Mata
                                                    Pelajaran</label>
                                                <input type="text" class="form-control" value="{{ $item->nama_mapel }}"
                                                    id="nama_mapel{{ $no }}" name="nama_mapel"
                                                    placeholder="Nama Mata Pelajaran">
                                            </div>
                                            <div class="mb-3">
                                                <label for="keterangan{{ $no }}"
                                                    class="form-label">Keterangan</label>
                                                <textarea name="keterangan" class="form-control" id="keterangan{{ $no }}" cols="30" rows="10">{{ $item->keterangan }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteMataPelajaranModal{{ $no }}" tabindex="-1"
                            aria-labelledby="deleteMataPelajaranModalLabel{{ $no }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteMataPelajaranModalLabel{{ $no }}">Delete Data
                                            Mata Pelajaran</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="/admin/delete-mapel/{{ $item->id }}" method="post">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addMataPelajaranModal" tabindex="-1" aria-labelledby="addMataPelajaranModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMataPelajaranModalLabel">Add Data Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/admin/add-mapel" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel"
                                placeholder="Nama Mata Pelajaran">
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="10"></textarea>
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
