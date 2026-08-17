<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Property extends Model
{
    protected $fillable = [
        'property_code',
        'user_id',
        'category_id',
        'property_type_id',
        'state_id',
        'city_id',
        'title',
        'slug',
        'short_description',
        'description',
        'price',
        'bedrooms',
        'bathrooms',
        'balconies',
        'parking',
        'floor',
        'total_floors',
        'area',
        'area_unit',
        'address',
        'pincode',
        'latitude',
        'longitude',
        'featured_image',
        'featured',
        'availability',
        'status',
        'views',
        'meta_title',
        'meta_description',
        'developer_id',
        'project_status',
        'possession_date',
        'rera_number',
        'rera_status',
        'listing_type',
    ];
    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
        'price' => 'decimal:2',
        'area' => 'decimal:2',
        'possession_date' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function amenities()
{
    return $this->belongsToMany(
        Amenity::class,
        'property_amenity',
        'property_id',
        'amenity_id'
    );
}

    public function images()
{
    return $this->hasMany(PropertyImage::class)
                ->orderBy('sort_order');
}
public function developer()
{
    return $this->belongsTo(Developer::class);
}
public function floorPlans()
{
    return $this->hasMany(PropertyFloorPlan::class)
        ->orderBy('sort_order');
}
public function paymentPlans()
{
    return $this->hasMany(PropertyPaymentPlan::class)
        ->orderBy('sort_order');
}
public function specifications()
{
    return $this->hasMany(PropertySpecification::class)
        ->orderBy('sort_order');
}
public function landmarks()
{
    return $this->hasMany(PropertyLandmark::class)
        ->orderBy('sort_order');
}
public function documents()
{
    return $this->hasMany(PropertyDocument::class)
        ->orderBy('sort_order');
}
}