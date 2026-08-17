<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    //
    protected $fillable = [
    'name',
    'slug',
    'sort_order',
    'status',
];

protected $casts = [
    'status' => 'boolean',
];

public function properties()
{
    return $this->hasMany(Property::class);
}
}
