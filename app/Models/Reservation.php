<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Reservation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'guests',
        'price_per_night',
        'total_price',
        'status',
        'notes',
        'admin_notes',
        'confirmed_at',
        'cancelled_at',
        'checked_in_at',
        'checked_out_at',
    ];

    protected $casts = [
        'check_in'       => 'date',
        'check_out'      => 'date',
        'confirmed_at'   => 'datetime',
        'cancelled_at'   => 'datetime',
        'checked_in_at'  => 'datetime',
        'checked_out_at' => 'datetime',
        'price_per_night' => 'decimal:2',
        'total_price'    => 'decimal:2',
    ];

    // ─── Relacionamentos ──────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    // ─── Helpers ──────────────────────────────────────────────────

    public function getNightsAttribute(): int
    {
        return $this->check_in->diffInDays($this->check_out);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'R$ ' . number_format($this->total_price, 2, ',', '.');
    }
}
