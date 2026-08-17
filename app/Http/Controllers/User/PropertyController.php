<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\City;
use App\Models\PropertyType;
use App\Models\State;
use App\Services\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Developer;

class PropertyController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    /*
    |--------------------------------------------------------------------------
    | Property List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $properties = $this->propertyService->getAll(
            $request->search,
            Auth::id()
        );
        

        return view(
            'user.properties.index',
            compact('properties')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create Property
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $propertyTypes = PropertyType::where('status', 1)
            ->orderBy('name')
            ->get();

        $states = State::where('status', 1)
            ->orderBy('name')
            ->get();

        // Create page par initially koi city load nahi hogi
        $cities = collect();

        $amenities = Amenity::where('status', 1)
            ->orderBy('name')
            ->get();
            $developers = Developer::where('status', true)
    ->orderBy('name')
    ->get();

        return view('property.create', compact(
            'categories',
            'propertyTypes',
            'states',
            'cities',
            'amenities',
            'developers'
        ))->with([

            // User create route
            'formAction' => route(
                'user.properties.store'
            ),

            // Back / Cancel
            'indexRoute' => route(
                'user.properties.index'
            ),

            // Create page par property ID nahi hai
            'galleryStoreRoute' => null,

            // Gallery delete route
            'galleryDeleteRoute' =>
                'user.properties.gallery.destroy',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store Property
    |--------------------------------------------------------------------------
    */

    public function store(PropertyRequest $request)
    {
        try {

            $this->propertyService->store(
                $request->validated()
            );

            return redirect()
                ->route('user.properties.index')
                ->with(
                    'success',
                    'Property created successfully.'
                );

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Property
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        | User sirf apni property edit kar sakega.
        */

        $property = $this->propertyService->find(
            $id,
            Auth::id()
        );

        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $propertyTypes = PropertyType::where('status', 1)
            ->orderBy('name')
            ->get();

        $states = State::where('status', 1)
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Only selected state's cities
        |--------------------------------------------------------------------------
        */

        $cities = City::where(
                'state_id',
                $property->state_id
            )
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        $amenities = Amenity::where('status', 1)
            ->orderBy('name')
            ->get();
             $developers = Developer::where('status', true)
             ->orderBy('name')
             ->get();

        return view('property.edit', compact(
            'property',
            'categories',
            'propertyTypes',
            'states',
            'cities',
            'amenities',
            'developers'
        ))->with([

            // User update route
            'formAction' => route(
                'user.properties.update',
                $property->id
            ),

            // Cancel / Back
            'indexRoute' => route(
                'user.properties.index'
            ),

            // User gallery upload route
            'galleryStoreRoute' => route(
                'user.properties.gallery.store',
                $property->id
            ),

            // User gallery delete route
            'galleryDeleteRoute' =>
                'user.properties.gallery.destroy',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Property
    |--------------------------------------------------------------------------
    */

    public function update(
        PropertyRequest $request,
        $id
    ) {
        $this->propertyService->update(
            $id,
            $request->validated(),
            Auth::id()
        );

        return redirect()
            ->route('user.properties.index')
            ->with(
                'success',
                'Property updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Property
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $this->propertyService->delete(
            $id,
            Auth::id()
        );

        return redirect()
            ->route('user.properties.index')
            ->with(
                'success',
                'Property deleted successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Get Cities By State
    |--------------------------------------------------------------------------
    */

    public function getCities($stateId)
    {
        $cities = City::where(
                'state_id',
                $stateId
            )
            ->where('status', 1)
            ->orderBy('name')
            ->get([
                'id',
                'name'
            ]);

        return response()->json($cities);
    }
}