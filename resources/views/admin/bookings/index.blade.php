<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Booking | CUTIFY Admin</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f3;
            color: #1d2a23;
        }

        header {
            background: #173c2b;
            color: white;
            padding: 22px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        header p {
            margin: 6px 0 0;
            color: #d6e5da;
            font-size: 13px;
        }

        a { text-decoration: none; }

        .nav a {
            display: inline-block;
            color: white;
            padding: 10px 13px;
            border-radius: 7px;
            margin-left: 5px;
            font-size: 14px;
        }

        .nav a:hover { background: #315640; }

        main {
            width: 94%;
            max-width: 1400px;
            margin: 30px auto;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .heading h2 {
            margin: 0 0 7px;
            font-size: 25px;
        }

        .heading p {
            margin: 0;
            color: #6c776f;
        }

        .notice {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .success {
            background: #dff5e6;
            color: #176437;
        }

        .error {
            background: #ffe5e5;
            color: #9b2222;
        }

        .panel {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 18px #173c2b0c;
            overflow: hidden;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e8ece8;
            vertical-align: top;
            font-size: 13px;
        }

        th {
            background: #f5f8f5;
            color: #365141;
            white-space: nowrap;
        }

        td strong {
            display: block;
            margin-bottom: 5px;
        }

        .muted {
            color: #7a847d;
            font-size: 12px;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .menunggu {
            background: #fff0c7;
            color: #865900;
        }

        .dikonfirmasi {
            background: #dcecff;
            color: #1c5796;
        }

        .selesai {
            background: #d9f5e2;
            color: #176437;
        }

        .dibatalkan {
            background: #ffe0e0;
            color: #a32b2b;
        }

        .action-form {
            display: flex;
            gap: 7px;
            min-width: 210px;
        }

        select {
            min-width: 125px;
            padding: 9px;
            border: 1px solid #ccd5ce;
            border-radius: 6px;
            background: white;
        }

        button {
            background: #173c2b;
            color: white;
            border: 0;
            border-radius: 6px;
            padding: 9px 12px;
            cursor: pointer;
        }

        button:hover { background: #28553c; }

        button:disabled {
            opacity: .45;
            cursor: not-allowed;
        }

        .empty {
            text-align: center;
            color: #737d75;
            padding: 35px;
        }

        @media (max-width: 600px) {
            header { padding: 18px 4%; }
            main { margin-top: 22px; }
            .panel { padding: 12px; }
        }
    </style>
</head>
<body>

<header>
    <div>
        <h1>CUTIFY <span style="color:#e3c16f">ADMIN</span></h1>
        <p>Panel pengelolaan pemesanan barbershop</p>
    </div>

    <nav class="nav">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('home') }}">Halaman Utama</a>
    </nav>
</header>

<main>
    <div class="heading">
        <div>
            <h2>Kelola Booking</h2>
            <p>Lihat dan perbarui status pemesanan pelanggan.</p>
        </div>
        <strong>Total booking: {{ $bookings->count() }}</strong>
    </div>

    @if (session('success'))
        <div class="notice success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="notice error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="notice error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="panel">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID / Tanggal Pesan</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Barber</th>
                        <th>Jadwal</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status Booking</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>
                            <strong>#{{ $booking->id }}</strong>
                            <span class="muted">
                                {{ $booking->tgl_pesan
                                    ? \Carbon\Carbon::parse($booking->tgl_pesan)->format('d/m/Y H:i')
                                    : '-' }}
                            </span>
                        </td>

                        <td>
                            <strong>{{ $booking->pelanggan?->nama ?? 'Pelanggan tidak ditemukan' }}</strong>
                            <span class="muted">{{ $booking->pelanggan?->email ?? '-' }}</span>
                        </td>

                        <td>
                            {{ $booking->layanan?->nama_layanan ?? '-' }}
                        </td>

                        <td>
                            {{ $booking->barber?->nama_barber ?? '-' }}
                        </td>

                        <td>
                            @if ($booking->jadwal)
                                <strong>
                                    {{ \Carbon\Carbon::parse($booking->jadwal->tanggal)->format('d/m/Y') }}
                                </strong>
                                {{ substr($booking->jadwal->jam_mulai, 0, 5) }}
                                -
                                {{ substr($booking->jadwal->jam_selesai, 0, 5) }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ str_replace('_', ' ', $booking->pembayaran?->status_bayar ?? 'belum dibuat') }}
                        </td>

                        <td>
                            <span class="status {{ $booking->status }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <td>
                            @if (in_array($booking->status, ['selesai', 'dibatalkan']))
                                <span class="muted">Status final</span>
                            @else
                                <form
                                    class="action-form"
                                    method="POST"
                                    action="{{ route('admin.bookings.updateStatus', $booking) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <select name="status" required>
                                        <option value="menunggu"
                                            @selected($booking->status === 'menunggu')>
                                            Menunggu
                                        </option>
                                        <option value="dikonfirmasi"
                                            @selected($booking->status === 'dikonfirmasi')>
                                            Dikonfirmasi
                                        </option>
                                        <option value="selesai">
                                            Selesai
                                        </option>
                                        <option value="dibatalkan">
                                            Batalkan
                                        </option>
                                    </select>

                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin memperbarui status booking ini?')">
                                        Simpan
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty">
                            Belum ada data booking pelanggan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>

</body>
</html>