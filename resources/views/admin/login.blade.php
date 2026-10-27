<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - CUTIFY</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            background: #101812;
            color: #f5f0e5;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            border: 1px solid #354337;
            border-radius: 16px;
            background: #1b261e;
        }

        .logo {
            color: #d9b477;
            font-size: 30px;
            font-weight: bold;
            letter-spacing: 4px;
            text-align: center;
        }

        h1 { text-align: center; font-size: 22px; }

        .subtitle {
            text-align: center;
            color: #b8c0b5;
            margin-bottom: 26px;
        }

        label { display: block; margin: 16px 0 8px; }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #536354;
            border-radius: 8px;
            background: #131c15;
            color: #fff;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 22px;
            border: 0;
            border-radius: 8px;
            background: #d9b477;
            color: #172018;
            font-weight: bold;
            cursor: pointer;
        }

        .message {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            background: #492323;
            color: #ffc0c0;
        }

        .success { background: #193d2a; color: #a9efbd; }

        a {
            color: #d9b477;
            text-decoration: none;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 22px;
        }
    </style>
</head>
<body>
    <main class="card">
        <div class="logo">CUTIFY</div>
        <h1>Login Administrator</h1>
        <p class="subtitle">Masuk ke panel pengelolaan barbershop</p>

        @if (session('error'))
            <div class="message">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.authenticate') }}" method="POST">
            @csrf

            <label for="email">Email Admin</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="username"
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="current-password"
            >

            <button type="submit">Masuk ke Dashboard</button>
        </form>

        <a href="{{ route('home') }}" class="back">Kembali ke Beranda</a>
    </main>
</body>
</html>