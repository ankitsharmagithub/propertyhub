<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\City;
use App\Models\State;
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

        // Buy / Rent / Lease
        ->when($request->listing_type, function ($query, $listingType) {

            $query->where('listing_type', $listingType);

        })

        // Search city, state, title, project, address, property code
        ->when($request->search, function ($query, $search) {

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")

                    ->orWhere(
                        'property_code',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'address',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhereHas('city', function ($cityQuery) use ($search) {

                        $cityQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    })

                    ->orWhereHas('state', function ($stateQuery) use ($search) {

                        $stateQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );

                    });

            });

        })

        // Exact City
        ->when($request->city_id, function ($query, $cityId) {

            $query->where(
                'city_id',
                $cityId
            );

        })

        // Exact State
        ->when($request->state_id, function ($query, $stateId) {

            $query->where(
                'state_id',
                $stateId
            );

        })

        // Property Type
        ->when($request->property_type_id, function ($query, $typeId) {

            $query->where(
                'property_type_id',
                $typeId
            );

        })

        // Budget
        ->when($request->budget, function ($query, $budget) {

            switch ($budget) {

                case '0-50':

                    $query->where(
                        'price',
                        '<',
                        5000000
                    );

                    break;

                case '50-100':

                    $query->whereBetween(
                        'price',
                        [
                            5000000,
                            10000000
                        ]
                    );

                    break;

                case '100+':

                    $query->where(
                        'price',
                        '>',
                        10000000
                    );

                    break;
            }

        })

        ->latest()
        ->paginate(12)
        ->withQueryString();


        return view(
            'frontend.properties.index',
            compact('properties')
        );
    }


    /**
     * Live city/state search
     */
    public function locations(Request $request)
    {
        $search = trim(
            $request->get('q', '')
        );


        // Don't search for less than 2 characters
        if (strlen($search) < 2) {

            return response()->json([]);

        }


        /*
        |--------------------------------------------------------------------------
        | Cities
        |--------------------------------------------------------------------------
        */

        $cities = City::query()

            ->where(
                'name',
                'like',
                "%{$search}%"
            )

            ->with('state')

            ->limit(8)

            ->get()

            ->map(function ($city) {

                return [

                    'id' => $city->id,

                    'name' => $city->name,

                    'type' => 'city',

                    'city_id' => $city->id,

                    'state_id' => $city->state_id,

                    'state_name' => $city->state?->name,

                ];

            });


        /*
        |--------------------------------------------------------------------------
        | States
        |--------------------------------------------------------------------------
        */

        $states = State::query()

            ->where(
                'name',
                'like',
                "%{$search}%"
            )

            ->limit(5)

            ->get()

            ->map(function ($state) {

                return [

                    'id' => $state->id,

                    'name' => $state->name,

                    'type' => 'state',

                    'city_id' => null,

                    'state_id' => $state->id,

                    'state_name' => $state->name,

                ];

            });


        /*
        |--------------------------------------------------------------------------
        | Merge Cities + States
        |--------------------------------------------------------------------------
        */

        $locations = $cities
            ->concat($states)
            ->values();


        return response()->json(
            $locations
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