<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - CUTIFY</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #101812;
            color: #f5f0e5;
            padding: 30px 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .logo {
            color: #d9b477;
            font-size: 30px;
            font-weight: bold;
            letter-spacing: 3px;
        }

        .subtitle {
            color: #b8c0b5;
            margin-top: 8px;
        }

        .back-button {
            display: inline-block;
            padding: 11px 18px;
            background: #26352a;
            color: #f5f0e5;
            border: 1px solid #536354;
            border-radius: 8px;
            text-decoration: none;
        }

        .message {
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success {
            background: #193d2a;
            color: #a9efbd;
        }

        .error {
            background: #492323;
            color: #ffc0c0;
        }

        .booking-card {
            background: #1b261e;
            border: 1px solid #354337;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .booking-header h2 {
            color: #d9b477;
            font-size: 21px;
        }

        .status {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            background: #354337;
            color: #f5f0e5;
            font-size: 12px;
            font-weight: bold;
        }

        .status-menunggu {
            background: #594522;
            color: #ffe0a0;
        }

        .status-dikonfirmasi {
            background: #1d4935;
            color: #a9efbd;
        }

        .status-selesai {
            background: #24465b;
            color: #b9e3ff;
        }

        .status-dibatalkan {
            background: #492323;
            color: #ffc0c0;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
        }

        .detail-item {
            padding: 14px;
            background: #131c15;
            border-radius: 8px;
        }

        .detail-label {
            display: block;
            color: #aeb8ac;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .detail-value {
            color: #f5f0e5;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .price {
            color: #d9b477;
            font-size: 20px;
        }

        .payment-status {
            margin-top: 18px;
            color: #c6cec3;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 11px 17px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .payment-button {
            background: #d9b477;
            color: #172018;
        }

        .cancel-button {
            background: #492323;
            color: #ffc0c0;
        }

        .empty {
            text-align: center;
            background: #1b261e;
            border: 1px solid #354337;
            border-radius: 14px;
            padding: 45px 20px;
        }

        .empty p {
            color: #b8c0b5;
            margin: 12px 0 20px;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .booking-card {
                padding: 17px;
            }

            .header {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <div>
                <div class="logo">CUTIFY</div>
                <p class="subtitle">Riwayat Booking Anda</p>
            </div>

            <a href="{{ route('home') }}" class="back-button">
                Kembali ke Beranda
            </a>
        </div>

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Pesan error --}}
        @if (session('error'))
            <div class="message error">
                {{ session('error') }}
            </div>
        @endif

        {{-- Pesan validasi --}}
        @if ($errors->any())
            <div class="message error">
                <ul style="padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @forelse ($bookings as $booking)
            <div class="booking-card">

                <div class="booking-header">
                    <h2>
                        Booking #{{ $booking->id }}
                    </h2>

                    <span class="status status-{{ $booking->status }}">
                        {{ strtoupper(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </div>

                <div class="details">

                    <div class="detail-item">
                        <span class="detail-label">Layanan</span>
                        <span class="detail-value">
                            {{ $booking->layanan->nama_layanan ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Barber</span>
                        <span class="detail-value">
                            {{ $booking->barber->nama_barber ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Tanggal Booking</span>
                        <span class="detail-value">
                            {{ $booking->jadwal?->tanggal
                                ? \Carbon\Carbon::parse($booking->jadwal->tanggal)->format('d-m-Y')
                                : '-' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Jam</span>
                        <span class="detail-value">
                            {{ $booking->jadwal->jam_mulai ?? '-' }}
                            -
                            {{ $booking->jadwal->jam_selesai ?? '-' }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Total Harga</span>
                        <span class="detail-value price">
                            Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Tanggal Dibuat</span>
                        <span class="detail-value">
                            {{ $booking->tgl_pesan
                                ? \Carbon\Carbon::parse($booking->tgl_pesan)->format('d-m-Y H:i')
                                : '-' }}
                        </span>
                    </div>

                </div>

                <div class="payment-status">
                    <strong>Status Pembayaran:</strong>

                    @if ($booking->pembayaran)
                        {{ strtoupper(str_replace('_', ' ', $booking->pembayaran->status_bayar)) }}
                        <br>

                        <span style="font-size: 13px; color: #aeb8ac;">
                            Metode:
                            {{ strtoupper(str_replace('_', ' ', $booking->pembayaran->metode)) }}
                        </span>
                    @else
                        BELUM ADA PEMBAYARAN
                    @endif
                </div>

                <div class="actions">

                    {{-- Tombol pembayaran --}}
                    @if ($booking->status !== 'dibatalkan')
                        <a
                            href="{{ route('pembayaran.show', $booking->id) }}"
                            class="button payment-button"
                        >
                            {{ $booking->pembayaran?->status_bayar === 'berhasil'
                                ? 'Lihat Pembayaran'
                                : 'Bayar Sekarang' }}
                        </a>
                    @endif

                    {{-- Tombol pembatalan hanya untuk booking menunggu --}}
                    @if ($booking->status === 'menunggu')
                        <form
                            action="{{ route('booking.cancel', $booking->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan booking ini?')"
                        >
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="button cancel-button">
                                Batalkan Booking
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        @empty
            <div class="empty">
                <h2>Belum Ada Booking</h2>

                <p>
                    Kamu belum memiliki riwayat booking.
                    Silakan pilih layanan dan buat booking terlebih dahulu.
                </p>

                <a href="{{ route('home') }}" class="button payment-button">
                    Booking Sekarang
                </a>
            </div>
        @endforelse

    </div>
</body>
</html>