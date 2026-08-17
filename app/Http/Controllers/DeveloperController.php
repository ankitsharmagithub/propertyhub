<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeveloperController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = true;

        $developer = Developer::create($validated);

        return response()->json([
            'success' => true,
            'developer' => [
                'id' => $developer->id,
                'name' => $developer->name,
            ],
            'message' => 'Developer added successfully.',
        ]);
    }
}