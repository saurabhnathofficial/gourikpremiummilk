<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Farmer;

class MilkEntry extends Model
{
    protected $fillable = [
        'farmer_id',
        'entry_date',

        'cow_morning',
        'cow_morning_rate',

        'cow_evening',
        'cow_evening_rate',

        'buffalo_morning',
        'buffalo_morning_rate',

        'buffalo_evening',
        'buffalo_evening_rate',
    ];

    protected $casts = [
        'entry_date' => 'date',

        'cow_morning' => 'decimal:2',
        'cow_morning_rate' => 'decimal:2',

        'cow_evening' => 'decimal:2',
        'cow_evening_rate' => 'decimal:2',

        'buffalo_morning' => 'decimal:2',
        'buffalo_morning_rate' => 'decimal:2',

        'buffalo_evening' => 'decimal:2',
        'buffalo_evening_rate' => 'decimal:2',
    ];

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(Farmer::class);
    }
}