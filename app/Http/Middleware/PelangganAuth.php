<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Symfony\Component\HttpFoundation\Response;

class PelangganAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->session()->get('pelanggan_id');

        if (!$id || !Pelanggan::whereKey($id)->exists()) {
            $request->session()->forget('pelanggan_id');

            return redirect()
                ->route('login')
                ->with('error', 'Login dulu sebelum mengakses halaman tersebut.');
        }

        return $next($request);
    }
}
