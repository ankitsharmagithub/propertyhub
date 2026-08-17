<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    protected $fillable = [
    'name',
    'slug',
    'code',
    'status',
];

protected $casts = [
    'status' => 'boolean',
];

public function cities()
{
    return $this->hasMany(City::class);
}

public function properties()
{
    return $this->hasMany(Property::class);
}
}
