<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StateRequest;
use App\Services\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    protected $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    public function index(Request $request)
    {
        $states = $this->stateService->getAll($request->search);

        return view('admin.states.index', compact('states'));
    }

    public function create()
    {
        return view('admin.states.create');
    }

    public function store(StateRequest $request)
    {
        $this->stateService->store($request->validated());

        return redirect()
            ->route('admin.states.index')
            ->with('success', 'State created successfully.');
    }

    public function edit($id)
    {
        $state = $this->stateService->find($id);

        return view('admin.states.edit', compact('state'));
    }

    public function update(StateRequest $request, $id)
    {
        $this->stateService->update($id, $request->validated());

        return redirect()
            ->route('admin.states.index')
            ->with('success', 'State updated successfully.');
    }

    public function destroy($id)
    {
        $this->stateService->delete($id);

        return redirect()
            ->route('admin.states.index')
            ->with('success', 'State deleted successfully.');
    }
}