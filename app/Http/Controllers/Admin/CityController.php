<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\State;
use App\Services\CityService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function index(Request $request)
    {
        $cities = $this->cityService->getAll($request->search);

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $states = State::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.cities.create', compact('states'));
    }

    public function store(CityRequest $request)
    {
        $this->cityService->store($request->validated());

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City created successfully.');
    }

    public function edit($id)
    {
        $city = $this->cityService->find($id);

        $states = State::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function update(CityRequest $request, $id)
    {
        $this->cityService->update($id, $request->validated());

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City updated successfully.');
    }

    public function destroy($id)
    {
        $this->cityService->delete($id);

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City deleted successfully.');
    }
}