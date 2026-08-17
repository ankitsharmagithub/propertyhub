<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AmenityRequest;
use App\Services\AmenityService;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    protected $amenityService;

    public function __construct(AmenityService $amenityService)
    {
        $this->amenityService = $amenityService;
    }

    public function index(Request $request)
    {
        $amenities = $this->amenityService->getAll($request->search);

        return view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenities.create');
    }

    public function store(AmenityRequest $request)
    {
        $this->amenityService->store($request->validated());

        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenity created successfully.');
    }

    public function edit($id)
    {
        $amenity = $this->amenityService->find($id);

        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(AmenityRequest $request, $id)
    {
        $this->amenityService->update($id, $request->validated());

        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenity updated successfully.');
    }

    public function destroy($id)
    {
        $this->amenityService->delete($id);

        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenity deleted successfully.');
    }
}