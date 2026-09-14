<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farmer extends Model
{
    protected $fillable = [
        'user_id',
        'farmer_id',
        'phone',
        'address',
        'cow_rate',
        'buffalo_rate',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function milkEntries(): HasMany
    {
        return $this->hasMany(MilkEntry::class);
    }
}