<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyTypeRequest;
use App\Services\PropertyTypeService;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    protected $propertyTypeService;

    public function __construct(PropertyTypeService $propertyTypeService)
    {
        $this->propertyTypeService = $propertyTypeService;
    }

    public function index(Request $request)
    {
        $propertyTypes = $this->propertyTypeService->getAll($request->search);

        return view('admin.property-types.index', compact('propertyTypes'));
    }

    public function create()
    {
        return view('admin.property-types.create');
    }

    public function store(PropertyTypeRequest $request)
    {
        $this->propertyTypeService->store($request->validated());

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type created successfully.');
    }

    public function edit($id)
    {
        $propertyType = $this->propertyTypeService->find($id);

        return view('admin.property-types.edit', compact('propertyType'));
    }

    public function update(PropertyTypeRequest $request, $id)
    {
        $this->propertyTypeService->update($id, $request->validated());

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type updated successfully.');
    }

    public function destroy($id)
    {
        $this->propertyTypeService->delete($id);

        return redirect()
            ->route('admin.property-types.index')
            ->with('success', 'Property type deleted successfully.');
    }
}