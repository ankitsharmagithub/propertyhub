<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyLandmark extends Model
{
    protected $fillable = [
        'property_id',
        'name',
        'distance',
        'distance_unit',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'distance' => 'decimal:2',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}