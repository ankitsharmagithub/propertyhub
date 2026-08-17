<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;

class City extends Model
{
    //
    protected $fillable = [
    'state_id',
    'name',
    'slug',
    'status',
];

protected $casts = [
    'status' => 'boolean',
];

public function state()
{
    return $this->belongsTo(State::class);
}

public function properties()
{
    return $this->hasMany(Property::class);
}
}
