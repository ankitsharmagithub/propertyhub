<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function show($slug)
    {
        $developer = Category::where('slug', $slug)->where('status', 1)->firstOrFail();

        $properties = Property::where('category_id', $developer->id)
                              ->where('status', 1)
                              ->orderBy('created_at', 'desc')
                              ->paginate(12);

        return view('frontend.developer.show', compact('developer', 'properties'));
    }
}
