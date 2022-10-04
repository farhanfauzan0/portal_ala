@extends('layout.master')

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <h4>Order List</h4>
                            </div>
                            <div class="col ml-auto">
                                <button class="btn btn-primary float-right ml-3 tombol-tambah" type="button">+ Tambah</button>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Pemesan</th>
                                    <th>Pesanan</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Status</th>
                                    <th>Deadline</th>
                                    <th>Omset</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                <tr>
                                    <td>{{ $datas->pemesan }}</td>
                                    <td>{{ $datas->pesanan }}</td>
                                    <td>{{ $datas->jumlah_pesanan }}</td>
                                    <td>{{ $datas->status }}</td>
                                    <td>{{ \Carbon\Carbon::parse($datas->deadline)->format('Y-m-d') }}</td>
                                    <td>{{ $datas->omset }}</td>
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
                    <h5 class="modal-title" id="defaultModalLabel">Order Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah" action="{{ route('order.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <div class="form-group">
                            <label for="nama">Pemesan</label>
                            <input type="text" class="form-control" name="pemesan" id="pemesan">
                        </div>
                        <div class="form-group">
                            <label for="nama">Pesanan</label>
                            <select name="pesanan" class="select2 form-control">
                                @foreach ($datapesanan as $datapesanans)
                                <option value="{{ $datapesanans->name }}">{{ $datapesanans->name }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumlah Pesanan</label>
                            <input type="text" class="form-control number-only" name="jumlah_pesanan" id="jumlah_pesanan">
                        </div>
                        <div class="form-group">
                            <label for="nama">Status</label>
                            <select name="status" class="select2 form-control">
                                @foreach ($datastatus as $datastatuss)
                                <option value="{{ $datastatuss->name }}">{{ $datastatuss->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Deadline</label>
                            <select name="deadline" class="select2 form-control">
                                @foreach ($datadeadline as $datadeadlines)
                                <option value="{{ $datadeadlines->tanggal }}">{{ $datadeadlines->tanggal }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Omset</label>
                            <input type="text" class="form-control number-money" name="omset" id="omset">
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
                    <form id="form-edit" action="{{ route('order.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input name="type" value="{{ $type }}" hidden> --}}
                        <input name="id" class="id-edit" hidden>
                        <div class="form-group">
                            <label for="nama">Pemesan</label>
                            <input type="text" class="form-control" name="pemesan" id="pemesan-edit">
                        </div>
                        <div class="form-group">
                            <label for="nama">Pesanan</label>
                            <select name="pesanan" class="select2 form-control" id="pesanan-edit">
                                @foreach ($datapesanan as $datapesanans)
                                <option value="{{ $datapesanans->name }}">{{ $datapesanans->name }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="pesanan" id="pesanan"> --}}
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumlah Pesanan</label>
                            <input type="text" class="form-control number-only" name="jumlah_pesanan" id="jumlah-pesanan-edit">
                        </div>
                        <div class="form-group">
                            <label for="nama">Status</label>
                            <select name="status" class="select2 form-control" id="status-edit">
                                @foreach ($datastatus as $datastatuss)
                                <option value="{{ $datastatuss->name }}">{{ $datastatuss->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Deadline</label>
                            <select name="deadline" class="select2 form-control" id="deadline-edit">
                                @foreach ($datadeadline as $datadeadlines)
                                <option value="{{ $datadeadlines->tanggal }}">{{ $datadeadlines->tanggal }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Omset</label>
                            <input type="text" class="form-control number-money" name="omset" id="omset-edit">
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
    $('.tombol-tambah').click(function() {
        $('.modal-tambah').modal({
            'show': true
        })
    })

    $('.button-edit').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('order.edit') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {
            console.log($.format.date(data.deadline, 'yyyy-mm-dd'))
            $('.id-edit').val(data.id)
            $('#pemesan-edit').val(data.pemesan)
            $('#pesanan-edit').val(data.pesanan)
            $('#jumlah-pesanan-edit').val(data.jumlah_pesanan)
            $('#status-edit').val(data.status)
            $('#deadline-edit').val($.format.date(data.deadline, 'yyyy-MM-dd'))
            $('#omset-edit').val(data.omset)
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
                    , url: "{{ route('order.delete') }}"
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
