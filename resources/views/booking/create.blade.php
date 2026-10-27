<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Booking</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f2eb;
            color: #1c2a23;
            font-family: Arial, sans-serif;
        }

        header {
            background: #14271f;
            color: #f7f1e7;
            padding: 20px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        header a {
            color: #f7f1e7;
            text-decoration: none;
        }

        .container {
            width: min(760px, 92%);
            margin: 35px auto;
        }

        .back {
            color: #98603a;
            text-decoration: none;
            font-weight: bold;
        }

        h1 {
            margin-bottom: 8px;
        }

        .muted {
            color: #68716a;
            line-height: 1.6;
        }

        form {
            position: relative;
            background: white;
            padding: 28px;
            border-radius: 16px;
            margin-top: 24px;
            box-shadow: 0 8px 30px #17271d0c;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 9px;
        }

        select,
        textarea {
            display: block;
            position: relative;
            width: 100%;
            min-height: 48px;
            padding: 12px;
            border: 1px solid #cbd2ca;
            border-radius: 8px;
            background-color: #fff;
            color: #1c2a23;
            font: inherit;
            pointer-events: auto;
            cursor: pointer;
        }

        select:focus,
        textarea:focus {
            outline: 2px solid #b8784b;
            outline-offset: 2px;
            border-color: #b8784b;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
            cursor: text;
        }

        .harga {
            margin-top: 20px;
            padding: 16px;
            background: #f5f2eb;
            border-radius: 8px;
        }

        .harga strong {
            color: #98603a;
            font-size: 20px;
        }

        button {
            display: block;
            width: 100%;
            min-height: 48px;
            margin-top: 22px;
            border: none;
            border-radius: 8px;
            background: #b8784b;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #98603a;
        }

        button:disabled {
            background: #999;
            cursor: not-allowed;
        }

        .alert {
            padding: 14px;
            border-radius: 8px;
            margin: 18px 0;
        }

        .error {
            background: #ffe5e1;
            color: #8d2d23;
        }

        .notice {
            background: #fff1d6;
            color: #77521d;
        }

        @media (max-width: 520px) {
            form {
                padding: 20px;
            }

            header {
                padding: 18px 4%;
            }
        }
    </style>
</head>

<body>
<header>
    <strong>CUTIFY — Booking</strong>
    <a href="{{ route('booking.index') }}">Riwayat Booking</a>
</header>

<main class="container">
    <a class="back" href="{{ route('home') }}">
        &larr; Kembali ke beranda
    </a>

    <h1>Buat Booking</h1>
    <p class="muted">
        Pilih layanan, barber, serta tanggal dan jam yang tersedia.
    </p>

    @if ($errors->any())
        <div class="alert error">
            <strong>Booking belum berhasil:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($layanans->isEmpty())
        <div class="alert notice">
            Belum ada layanan aktif di database.
        </div>
    @endif

    @if ($barbers->isEmpty())
        <div class="alert notice">
            Belum ada barber aktif di database.
        </div>
    @endif

    @if ($jadwals->isEmpty())
        <div class="alert notice">
            Belum ada jadwal tersedia untuk hari ini atau hari berikutnya.
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="layanan_id">Pilih layanan</label>

            <select id="layanan_id" name="layanan_id" required>
                <option value="">-- Pilih layanan --</option>

                @foreach ($layanans as $layanan)
                    <option
                        value="{{ $layanan->id }}"
                        data-harga="{{ $layanan->harga }}"
                        @selected(old('layanan_id') == $layanan->id)
                    >
                        {{ $layanan->nama_layanan }}
                        — Rp{{ number_format($layanan->harga, 0, ',', '.') }}
                        ({{ $layanan->durasi }} menit)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="barber_id">Pilih barber</label>

            <select id="barber_id" name="barber_id" required>
                <option value="">-- Pilih barber --</option>

                @foreach ($barbers as $barber)
                    <option
                        value="{{ $barber->id }}"
                        @selected(old('barber_id') == $barber->id)
                    >
                        {{ $barber->nama_barber }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jadwal_id">Pilih tanggal dan jam</label>

            <select id="jadwal_id" name="jadwal_id" required>
                <option value="">-- Pilih jadwal --</option>

                @foreach ($jadwals as $jadwal)
                    <option
                        value="{{ $jadwal->id }}"
                        @selected(old('jadwal_id') == $jadwal->id)
                    >
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}
                        |
                        {{ substr($jadwal->jam_mulai, 0, 5) }}
                        @if ($jadwal->jam_selesai)
                            - {{ substr($jadwal->jam_selesai, 0, 5) }}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="harga">
            Estimasi harga layanan
            <br>
            <strong id="total-harga">Rp0</strong>
        </div>

        <div class="form-group" style="margin-top: 20px;">
            <label for="catatan">Catatan tambahan (opsional)</label>

            <textarea
                id="catatan"
                name="catatan"
                maxlength="1000"
                placeholder="Contoh: ingin potongan low fade..."
            >{{ old('catatan') }}</textarea>
        </div>

        <button
            type="submit"
            @disabled($layanans->isEmpty() || $barbers->isEmpty() || $jadwals->isEmpty())
        >
            Konfirmasi Booking
        </button>
    </form>
</main>

<script>
    const layananSelect = document.getElementById('layanan_id');
    const totalHarga = document.getElementById('total-harga');

    function formatRupiah(angka) {
        return 'Rp' + Number(angka).toLocaleString('id-ID', {
            maximumFractionDigits: 0
        });
    }

    function updateHarga() {
        const option = layananSelect.options[layananSelect.selectedIndex];
        const harga = option ? option.dataset.harga : null;

        totalHarga.textContent = harga
            ? formatRupiah(harga)
            : 'Rp0';
    }

    layananSelect.addEventListener('change', updateHarga);
    updateHarga();
</script>

</body>
</html>