<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyPaymentPlan extends Model
{
    protected $fillable = [
        'property_id',
        'unit_type',
        'size',
        'size_unit',
        'price_per_sqft',
        'amount',
        'booking_amount',
        'description',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'size' => 'decimal:2',
        'price_per_sqft' => 'decimal:2',
        'amount' => 'decimal:2',
        'booking_amount' => 'decimal:2',
        'sort_order' => 'integer',
        'status' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}