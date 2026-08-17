<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Developer extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'website',
        'established_year',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'established_year' => 'integer',
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($developer) {
            if (empty($developer->slug)) {
                $developer->slug = Str::slug($developer->name);
            }
        });
    }
}