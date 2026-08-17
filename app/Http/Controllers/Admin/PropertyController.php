<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyRequest;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\City;
use App\Models\PropertyType;
use App\Models\State;
use App\Services\PropertyService;
use Illuminate\Http\Request;
use App\Models\Developer;

class PropertyController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    /**
     * Property List
     */
    public function index(Request $request)
    {
        $properties = $this->propertyService->getAll($request->search);

        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Create Property
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
        'formAction' => route('admin.properties.store'),

        'indexRoute' => route('admin.properties.index'),

        'galleryStoreRoute' => null,

        'galleryDeleteRoute' =>
            'admin.properties.gallery.destroy',
    ]);
}
    /**
     * Store Property
     */
    public function store(PropertyRequest $request)
    {
    $data = $request->validated();
    

        try {

            $this->propertyService->store(
                $request->validated()
            );

            return redirect()
                ->route('admin.properties.index')
                ->with('success','Property created successfully.');

        } catch (\Exception $e){

            return back()
                ->withInput()
                ->with('error',$e->getMessage());

        }
    }

    /**
     * Edit Property
     */
    public function edit($id)
{
    $property = $this->propertyService->find($id);

    $categories = Category::where('status', 1)
        ->orderBy('name')
        ->get();

    $propertyTypes = PropertyType::where('status', 1)
        ->orderBy('name')
        ->get();

    $states = State::where('status', 1)
        ->orderBy('name')
        ->get();

    $cities = City::where('state_id', $property->state_id)
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
        'formAction' => route(
            'admin.properties.update',
            $property->id
        ),

        'indexRoute' => route(
            'admin.properties.index'
        ),

        'galleryStoreRoute' => route(
            'admin.properties.gallery.store',
            $property->id
        ),

        'galleryDeleteRoute' =>
            'admin.properties.gallery.destroy',
    ]);
}

    /**
     * Update Property
     */
    public function update(PropertyRequest $request, $id)
    {
        try {

            $this->propertyService->update(
                $id,
                $request->validated()
            );

            return redirect()
                ->route('admin.properties.index')
                ->with('success','Property updated successfully.');

        } catch (\Exception $e){

            return back()
                ->withInput()
                ->with('error',$e->getMessage());

        }
    }

    /**
     * Get Cities by State (AJAX)
     */
    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)
            ->where('status',1)
            ->orderBy('name')
            ->get(['id','name']);

        return response()->json($cities);
    }

    /**
     * Delete Property
     */
    public function destroy($id)
    {
        try {

            $this->propertyService->delete($id);

            return redirect()
                ->route('admin.properties.index')
                ->with('success','Property deleted successfully.');

        } catch (\Exception $e){

            return back()
                ->with('error',$e->getMessage());

        }
    }
}