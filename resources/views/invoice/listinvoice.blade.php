@extends('layout.master')

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Perusahaan</th>
                                    <th>Alamat</th>
                                    <th>Tanggal</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                <tr>
                                    <td>{{ $datas->no_invoice }}</td>
                                    <td>{{ $datas->jenis }}</td>
                                    <td>{{ $datas->nama_pemesan }}</td>
                                    <td>{{ $datas->perusahaan }}</td>
                                    <td>{{ $datas->alamat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('Y-m-d') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteConfirmation('{{ $datas->no_invoice }}')">Hapus</button>
                                        <button class="btn btn-sm btn-info button-detail" data-id="{{ $datas->no_invoice }}">Detail</button>
                                        <a class="btn btn-sm btn-success" target="_blank" href="/invoice/cetak/invoice?invoice={{ $datas->no_invoice }}">Cetak</a>
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

    <div class="modal fade modal-edit" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Detail Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body body-detail">

                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" onclick="document.getElementById('form-edit').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button> --}}
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



    $('.button-detail').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('invoice.detail') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {
            $('.body-detail').html(data)

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
                    , url: "{{ route('invoice.delete') }}"
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
