@extends('layout.master')

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('journal.index') }}" method="GET">
                            <div class="toolbar row mb-3">
                                <div class="col-2">
                                    <h4>List Jurnal</h4>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepickers" name="tanggal_dari">
                                        {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                                    </div>
                                </div>
                                -
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepickers" name="tanggal_ke">
                                        {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary float-right ml-3" type="submit">Search</button>
                                </div>
                                <div class="col-2">
                                    <a class="btn btn-primary float-right ml-3" href="{{ route('journal.index') }}">Clear Filter</a>
                                </div>
                                <div class="col-2 ml-auto">
                                    <button class="btn btn-primary float-right ml-3 tombol-tambah" type="button">+ Tambah</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode</th>
                                    <th>Detail</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('Y-m-d') }}</td>
                                    <td>{{ $datas->code }}</td>
                                    <td>{{ $datas->detail }}</td>
                                    <td>{{ number_format($datas->debit) }}</td>
                                    <td>{{ number_format($datas->credit) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteConfirmation({{ $datas->id }})">Hapus</button>
                                        <button class="btn btn-sm btn-info button-edit" data-id="{{ $datas->id }}">Edit</button>
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
    <div class="modal fade modal-notif modal-slide modal-tambah" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Jurnal Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah" action="{{ route('journal.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <div class="form-group">
                            <label for="nama">Tanggal</label>
                            <input type="text" class="form-control datepickers" name="tanggal" id="tanggal">
                            {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                        </div>
                        <div class="form-group">
                            <label for="nama">Code</label>
                            <select name="code" class="select2 form-control">
                                @foreach ($datacode as $datacodes)
                                <option value="{{ $datacodes->code }}">{{ $datacodes->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Detail</label>
                            <input type="text" class="form-control" name="detail" id="detail">
                            {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                        </div>
                        <div class="form-group">
                            <label for="nama">Debit</label>
                            <input type="text" class="form-control number-money" name="debit" id="jumlah_pesanan">
                        </div>
                        <div class="form-group">
                            <label for="nama">Kredit</label>
                            <input type="text" class="form-control number-money" name="credit" id="jumlah_pesanan">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-tambah').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-edit" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" action="{{ route('journal.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <input name="id" class="id-edit" hidden>
                        <div class="form-group">
                            <label for="nama">Tanggal</label>
                            <input type="text" class="form-control datepickers" name="tanggal" id="tanggal-edit">
                            {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                        </div>
                        <div class="form-group">
                            <label for="nama">Code</label>
                            <select name="code" class="select2 form-control" id="code-edit">
                                @foreach ($datacode as $datacodes)
                                <option value="{{ $datacodes->code }}">{{ $datacodes->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Detail</label>
                            <input type="text" class="form-control" name="detail" id="detail-edit">
                            {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                        </div>
                        <div class="form-group">
                            <label for="nama">Debit</label>
                            <input type="text" class="form-control number-money" name="debit" id="debit-edit">
                        </div>
                        <div class="form-group">
                            <label for="nama">Kredit</label>
                            <input type="text" class="form-control number-money" name="credit" id="credit-edit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-edit').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $("body").delegate(".datepickers", "focusin", function() {
        $(this).datepicker({
            autoclose: true
            , format: 'yyyy-mm-dd'
        });
    });

    $('.tombol-tambah').click(function() {
        $('.modal-tambah').modal({
            'show': true
        })
    })

    $('.button-edit').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('journal.edit') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {
            $('.id-edit').val(data.id)
            $('#detail-edit').val(data.detail)
            $('#tanggal-edit').val(data.tanggal)
            $('#debit-edit').val(data.debit)
            $('#credit-edit').val(data.credit)
            $('#code-edit').val(data.code)

            $('.modal-edit').modal({
                'show': true
            })
        })
    })

    function deleteConfirmation(id) {
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
                    , url: "{{ route('journal.delete') }}"
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
