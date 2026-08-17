<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
    'name',
    'slug',
    'icon',
    'image',
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
