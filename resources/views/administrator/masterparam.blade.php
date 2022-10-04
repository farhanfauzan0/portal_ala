@extends('layout.master')

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <h4>Master Pesanan</h4>
                            </div>
                            <div class="col ml-auto">
                                <button class="btn btn-primary float-right ml-3 tombol-tambah-pesanan" type="button">+ Tambah</button>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datapesanan as $datapesanans)
                                <tr>
                                    <td>{{ $datapesanans->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteConfirmationpesanan({{ $datapesanans->id }})">Hapus</button>
                                        <button class="btn btn-sm btn-info button-edit-pesanan" data-id="{{ $datapesanans->id }}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <h4>Master Status</h4>
                            </div>
                            <div class="col ml-auto">
                                <button class="btn btn-primary float-right ml-3 tombol-tambah-status" type="button">+ Tambah</button>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datastatus as $datastatuss)
                                <tr>
                                    <td>{{ $datastatuss->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteConfirmationstatus({{ $datastatuss->id }})">Hapus</button>
                                        <button class="btn btn-sm btn-info button-edit-status" data-id="{{ $datastatuss->id }}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <h4>Master Deadline</h4>
                            </div>
                            <div class="col ml-auto">
                                <button class="btn btn-primary float-right ml-3 tombol-tambah-deadline" type="button">+ Tambah</button>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datadeadline as $datadeadlines)
                                <tr>
                                    <td>{{ $datadeadlines->tanggal }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteConfirmationdeadline({{ $datadeadlines->id }})">Hapus</button>
                                        <button class="btn btn-sm btn-info button-edit-deadline" data-id="{{ $datadeadlines->id }}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <h4>Master Journal</h4>
                            </div>
                            <div class="col ml-auto">
                                <button class="btn btn-primary float-right ml-3 tombol-tambah-journal" type="button">+ Tambah</button>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datajournal as $datajournals)
                                <tr>
                                    <td>{{ $datajournals->code }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteConfirmationjournal({{ $datajournals->id }})">Hapus</button>
                                        <button class="btn btn-sm btn-info button-edit-journal" data-id="{{ $datajournals->id }}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div class="modal fade modal-notif modal-slide modal-tambah-pesanan" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Master Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-pesanan" action="{{ route('master.add.pesanan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <div class="form-group">
                            <label for="nama">Pesanan</label>
                            <input type="text" class="form-control" name="pesanan" id="pesanan">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-tambah-pesanan').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-edit-pesanan" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Edit Master Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-pesanan" action="{{ route('master.update.pesanan') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <input name="id" class="id-edit-pesanan" hidden>
                        <div class="form-group">
                            <label for="pesanan">Pesanan</label>
                            <input type="text" class="form-control" name="pesanan" id="pesanan-edit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-edit-pesanan').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-tambah-status" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Master Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-status" action="{{ route('master.add.status') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <div class="form-group">
                            <label for="nama">Status</label>
                            <input type="text" class="form-control" name="status" id="status">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-tambah-status').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-edit-status" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Edit Master Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-status" action="{{ route('master.update.status') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <input name="id" class="id-edit-status" hidden>
                        <div class="form-group">
                            <label for="pesanan">Status</label>
                            <input type="text" class="form-control" name="status" id="status-edit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-edit-status').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-tambah-deadline" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Master Deadline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-deadline" action="{{ route('master.add.deadline') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <div class="form-group">
                            <label for="nama">Deadline</label>
                            <input type="text" class="form-control datepickers" name="deadline" id="deadline">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-tambah-deadline').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-edit-deadline" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Edit Master Deadline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-deadline" action="{{ route('master.update.deadline') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <input name="id" class="id-edit-deadline" hidden>
                        <div class="form-group">
                            <label for="pesanan">Deadline</label>
                            <input type="text" class="form-control datepickers" name="deadline" id="deadline-edit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-edit-deadline').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-tambah-journal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Master Journal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah-journal" action="{{ route('master.add.journal') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <div class="form-group">
                            <label for="nama">Code Journal</label>
                            <input type="text" class="form-control" name="journal" id="journal">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-tambah-journal').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-edit-journal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Edit Master Journal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-journal" action="{{ route('master.update.journal') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <input name="id" class="id-edit-journal" hidden>
                        <div class="form-group">
                            <label for="pesanan">Journal</label>
                            <input type="text" class="form-control" name="journal" id="journal-edit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-edit-journal').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    // $('.daterangepicker').prependTo('modal-tambah-deadline')

    $(function() {
        $("body").delegate(".datepickers", "focusin", function() {
            $(this).datepicker({
                autoclose: true
                , format: 'yyyy-mm-dd'
            });
        });
    });
    $('.tombol-tambah-pesanan').click(function() {
        $('.modal-tambah-pesanan').modal({
            'show': true
        })
    })
    $('.tombol-tambah-status').click(function() {
        $('.modal-tambah-status').modal({
            'show': true
        })
    })
    $('.tombol-tambah-deadline').click(function() {
        $('.modal-tambah-deadline').modal('show')
    })
    $('.tombol-tambah-journal').click(function() {
        $('.modal-tambah-journal').modal({
            'show': true
        })
    })

    $('.button-edit-pesanan').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('master.edit.pesanan') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {
            $('.id-edit-pesanan').val(data.id)
            $('#pesanan-edit').val(data.name)
            $('.modal-edit-pesanan').modal({
                'show': true
            })
        })
    })
    $('.button-edit-status').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('master.edit.status') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {
            $('.id-edit-status').val(data.id)
            $('#status-edit').val(data.name)
            $('.modal-edit-status').modal({
                'show': true
            })
        })
    })
    $('.button-edit-deadline').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('master.edit.deadline') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {
            $('.id-edit-deadline').val(data.id)
            $('#deadline-edit').val(data.tanggal)
            $('.modal-edit-deadline').modal({
                'show': true
            })
        })
    })
    $('.button-edit-journal').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('master.edit.journal') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {

            $('.id-edit-journal').val(data.id)
            $('#journal-edit').val(data.code)
            $('.modal-edit-journal').modal({
                'show': true
            })
        })
    })

    function deleteConfirmationpesanan(id) {
        Swal.fire({
            title: "Yakin ingin menghapus data ini?"
            , text: "jika terhapus tidak dapat dikembalikan."
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: "red"
            , confirmButtonText: "Ya"
            , cancelButtonText: "Tidak"
        , }).then(function(e) {
            if (e.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST'
                    , url: "{{ route('master.delete.pesanan') }}"
                    , data: {
                        id: id
                    }
                }).then(function(data) {
                    Swal.fire({
                        title: data.title
                        , text: data.text
                        , icon: data.icon
                    , }).then(function(e) {
                        if (e.isConfirmed) {
                            location.reload();
                        }
                    })
                })
            } else {
                location.reload();
            }
        });
    };

    function deleteConfirmationstatus(id) {
        Swal.fire({
            title: "Yakin ingin menghapus data ini?"
            , text: "jika terhapus tidak dapat dikembalikan."
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: "red"
            , confirmButtonText: "Ya"
            , cancelButtonText: "Tidak"
        , }).then(function(e) {
            if (e.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST'
                    , url: "{{ route('master.delete.status') }}"
                    , data: {
                        id: id
                    }
                }).then(function(data) {
                    Swal.fire({
                        title: data.title
                        , text: data.text
                        , icon: data.icon
                    , }).then(function(e) {
                        if (e.isConfirmed) {
                            location.reload();
                        }
                    })
                })
            } else {
                location.reload();
            }
        });
    };

    function deleteConfirmationdeadline(id) {
        Swal.fire({
            title: "Yakin ingin menghapus data ini?"
            , text: "jika terhapus tidak dapat dikembalikan."
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: "red"
            , confirmButtonText: "Ya"
            , cancelButtonText: "Tidak"
        , }).then(function(e) {
            if (e.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST'
                    , url: "{{ route('master.delete.deadline') }}"
                    , data: {
                        id: id
                    }
                }).then(function(data) {
                    Swal.fire({
                        title: data.title
                        , text: data.text
                        , icon: data.icon
                    , }).then(function(e) {
                        if (e.isConfirmed) {
                            location.reload();
                        }
                    })
                })
            } else {
                location.reload();
            }
        });
    };

    function deleteConfirmationjournal(id) {
        Swal.fire({
            title: "Yakin ingin menghapus data ini?"
            , text: "jika terhapus tidak dapat dikembalikan."
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: "red"
            , confirmButtonText: "Ya"
            , cancelButtonText: "Tidak"
        , }).then(function(e) {
            if (e.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST'
                    , url: "{{ route('master.delete.journal') }}"
                    , data: {
                        id: id
                    }
                }).then(function(data) {
                    Swal.fire({
                        title: data.title
                        , text: data.text
                        , icon: data.icon
                    , }).then(function(e) {
                        if (e.isConfirmed) {
                            location.reload();
                        }
                    })
                })
            } else {
                location.reload();
            }
        });
    };

</script>

@if (session('mysweet'))

<script>
    Swal.fire({
        title: "{{ session('title_a') }}"
        , text: "{{ session('text_a') }}"
        , icon: "{{ session('icon_a') }}"
    , }).then(function(e) {
        if (e.isConfirmed) {
            location.reload();
        }
    });

</script>
@endif
@endsection
