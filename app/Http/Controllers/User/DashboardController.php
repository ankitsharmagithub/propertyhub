<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::where(
            'user_id',
            Auth::id()
        )->count();

        return view('user.dashboard', [
            'totalProperties' => $totalProperties,
        ]);
    }
}