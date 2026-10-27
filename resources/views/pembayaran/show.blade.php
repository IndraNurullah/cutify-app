<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran CUTIFY</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 30px 16px;
            background: #101713;
            color: #f4f0e7;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 650px;
            margin: auto;
        }

        .card {
            background: #1b251e;
            border: 1px solid #354638;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 18px;
        }

        h1, h2 { margin-top: 0; }
        h1 { color: #d9b477; }
        .muted { color: #b9c2b9; }
        .price { color: #e0bd82; font-size: 27px; font-weight: bold; }

        .method {
            display: block;
            padding: 15px;
            margin: 12px 0;
            border: 1px solid #465849;
            border-radius: 10px;
            cursor: pointer;
        }

        .method input { margin-right: 10px; }

        button, .back {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            padding: 13px 18px;
            background: #d9b477;
            color: #172018;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .back {
            background: transparent;
            color: #e0bd82;
            border: 1px solid #596a5b;
            margin-left: 8px;
        }

        .alert {
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .success { background: #23452e; }
        .error { background: #592b2b; }
        .status { font-weight: bold; color: #e0bd82; }
    </style>
</head>
<body>
<div class="container">
    <h1>Pembayaran CUTIFY</h1>
    <p class="muted">Periksa detail booking sebelum melanjutkan.</p>

    @if (session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card">
        <h2>Detail booking</h2>

        <p>Layanan:
            <strong>{{ $booking->layanan->nama_layanan }}</strong>
        </p>

        <p>Barber:
            <strong>{{ $booking->barber->nama_barber }}</strong>
        </p>

        <p>Tanggal:
            <strong>{{ $booking->jadwal->tanggal }}</strong>
        </p>

        <p>Jam:
            <strong>
                {{ substr($booking->jadwal->jam_mulai, 0, 5) }}
                -
                {{ substr($booking->jadwal->jam_selesai, 0, 5) }}
            </strong>
        </p>

        <p>Total pembayaran</p>
        <div class="price">
            Rp{{ number_format($booking->total_harga, 0, ',', '.') }}
        </div>

        <p>Status booking:
            <span class="status">{{ ucfirst($booking->status) }}</span>
        </p>

        @if ($booking->pembayaran)
            <p>Status pembayaran:
                <span class="status">
                    {{ str_replace('_', ' ', ucfirst($booking->pembayaran->status_bayar)) }}
                </span>
            </p>
        @endif
    </div>

    @if (!$booking->pembayaran || !in_array(
        $booking->pembayaran->status_bayar,
        ['menunggu_verifikasi', 'berhasil']
    ))
        <div class="card">
            <h2>Pilih metode pembayaran</h2>

            <p class="muted">
                Pilih metode yang ingin digunakan. Ini masih simulasi;
                belum ada transaksi uang sungguhan.
            </p>

            <form method="POST"
                  action="{{ route('pembayaran.store', $booking->id) }}">
                @csrf

                <label class="method">
                    <input type="radio" name="metode" value="transfer_bank"
                        {{ old('metode', $booking->pembayaran->metode ?? '') === 'transfer_bank' ? 'checked' : '' }}
                        required>
                    Transfer bank
                </label>

                <label class="method">
                    <input type="radio" name="metode" value="qris"
                        {{ old('metode', $booking->pembayaran->metode ?? '') === 'qris' ? 'checked' : '' }}>
                    QRIS (simulasi)
                </label>

                <label class="method">
                    <input type="radio" name="metode" value="tunai"
                        {{ old('metode', $booking->pembayaran->metode ?? '') === 'tunai' ? 'checked' : '' }}>
                    Tunai di barbershop
                </label>

                <button type="submit">Konfirmasi pembayaran</button>
                <a class="back" href="{{ route('booking.index') }}">Kembali</a>
            </form>
        </div>
    @else
        <div class="card">
            @if ($booking->pembayaran->status_bayar === 'berhasil')
                <p class="status">Pembayaran berhasil diverifikasi.</p>
            @else
                <p class="status">Pembayaran menunggu verifikasi admin.</p>
            @endif

            <a class="back" href="{{ route('booking.index') }}">Kembali ke booking</a>
        </div>
    @endif
</div>
</body>
</html>