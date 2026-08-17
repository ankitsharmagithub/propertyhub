<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyFloorPlan extends Model
{
    protected $fillable = [
        'property_id',
        'title',
        'configuration',
        'area',
        'area_unit',
        'price',
        'image',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'price' => 'decimal:2',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}