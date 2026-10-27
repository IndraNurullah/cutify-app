<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function show(Booking $booking)
    {
        // Pastikan booking milik pelanggan yang sedang login.
        abort_unless(
            (int) $booking->pelanggan_id === (int) session('pelanggan_id'),
            403
        );

        if ($booking->status === 'dibatalkan') {
            return redirect()
                ->route('booking.index')
                ->with('error', 'Booking yang dibatalkan tidak bisa dibayar.');
        }

        $booking->load(['layanan', 'barber', 'jadwal', 'pembayaran']);

        return view('pembayaran.show', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        abort_unless(
            (int) $booking->pelanggan_id === (int) session('pelanggan_id'),
            403
        );

        if ($booking->status === 'dibatalkan') {
            return redirect()
                ->route('booking.index')
                ->with('error', 'Booking yang dibatalkan tidak bisa dibayar.');
        }

        $validated = $request->validate([
            'metode' => ['required', 'in:transfer_bank,qris,tunai'],
        ]);

        $pembayaran = Pembayaran::where('booking_id', $booking->id)->first();

        if ($pembayaran && $pembayaran->status_bayar === 'berhasil') {
            return redirect()
                ->route('booking.index')
                ->with('success', 'Pembayaran booking ini sudah berhasil.');
        }

        DB::transaction(function () use ($booking, $validated) {
            Pembayaran::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'metode' => $validated['metode'],
                    'total' => $booking->total_harga,
                    'status_bayar' => 'menunggu_verifikasi',
                    'referensi_transaksi' => null,
                    'dibayar_pada' => null,
                ]
            );
        });

        return redirect()
            ->route('pembayaran.show', $booking->id)
            ->with('success', 'Konfirmasi pembayaran tersimpan. Status menunggu verifikasi.');
    }
}