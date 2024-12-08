<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .invoice-container {
            width: 100%;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>Struk Pemesanan</h1>
            <p>SUTENDI'S FOOD</p>
            <p>Jl. Cigombong Raya No. 13, Bogor</p>
        </div>

        <div class="info">
            <p><strong>Nama Pemesan:</strong> {{ $orders->name }}</p>
            <p><strong>Tanggal:</strong> {{ date('d-m-Y', strtotime($orders->created_at)) }}</p>
            <p><strong>ID Pesanan:</strong> {{ $orders->id }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Makanan</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $makanans = json_decode($orders->makanans, true);
                $totalHarga = 0;
                @endphp
                @foreach($makanans as $index => $makanan)
                    @php $totalHarga += $makanan['total_price']; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $makanan['name_makanan'] }}</td>
                        <td>{{ $makanan['qty'] }}</td>
                        <td>Rp {{ number_format($makanan['harga'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($makanan['total_price'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p><strong>Total Harga:</strong> Rp {{ number_format($totalHarga / 1.1, 0, ',', '.') }}</p>
            <p><strong>PPN (10%):</strong> Rp {{ number_format($totalHarga - ($totalHarga / 1.1), 0, ',', '.') }}</p>
            <p><strong>Total Pembayaran:</strong> Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
        </div>

        <div class="footer">
            <p>Terima kasih telah memesan di SUTENDI'S FOOD</p>
            <p>Semoga Anda puas dengan pelayanan kami!</p>
        </div>
    </div>
</body>
</html>
