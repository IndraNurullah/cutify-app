<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Booking;
use App\Models\Layanan;
use App\Models\Pelanggan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();

        $totalBooking = Booking::count();

        $bookingMenunggu = Booking::where(
            'status',
            'menunggu'
        )->count();

        $totalLayanan = Layanan::where(
            'aktif',
            true
        )->count();

        $totalBarber = Barber::where(
            'aktif',
            true
        )->count();

        $bookingTerbaru = Booking::with([
            'pelanggan',
            'layanan',
            'barber',
            'jadwal',
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPelanggan',
            'totalBooking',
            'bookingMenunggu',
            'totalLayanan',
            'totalBarber',
            'bookingTerbaru'
        ));
    }
}