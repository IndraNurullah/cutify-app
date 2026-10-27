<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Barber;

class HomeController extends Controller
{
    public function index()
    {
        $layanans = Layanan::where('aktif', true)
            ->orderBy('harga')
            ->get();

        $barbers = Barber::where('aktif', true)->get();

        // Konten demo agar tampilan tetap terisi saat database masih kosong.
        if ($layanans->isEmpty()) {
            $layanans = collect([
                (object) [
                    'nama_layanan' => 'Classic Haircut',
                    'deskripsi' => 'Potongan klasik yang rapi dan cocok untuk segala suasana.',
                    'harga' => 35000,
                    'durasi' => 30,
                ],
                (object) [
                    'nama_layanan' => 'Skin Fade',
                    'deskripsi' => 'Gradasi presisi dengan detail bersih di setiap sisi.',
                    'harga' => 50000,
                    'durasi' => 45,
                ],
                (object) [
                    'nama_layanan' => 'Haircut & Beard',
                    'deskripsi' => 'Paket potong rambut dan perapian jenggot.',
                    'harga' => 65000,
                    'durasi' => 60,
                ],
            ]);
        }

        if ($barbers->isEmpty()) {
            $barbers = collect([
                (object) ['nama_barber' => 'Senior Barber'],
                (object) ['nama_barber' => 'Fade Specialist'],
                (object) ['nama_barber' => 'Style Consultant'],
            ]);
        }

        return view('home', compact('layanans', 'barbers'));
    }
}
