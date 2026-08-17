<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::with([
            'category',
            'propertyType',
            'state',
            'city'
        ])
        ->where('status', 1)

        ->when($request->search, function ($query, $search) {

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere(
                        'property_code',
                        'like',
                        "%{$search}%"
                    );

            });

        })

        ->when($request->city_id, function ($query, $cityId) {
            $query->where('city_id', $cityId);
        })

        ->when($request->state_id, function ($query, $stateId) {
            $query->where('state_id', $stateId);
        })

        ->when($request->property_type_id, function ($query, $typeId) {
            $query->where(
                'property_type_id',
                $typeId
            );
        })

        ->latest()
        ->paginate(12)
        ->withQueryString();

        return view(
            'frontend.properties.index',
            compact('properties')
        );
    }

    public function show($slug)
    {
        $property = Property::with([
            'category',
            'propertyType',
            'state',
            'city',
            'amenities',
            'images',
            'user'
        ])
        ->where('status', 1)
        ->where('slug', $slug)
        ->firstOrFail();

        return view(
            'frontend.properties.show',
            compact('property')
        );
    }
}