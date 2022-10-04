<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ file_get_contents(public_path('css/app-light.css')) }}" id="lightTheme">

    <style>
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        body {
            margin-top: 3cm;
            margin-left: 0.2cm;
            margin-right: 0.2cm;
            margin-bottom: 2cm;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
        }

        .page-break {
            page-break-after: always;
        }

        .page-break:last-child {
            page-break-after: avoid;
        }

    </style>
</head>
<body>
    <header>
        <div style="text-align: center">
            <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path("$data->header"))) }}" width="700" height="120" />
        </div>
    </header>

    <div class="row">
        <div class="col-12 text-center" style="text-align: center">
            <h3>INVOICE</h3>
            <h6>NO. {{ $request['no_inv'] }}</h6>
        </div>
        <div class="col-12">
            <h4 class="text-left">Telah diterima dari:</h4>
            <h6>{{ $request['perusahaan'] }}</h6>
        </div>
    </div>
    <div class="row text-center">
        <table class="table table-striped" style="border-collapse: collapse; width: 100%; height: 87px;" border="1">
            <thead class="thead-dark">
                <tr style="background-color: rgb(236, 236, 236)">
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Harga Per/pcs</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($request['deskripsi'] as $key => $datas)
                <tr>
                    <td style="height: 50px">{{ $request['deskripsi'][$key] }}</td>
                    <td>{{ $request['jumlah'][$key] }}</td>
                    <td>{{ $request['harga_pcs'][$key] }}</td>
                    <td>{{ $request['total_harga'][$key] }}</td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{ $request['total_all'] }}</td>
                </tr>
                <tr>
                    <td colspan="4">Terbilang</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    <br>
    <br>
    <table class="table table-striped" style="border-collapse: collapse; width: 300px; height: 87px;">
        <tbody>
            <tr>
                <td colspan="3"><label>Pembayaran dapat ditransfer ke:</label></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td style="text-align: right">:</td>
                <td style="text-align: left">TEST</td>
            </tr>
            <tr>
                <td>Nomor Rekening</td>
                <td style="text-align: right">:</td>
                <td style="text-align: left">12321431432</td>
            </tr>
            <tr>
                <td>Bank</td>
                <td style="text-align: right">:</td>
                <td style="text-align: left">BNI</td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>
    <label>Demikian informasi ini kami sampaikan.</label>
    <p>Hormat Kami,</p>
    <p><b>CV. Anka Ziva Alleasha</b></p>
    <br>
    <br>
    <br>
    <br>
    <p><b>Heldini Safitri</b></p>
    <footer>
        <div style="text-align: center">
            <img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path("$data->footer"))) }}" width="700" height="120" />
        </div>
    </footer>
</body>
</html>
