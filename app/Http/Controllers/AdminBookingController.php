<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with([
            'pelanggan',
            'layanan',
            'barber',
            'jadwal',
            'pembayaran',
        ])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'menunggu',
                    'dikonfirmasi',
                    'selesai',
                    'dibatalkan',
                ]),
            ],
        ]);

        DB::transaction(function () use ($booking, $validated) {
            $booking = Booking::whereKey($booking->id)
                ->lockForUpdate()
                ->firstOrFail();

            $statusBaru = $validated['status'];

            // Booking yang sudah selesai atau dibatalkan tidak diubah lagi.
            if (in_array($booking->status, ['selesai', 'dibatalkan'])) {
                abort(422, 'Status booking ini sudah final dan tidak bisa diubah.');
            }

            if ($statusBaru === 'dibatalkan') {
                $jadwal = $booking->jadwal()
                    ->lockForUpdate()
                    ->first();

                if ($jadwal && $jadwal->status === 'dipesan') {
                    $jadwal->update([
                        'status' => 'tersedia',
                    ]);
                }
            }

            $booking->update([
                'status' => $statusBaru,
            ]);
        });

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Status booking berhasil diperbarui.');
    }
}