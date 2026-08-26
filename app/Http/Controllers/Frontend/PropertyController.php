<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\City;
use App\Models\Category;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\PropertyType;

class PropertyController extends Controller
{
    /**
     * Show all properties (with filters & pagination)
     */
    public function index(Request $request)
    {
        $query = Property::with([
            'category',
            'propertyType',
            'state',
            'city'
        ])->where('status', 1);

        $query = $this->applyListingFilters($query, $request);

        $properties = $query->latest()->paginate(12)->withQueryString();

        return view('frontend.properties.index', compact('properties'));
    }

    /**
     * Show properties for a specific city
     */
    public function city(Request $request, string $citySlug)
    {
        $city = City::where('slug', $citySlug)->firstOrFail();

        $query = Property::with([
            'category',
            'propertyType',
            'state',
            'city'
        ])
        ->where('status', 1)
        ->where('city_id', $city->id);

        $query = $this->applyListingFilters($query, $request);

        $properties = $query->latest()->paginate(12)->withQueryString();

        return view('frontend.properties.index', [
            'properties' => $properties,
            'city'       => $city,
        ]);
    }

    /**
     * Handle city + slug: either category listing or property detail
     */
        public function citySlug(Request $request, string $citySlug, string $slug)
    {
        $city = City::where('slug', $citySlug)->firstOrFail();

        // 1. Check if slug is a category
        $category = Category::where('slug', $slug)
                            ->where('status', 1)
                            ->first();

        if ($category) {
            // City + Category listing
            $query = Property::with([
                'category',
                'propertyType',
                'state',
                'city'
            ])
            ->where('status', 1)
            ->where('city_id', $city->id)
            ->where('category_id', $category->id);

            $query = $this->applyListingFilters($query, $request);

            $properties = $query->latest()->paginate(12)->withQueryString();

            return view('frontend.properties.index', [
                'properties' => $properties,
                'city'       => $city,
                'category'   => $category,
            ]);
        }

        // 2. Not a category – try property detail (must belong to city)
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
        ->where('city_id', $city->id)
        ->first();

        if ($property) {


            $similarProperties = Property::where('city_id', $property->city_id)
                ->where('id', '!=', $property->id)
                ->where('status', 1)
                ->limit(4)
                ->get();


            if ($similarProperties->isEmpty()) {
                $similarProperties = Property::where('status', 1)
                    ->where('id', '!=', $property->id)
                    ->latest()
                    ->limit(4)
                    ->get();
            }

            return view('frontend.properties.show', compact('property', 'similarProperties'));
        }

        // 3. Neither category nor property found -> 404
        abort(404);
    }

    /**
     * Live city/state search (AJAX)
     */
    public function locations(Request $request)
    {
        $search = trim($request->get('q', ''));

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
            ->where('name', 'like', "%{$search}%")
            ->with('state')
            ->limit(8)
            ->get()
            ->map(function ($city) {
                return [
                    'id'         => $city->id,
                    'name'       => $city->name,
                    'type'       => 'city',
                    'city_id'    => $city->id,
                    'state_id'   => $city->state_id,
                    'state_name' => $city->state?->name,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | States
        |--------------------------------------------------------------------------
        */
        $states = State::query()
            ->where('name', 'like', "%{$search}%")
            ->limit(5)
            ->get()
            ->map(function ($state) {
                return [
                    'id'         => $state->id,
                    'name'       => $state->name,
                    'type'       => 'state',
                    'city_id'    => null,
                    'state_id'   => $state->id,
                    'state_name' => $state->name,
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | Merge Cities + States
        |--------------------------------------------------------------------------
        */
        $locations = $cities->concat($states)->values();

        return response()->json($locations);
    }
public function byType(Request $request, string $typeSlug)
{
    $type = PropertyType::where('slug', $typeSlug)->firstOrFail();

    $query = Property::with(['category', 'propertyType', 'state', 'city'])
        ->where('status', 1)
        ->where('property_type_id', $type->id);

    $query = $this->applyListingFilters($query, $request);

    $properties = $query->latest()->paginate(12)->withQueryString();

    return view('frontend.properties.index', [
        'properties'   => $properties,
        'propertyType' => $type,
    ]);
}

    // -------------------------------------------------------------------------
    // Private Helpers
    // -------------------------------------------------------------------------

    /**
     * Apply all common filters to a property query builder.
     * Keeps logic DRY and reusable across listing methods.
     */
    private function applyListingFilters(Builder $query, Request $request): Builder
    {
        // Buy / Rent / Lease
        if ($request->filled('listing_type')) {
            $query->where('listing_type', $request->listing_type);
        }

        // Search city, state, title, project, address, property code
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('property_code', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhereHas('city', function ($cityQuery) use ($search) {
                      $cityQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('state', function ($stateQuery) use ($search) {
                      $stateQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Exact City
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // Exact State
        if ($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }

        // Property Type
        if ($request->filled('property_type_id')) {
            $query->where('property_type_id', $request->property_type_id);
        }

        // Budget
        if ($request->filled('budget')) {
            $budget = $request->budget;
            switch ($budget) {
                case '0-50':
                    $query->where('price', '<', 5000000);
                    break;
                case '50-100':
                    $query->whereBetween('price', [5000000, 10000000]);
                    break;
                case '100+':
                    $query->where('price', '>', 10000000);
                    break;
            }
        }

        return $query;
    }
}
