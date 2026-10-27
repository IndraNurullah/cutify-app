<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $fillable = [
        'booking_id',
        'metode',
        'total',
        'status_bayar',
        'referensi_transaksi',
        'dibayar_pada',
    ];

    protected function casts(): array
    {
        return [
            'total' => 'decimal:2',
            'dibayar_pada' => 'datetime',
        ];
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
