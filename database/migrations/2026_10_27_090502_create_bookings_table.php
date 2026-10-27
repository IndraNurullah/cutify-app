<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('pelanggan_id')
            ->constrained('pelanggans')
            ->restrictOnDelete();

        $table->foreignId('layanan_id')
            ->constrained('layanans')
            ->restrictOnDelete();

        $table->foreignId('barber_id')
            ->constrained('barbers')
            ->restrictOnDelete();

        $table->foreignId('jadwal_id')
            ->constrained('jadwals')
            ->restrictOnDelete();

        $table->dateTime('tgl_pesan');
        $table->decimal('total_harga', 12, 2);

        $table->enum('status', [
            'menunggu',
            'dikonfirmasi',
            'selesai',
            'dibatalkan'
        ])->default('menunggu');

        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
