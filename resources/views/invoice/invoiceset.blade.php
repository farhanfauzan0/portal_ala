@extends('layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.css') }}">
{{-- <link type="text/css" rel="stylesheet" href="{{ asset('summernote/summernote.min.css') }}"> --}}

@endsection

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h4 page-title text-center">Setting ALA</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                @foreach ($data as $datas)
                                @if($datas->type == 'ala')

                                <form action="{{ route('invoice.setting.bank.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input name="type" hidden value="ala">
                                    <div class="row">

                                        <div class="form-group mb-3 col-4">

                                            <label for="simpleinput">Nama Rekening</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input class="form-control" type="text" name="nama_rekening" value="{{ $datas->nama_rekening }}">


                                        </div>
                                        <div class="form-group mb-3  col-4">

                                            <label for="simpleinput">Nomor Rekening</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input class="form-control" type="text" name="nomor_rekening" value="{{ $datas->nomor_rekening }}">


                                        </div>
                                        <div class="form-group mb-3  col-4">

                                            <label for="simpleinput">Bank</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input class="form-control" type="text" name="bank" value="{{ $datas->bank }}">


                                        </div>
                                        <div class="col-12 p-0 text-center">
                                            <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @endforeach

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                @foreach ($data as $datas)
                                @if($datas->type == 'ala')
                                <div class="text-center">
                                    <img height="200" width="800" src="{{ asset("$datas->header") }}">
                                </div>
                                @endif
                                @endforeach
                                <form action="{{ route('invoice.setting.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input name="type" hidden value="ala">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Header</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input type="file" name="file_header">

                                        </div>
                                    </div>
                                    <div class="col-12 p-0 text-right">
                                        <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                    </div>
                                </form>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- ./col -->
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                @foreach ($data as $datas)
                                @if($datas->type == 'ala')
                                <div class="text-center">
                                    <img height="200" width="800" src="{{ asset("$datas->footer") }}">
                                </div>
                                @endif
                                @endforeach
                                <form action="{{ route('invoice.setting.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input name="type" hidden value="ala">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Footer</label>
                                            {{-- <textarea class="summernote" name="footer"></textarea> --}}
                                            <input type="file" name="file_footer">

                                        </div>
                                    </div>
                                    <div class="col-12 p-0 text-right">
                                        <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                    </div>
                                </form>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- ./col -->

                </div> <!-- end section -->
            </div>
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h4 page-title text-center">Setting AZA</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                @foreach ($data as $datas)
                                @if($datas->type == 'aza')

                                <form action="{{ route('invoice.setting.bank.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input name="type" hidden value="aza">
                                    <div class="row">

                                        <div class="form-group mb-3 col-4">

                                            <label for="simpleinput">Nama Rekening</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input class="form-control" type="text" name="nama_rekening" value="{{ $datas->nama_rekening }}">


                                        </div>
                                        <div class="form-group mb-3  col-4">

                                            <label for="simpleinput">Nomor Rekening</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input class="form-control" type="text" name="nomor_rekening" value="{{ $datas->nomor_rekening }}">


                                        </div>
                                        <div class="form-group mb-3  col-4">

                                            <label for="simpleinput">Bank</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input class="form-control" type="text" name="bank" value="{{ $datas->bank }}">


                                        </div>
                                        <div class="col-12 p-0 text-center">
                                            <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                                @endforeach

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                @foreach ($data as $datas)
                                @if($datas->type == 'aza')
                                <div class="text-center">
                                    <img height="200" width="800" src="{{ asset("$datas->header") }}">
                                </div>
                                @endif
                                @endforeach
                                <form action="{{ route('invoice.setting.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input name="type" hidden value="aza">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Header</label>
                                            {{-- <textarea class="summernote" name="header"></textarea> --}}
                                            <input type="file" name="file_header">

                                        </div>
                                    </div>
                                    <div class="col-12 p-0 text-right">
                                        <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                    </div>
                                </form>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- ./col -->
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                @foreach ($data as $datas)
                                @if($datas->type == 'aza')
                                <div class="text-center">
                                    <img height="200" width="800" src="{{ asset("$datas->footer") }}">
                                </div>
                                @endif
                                @endforeach
                                <form action="{{ route('invoice.setting.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input name="type" hidden value="aza">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Footer</label>
                                            {{-- <textarea class="summernote" name="footer"></textarea> --}}
                                            <input type="file" name="file_footer">

                                        </div>
                                    </div>
                                    <div class="col-12 p-0 text-right">
                                        <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                    </div>
                                </form>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- ./col -->

                </div> <!-- end section -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>
@endsection

@section('js')
{{-- <script type="text/javascript" src="{{ asset('summernote/summernote-bs4.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('summernote/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });

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
