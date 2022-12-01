<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>No Invoice</th>
            <th>Deskripsi</th>
            <th>Qty</th>
            <th>Amount</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $datas)
        <tr>
            <td>{{ $datas->no_invoice }}</td>
            <td>{{ $datas->deskripsi }}</td>
            <td>{{ $datas->qty }}</td>
            <td>{{ number_format($datas->amount) }}</td>
            <td>{{ number_format($datas->total) }}</td>

        </tr>
        @endforeach
    </tbody>
</table>
