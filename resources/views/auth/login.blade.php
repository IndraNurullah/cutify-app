<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CUTIFY</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background: #12231e;
            color: #f6f0e5;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 440px;
            padding: 36px;
            background: #f6f0e5;
            color: #17251f;
            border-radius: 18px;
        }

        .logo {
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 3px;
        }

        .logo span {
            color: #b8784b;
        }

        h1 {
            margin: 28px 0 8px;
            font-size: 30px;
        }

        .desc {
            color: #69716a;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 16px 0 7px;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #d4d5cb;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        input:focus {
            outline: 2px solid #b8784b;
            border-color: transparent;
        }

        button {
            width: 100%;
            margin-top: 24px;
            padding: 14px;
            border: 0;
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

        .foot {
            text-align: center;
            margin-top: 22px;
            color: #69716a;
            line-height: 1.6;
        }

        a {
            color: #98603a;
            font-weight: bold;
        }

        .alert {
            padding: 12px;
            margin: 14px 0;
            border-radius: 8px;
            line-height: 1.5;
        }

        .error {
            background: #ffe3e0;
            color: #982d24;
        }

        .success {
            background: #dff5e5;
            color: #1d6635;
        }

        .alert ul {
            margin: 6px 0 0;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <main class="card">

        <div class="logo">CUTI<span>FY</span></div>

        <h1>Selamat datang!</h1>
        <p class="desc">
            Login ke akunmu untuk melanjutkan booking
            layanan barbershop favoritmu.
        </p>

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <strong>Login gagal:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Masukkan email kamu"
                required
                autocomplete="email"
                autofocus
            >

            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
                autocomplete="current-password"
            >

            <button type="submit">Login Sekarang</button>
        </form>

        <div class="foot">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>

            <p>
                <a href="{{ route('home') }}">
                    &larr; Kembali ke beranda
                </a>
            </p>
        </div>

    </main>
</body>
</html>