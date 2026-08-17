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

        return view('frontend.home.index', compact(
            'featuredProperties',
            'latestProperties',
            'cities',
            'categories'
        ));
    }
}