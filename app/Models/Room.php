<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'number',
        'name',
        'type',
        'price_per_night',
        'status',
        'capacity',
        'description',
        'amenities',
        'image_url',
    ];

    protected $casts = [
        'amenities'       => 'array',
        'price_per_night' => 'decimal:2',
    ];

    // ─── Relacionamentos ──────────────────────────────────────────

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────

    public function isAvailable(): bool
    {
        return $this->status === 'disponivel';
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'R$ ' . number_format($this->price_per_night, 2, ',', '.');
    }
}
