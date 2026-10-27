<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Booking;
use App\Models\Jadwal;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with([
            'layanan',
            'barber',
            'jadwal',
            'pembayaran',
        ])
            ->where(
                'pelanggan_id',
                $request->session()->get('pelanggan_id')
            )
            ->latest()
            ->get();

        return view('booking.index', compact('bookings'));
    }

    public function create()
    {
        $layanans = Layanan::where('aktif', true)
            ->orderBy('nama_layanan')
            ->get();

        $barbers = Barber::where('aktif', true)
            ->orderBy('nama_barber')
            ->get();

        $jadwals = Jadwal::where('status', 'tersedia')
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        return view('booking.create', compact(
            'layanans',
            'barbers',
            'jadwals'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'layanan_id' => [
                'required',
                'integer',
                'exists:layanans,id',
            ],
            'barber_id' => [
                'required',
                'integer',
                'exists:barbers,id',
            ],
            'jadwal_id' => [
                'required',
                'integer',
                'exists:jadwals,id',
            ],
            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        $pelangganId = $request->session()->get('pelanggan_id');

        DB::transaction(function () use ($data, $pelangganId) {
            $jadwal = Jadwal::whereKey($data['jadwal_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $jadwal->status !== 'tersedia' ||
                $jadwal->tanggal < today()->toDateString()
            ) {
                throw ValidationException::withMessages([
                    'jadwal_id' => 'Jadwal sudah tidak tersedia. Pilih jadwal lain.',
                ]);
            }

            $layanan = Layanan::whereKey($data['layanan_id'])
                ->where('aktif', true)
                ->first();

            if (!$layanan) {
                throw ValidationException::withMessages([
                    'layanan_id' => 'Layanan tidak tersedia.',
                ]);
            }

            $barber = Barber::whereKey($data['barber_id'])
                ->where('aktif', true)
                ->first();

            if (!$barber) {
                throw ValidationException::withMessages([
                    'barber_id' => 'Barber tidak tersedia.',
                ]);
            }

            Booking::create([
                'pelanggan_id' => $pelangganId,
                'layanan_id' => $layanan->id,
                'barber_id' => $barber->id,
                'jadwal_id' => $jadwal->id,
                'tgl_pesan' => now(),
                'total_harga' => $layanan->harga,
                'status' => 'menunggu',
                'catatan' => $data['catatan'] ?? null,
            ]);

            $jadwal->update([
                'status' => 'dipesan',
            ]);
        });

        return redirect()
            ->route('booking.index')
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function cancel(Request $request, Booking $booking)
    {
        abort_unless(
            (int) $booking->pelanggan_id ===
                (int) $request->session()->get('pelanggan_id'),
            403
        );

        DB::transaction(function () use ($booking) {
            $currentBooking = Booking::whereKey($booking->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($currentBooking->status !== 'menunggu') {
                throw ValidationException::withMessages([
                    'booking' => 'Hanya booking berstatus menunggu yang bisa dibatalkan.',
                ]);
            }

            $currentBooking->update([
                'status' => 'dibatalkan',
            ]);

            $jadwal = Jadwal::whereKey($currentBooking->jadwal_id)
                ->lockForUpdate()
                ->first();

            if ($jadwal && $jadwal->status === 'dipesan') {
                $jadwal->update([
                    'status' => 'tersedia',
                ]);
            }
        });

        return redirect()
            ->route('booking.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }
}