<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CUTIFY</title>

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
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            background: #17221a;
            border-right: 1px solid #354337;
            padding: 28px 18px;
        }

        .logo {
            color: #d9b477;
            font-size: 29px;
            font-weight: bold;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }

        .admin-label {
            color: #aeb8ac;
            font-size: 13px;
            margin-bottom: 35px;
        }

        .nav-title {
            color: #849184;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin: 25px 10px 12px;
        }

        .nav-link {
            display: block;
            color: #d8dfd4;
            text-decoration: none;
            padding: 13px 12px;
            margin-bottom: 6px;
            border-radius: 8px;
        }

        .nav-link.active {
            color: #d9b477;
            background: #29372b;
        }

        .nav-link:hover {
            background: #26352a;
        }

        .sidebar-bottom {
            margin-top: 40px;
        }

        .logout-button {
            width: 100%;
            padding: 12px;
            border: 1px solid #704343;
            border-radius: 8px;
            color: #ffc0c0;
            background: #492323;
            cursor: pointer;
            font-weight: bold;
        }

        .main {
            flex: 1;
            min-width: 0;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding-bottom: 24px;
            border-bottom: 1px solid #354337;
        }

        .topbar h1 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .muted {
            color: #aeb8ac;
            font-size: 14px;
        }

        .admin-profile {
            padding: 12px 16px;
            background: #1b261e;
            border: 1px solid #354337;
            border-radius: 10px;
            color: #d9b477;
        }

        .welcome {
            margin: 28px 0;
            padding: 26px;
            border: 1px solid #554a32;
            border-radius: 14px;
            background: linear-gradient(120deg, #26352a, #1b261e);
        }

        .welcome h2 {
            color: #d9b477;
            font-size: 23px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #c4cec0;
            line-height: 1.7;
        }

        .section-title {
            font-size: 19px;
            margin-bottom: 17px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(5, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 32px;
        }

        .stat-card {
            padding: 21px;
            background: #1b261e;
            border: 1px solid #354337;
            border-radius: 12px;
        }

        .stat-card p {
            color: #aeb8ac;
            font-size: 13px;
            line-height: 1.5;
        }

        .stat-card h3 {
            color: #d9b477;
            font-size: 30px;
            margin-top: 13px;
        }

        .panel {
            background: #1b261e;
            border: 1px solid #354337;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 25px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 15px 12px;
            border-bottom: 1px solid #354337;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        th {
            color: #d9b477;
            font-weight: bold;
        }

        td {
            color: #e5e9df;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            background: #354337;
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

        .empty {
            color: #aeb8ac;
            padding: 25px 0;
        }

        .footer {
            color: #849184;
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
        }

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, minmax(150px, 1fr));
            }
        }

        @media (max-width: 700px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 20px;
                border-right: none;
                border-bottom: 1px solid #354337;
            }

            .admin-label {
                margin-bottom: 20px;
            }

            .nav-title {
                margin-top: 18px;
            }

            .sidebar-bottom {
                margin-top: 20px;
            }

            .main {
                padding: 20px 14px;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-card h3 {
                font-size: 25px;
            }

            .welcome {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
<div class="layout">

<aside class="sidebar">
    <div class="logo">CUTIFY</div>
    <p class="admin-label">Administrator Panel</p>

    <p class="nav-title">MENU UTAMA</p>

    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
        Dashboard
    </a>

    <a href="{{ route('admin.bookings.index') }}" class="nav-link">
        Kelola Booking
    </a>

    <a href="{{ route('admin.dashboard') }}#booking-terbaru" class="nav-link">
        Booking Terbaru
    </a>

    <p class="nav-title">LAINNYA</p>

    <a href="{{ route('home') }}" class="nav-link">
        Lihat Website
    </a>

    <div class="sidebar-bottom">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">
                Logout Admin
            </button>
        </form>
    </div>
</aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Dashboard</h1>
                <p class="muted">
                    Ringkasan operasional barbershop CUTIFY.
                </p>
            </div>

            <div class="admin-profile">
                {{ session('admin_nama', 'Administrator') }}
            </div>
        </header>

        <section class="welcome">
            <h2>Selamat datang di CUTIFY, Admin!</h2>
            <p>
                Pantau aktivitas pelanggan dan booking dari satu halaman.
                Pastikan setiap pesanan ditangani dengan baik agar pelayanan
                barbershop tetap maksimal.
            </p>
        </section>

        <h2 class="section-title">Ringkasan Data</h2>

        <section class="stats">
            <div class="stat-card">
                <p>Total Pelanggan</p>
                <h3>{{ $totalPelanggan }}</h3>
            </div>

            <div class="stat-card">
                <p>Total Booking</p>
                <h3>{{ $totalBooking }}</h3>
            </div>

            <div class="stat-card">
                <p>Menunggu Konfirmasi</p>
                <h3>{{ $bookingMenunggu }}</h3>
            </div>

            <div class="stat-card">
                <p>Layanan Aktif</p>
                <h3>{{ $totalLayanan }}</h3>
            </div>

            <div class="stat-card">
                <p>Barber Aktif</p>
                <h3>{{ $totalBarber }}</h3>
            </div>
        </section>

        <section class="panel" id="booking-terbaru">
            <h2 class="section-title">Booking Terbaru</h2>
            <p class="muted">
                Lima pesanan terbaru yang masuk ke sistem.
            </p>

            @if ($bookingTerbaru->isEmpty())
                <p class="empty">
                    Belum ada booking masuk.
                </p>
            @else
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pelanggan</th>
                                <th>Layanan</th>
                                <th>Barber</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bookingTerbaru as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>

                                    <td>
                                        {{ $booking->pelanggan->nama ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $booking->layanan->nama_layanan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $booking->barber->nama_barber ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $booking->jadwal?->tanggal
                                            ? \Carbon\Carbon::parse($booking->jadwal->tanggal)->format('d-m-Y')
                                            : '-' }}
                                    </td>

                                    <td>
                                        {{ $booking->jadwal->jam_mulai ?? '-' }}
                                        -
                                        {{ $booking->jadwal->jam_selesai ?? '-' }}
                                    </td>

                                    <td>
                                        Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <span class="status status-{{ $booking->status }}">
                                            {{ strtoupper($booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <p class="footer">
            &copy; {{ date('Y') }} CUTIFY — Admin Dashboard
        </p>

    </main>
</div>
</body>
</html>