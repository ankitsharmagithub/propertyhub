<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = Property::with([
            'category',
            'propertyType',
            'state',
            'city'
        ])
        ->where('status', 1)
        ->where('featured', 1)
        ->latest()
        ->take(8)
        ->get();

        $latestProperties = Property::with([
            'category',
            'propertyType',
            'state',
            'city'
        ])
        ->where('status', 1)
        ->latest()
        ->take(6)
        ->get();

        $cities = City::where('status', 1)
            ->orderBy('name')
            ->take(12)
            ->get();

        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->take(8)
            ->get();

        // =========================================================
        // 5. 👇 NEW: Static City Sections (e.g., Ghaziabad, Noida, Delhi)
        // =========================================================
        $citySlugs = ['ghaziabad', 'noida', 'delhi']; // Add/Remove city slugs as needed

        $homeCityData = [];

        foreach ($citySlugs as $slug) {
            $city = City::where('slug', $slug)->first();

            if ($city) {
                $properties = Property::with(['city', 'state'])
                    ->where('city_id', $city->id)
                    ->where('status', 1)
                    ->latest()
                    ->limit(4)
                    ->get();

                // Fallback: If no properties in this city, show latest properties overall
                if ($properties->isEmpty()) {
                    $properties = Property::with(['city', 'state'])
                        ->where('status', 1)
                        ->latest()
                        ->limit(4)
                        ->get();
                }

                $homeCityData[$slug] = [
                    'city'       => $city,
                    'properties' => $properties,
                ];
            }
        }
        // =========================================================
        // 6. 👆 End of new block
        // =========================================================

        return view('frontend.home.index', compact(
            'featuredProperties',
            'latestProperties',
            'cities',
            'categories',
            'homeCityData'
        ));
    }
}
