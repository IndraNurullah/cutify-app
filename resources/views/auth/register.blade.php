<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | CUTIFY</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; display: grid; place-items: center;
            padding: 24px; background: #12231e; color: #f6f0e5;
            font-family: Arial, sans-serif;
        }
        .card {
            width: 100%; max-width: 440px; padding: 36px;
            background: #f6f0e5; color: #17251f; border-radius: 18px;
        }
        .logo { font-size: 28px; font-weight: 900; letter-spacing: 3px; }
        .logo span { color: #b8784b; }
        h1 { margin: 28px 0 8px; font-size: 30px; }
        .desc { color: #69716a; margin-bottom: 24px; }
        label { display: block; font-weight: bold; margin: 16px 0 7px; }
        input {
            width: 100%; padding: 13px; border: 1px solid #d4d5cb;
            border-radius: 8px; font-size: 15px; background: white;
        }
        button {
            width: 100%; margin-top: 24px; padding: 14px;
            border: 0; border-radius: 8px; background: #b8784b;
            color: white; font-size: 16px; font-weight: bold; cursor: pointer;
        }
        button:hover { background: #98603a; }
        .foot { text-align: center; margin-top: 22px; color: #69716a; }
        a { color: #98603a; font-weight: bold; }
        .alert { padding: 12px; margin: 14px 0; border-radius: 8px; }
        .error { background: #ffe3e0; color: #982d24; }
        .success { background: #dff5e5; color: #1d6635; }
        .alert ul { margin: 6px 0 0; padding-left: 20px; }
    </style>
</head>
<body>
    <main class="card">

        <h1>Buat akun baru</h1>
        <p class="desc">Daftar untuk mulai booking barbershop favoritmu.</p>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <strong>Periksa kembali data kamu:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf

            <label for="nama">Nama lengkap</label>
            <input id="nama" type="text" name="nama"
                   value="{{ old('nama') }}" required autocomplete="name">

            <label for="email">Email</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}" required autocomplete="email">

            <label for="no_hp">Nomor HP</label>
            <input id="no_hp" type="text" name="no_hp"
                   value="{{ old('no_hp') }}" required autocomplete="tel">

            <label for="password">Password</label>
            <input id="password" type="password" name="password"
                   required minlength="8" autocomplete="new-password">

            <label for="password_confirmation">Konfirmasi password</label>
            <input id="password_confirmation" type="password"
                   name="password_confirmation" required minlength="8"
                   autocomplete="new-password">

            <button type="submit">Daftar Sekarang</button>
        </form>

        <div class="foot">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
            <p><a href="{{ route('home') }}">← Kembali ke beranda</a></p>
        </div>
    </main>
</body>
</html>