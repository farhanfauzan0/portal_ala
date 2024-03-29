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
                                <h4>Import Excel Invoice</h4>
                            </div>
                        </div>
                        <form action="{{ route('invoice.import.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Pemesan</label>
                                        <input type="text" class="form-control" name="nama_pemesan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Perusahaan</label>
                                        <input type="text" class="form-control" name="perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Jenis</label>
                                        <select name="jenis" class="select2 form-control">
                                            <option value="ala">ALA</option>
                                            <option value="aza">AZA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama">Alamat Pemesan</label>
                                        <input type="text" class="form-control" name="alamat_pemesan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">File</label>
                                        <input type="file" class="form-control" name="file">
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <h4>New Invoice</h4>
                            </div>
                        </div>
                        <form action="{{ route('invoice.submit.post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Pemesan</label>
                                        <input type="text" class="form-control" name="nama_pemesan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Perusahaan</label>
                                        <input type="text" class="form-control" name="perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Alamat Pemesan</label>
                                        <input type="text" class="form-control" name="alamat_pemesan">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama">No Invoice</label>
                                        <input type="text" class="form-control" value="" id="no-inv" name="no_inv">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Jenis</label>
                                        <select name="jenis" class="select2 form-control jenis">
                                            <option value="ala">ALA</option>
                                            <option value="aza">AZA</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-arr col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="nama">Deskripsi</label>
                                                <input type="text" class="form-control" name="deskripsi[]">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="nama">Jumlah</label>
                                                <input type="text" class="form-control number-only jumlah-1 change-total" name="jumlah[]">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="nama">Harga/pcs</label>
                                                <input type="text" class="form-control number-money harga-pcs-1 change-total" name="harga_pcs[]">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="nama">Total Harga</label>
                                                <input type="text" readonly class="form-control total-harga-1 total-harga-hitung" name="total_harga[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <label class="add-seq" hidden>1</label>
                                    <a class="btn btn-info tombol-tambah">+</a>
                                </div>
                                <div class="col-3 offset-9">
                                    <div class="form-group">
                                        <label for="nama">Total</label>
                                        <input type="text" readonly class="form-control total-all" name="total_all">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>
@endsection

@section('js')
<script>
    $('.tombol-tambah').click(function() {
        var curr_seq = $('.add-seq').html()
        $('.add-seq').html(parseInt(curr_seq) + 1)

        $html =
            `
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="nama">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi[]">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="nama">Jumlah</label>
                        <input type="text" class="form-control number-only jumlah-${$('.add-seq').html()} change-total" name="jumlah[]">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="nama">Harga/pcs</label>
                        <input type="text" class="form-control number-money harga-pcs-${$('.add-seq').html()} change-total" name="harga_pcs[]">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="nama">Total Harga</label>
                        <input type="text" readonly class="form-control total-harga-hitung total-harga-${$('.add-seq').html()}" name="total_harga[]">
                    </div>
                </div>
            </div>
        `

        $('.form-arr').append($html)
        actionss()
        $('.number-only').mask('0#');
        $('.number-money').mask('000.000.000.000.000', {
            reverse: true
        });
    })

    function actionss() {

        $('.change-total').keyup(function() {
            var seq = $('.add-seq').html()
            var jumlah = ($(`.jumlah-${seq}`).val()) ? $(`.jumlah-${seq}`).val() : 0
            var harga_pcs = ($(`.harga-pcs-${seq}`).val()) ? $(`.harga-pcs-${seq}`).val().replace(/\./g, '') : 0


            var total_harga = jumlah * harga_pcs
            $(`.total-harga-${seq}`).val(new Intl.NumberFormat(['ban', 'id']).format(total_harga))
            var total_all = 0

            $(`.total-harga-hitung`).each(function(i) {
                total_all += ($(this).val()) ? parseInt($(this).val().replace(/\./g, '')) : 0
                // console.log(i)
            })

            $('.total-all').val(new Intl.NumberFormat(['ban', 'id']).format(total_all))
            // var total_all_format = ($(`.harga-pcs-${seq}`).val().replace(/\./g, '')) ? parseInt($(`.harga-pcs-${seq}`).val().replace(/\./g, '')) : 0


            // console.log(new Intl.NumberFormat(['ban', 'id']).format(total_all))
        })
    }

    function refresh_no_invoice() {
        var jenis = $(".jenis").find(":selected").text()
        const today = new Date();
        var jam = today.toLocaleDateString("en-US", {
            hour: "2-digit"
        })
        var hari = today.toLocaleDateString("en-US", {
            day: "2-digit"
        })
        var tahun = today.toLocaleDateString("en-US", {
            year: "numeric"
        })
        var bulan = today.toLocaleDateString("en-US", {
            month: "numeric"
        })

        var no_invoice = hari + "" + today.getHours() + "/" + jenis + "/" + "INVOICE/" + bulan + "/" + tahun
        $("#no-inv").val(no_invoice)
    }

    $(".jenis").change(function() {
        refresh_no_invoice()
    })

    $(document).ready(function() {
        actionss()
        refresh_no_invoice()
    })

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
