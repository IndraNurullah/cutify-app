<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CutifyDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();

            // 1. Data layanan
            if (DB::table('layanans')->count() === 0) {
                DB::table('layanans')->insert([
                    [
                        'nama_layanan' => 'Classic Haircut',
                        'deskripsi' => 'Potongan rambut klasik dan rapi.',
                        'harga' => 35000,
                        'durasi' => 30,
                        'aktif' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'nama_layanan' => 'Low Fade',
                        'deskripsi' => 'Potongan low fade modern.',
                        'harga' => 45000,
                        'durasi' => 45,
                        'aktif' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'nama_layanan' => 'Mid Fade',
                        'deskripsi' => 'Potongan mid fade kekinian.',
                        'harga' => 50000,
                        'durasi' => 45,
                        'aktif' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'nama_layanan' => 'Haircut + Styling',
                        'deskripsi' => 'Potong rambut sekaligus styling.',
                        'harga' => 65000,
                        'durasi' => 60,
                        'aktif' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                ]);
            }

            // 2. Data barber
            if (DB::table('barbers')->count() === 0) {
                DB::table('barbers')->insert([
                    [
                        'nama_barber' => 'Andi Pratama',
                        'no_hp' => null,
                        'deskripsi' => 'Spesialis potongan klasik.',
                        'aktif' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'nama_barber' => 'Rizky Saputra',
                        'no_hp' => null,
                        'deskripsi' => 'Spesialis fade dan modern cut.',
                        'aktif' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'nama_barber' => 'Dimas Ramadhan',
                        'no_hp' => null,
                        'deskripsi' => 'Spesialis styling rambut.',
                        'aktif' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                ]);
            }

            // 3. Jadwal untuk 7 hari ke depan.
            // Skema jadwal saat ini belum memiliki barber_id.
            // Karena itu, slot masih digunakan bersama oleh semua barber.
            if (DB::table('jadwals')->count() === 0) {
                $jadwals = [];

                for ($hari = 1; $hari <= 7; $hari++) {
                    $tanggal = Carbon::today()
                        ->addDays($hari)
                        ->toDateString();

                    for ($jam = 9; $jam < 17; $jam++) {
                        $jadwals[] = [
                            'tanggal' => $tanggal,
                            'jam_mulai' => sprintf('%02d:00:00', $jam),
                            'jam_selesai' => sprintf('%02d:00:00', $jam + 1),
                            'status' => 'tersedia',
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }

                foreach (array_chunk($jadwals, 100) as $batch) {
                    DB::table('jadwals')->insert($batch);
                }
            }
        });

        $this->command->info('Data demo CUTIFY berhasil diperiksa dan ditambahkan jika tabel kosong.');
    }
}