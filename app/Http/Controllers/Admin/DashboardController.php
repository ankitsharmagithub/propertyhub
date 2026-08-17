<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use App\Models\Category;
use App\Models\Blog;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalProperties' => Property::count(),
            'totalUsers'      => User::count(),
            'totalCategories' => Category::count(),
            'totalBlogs'      => Blog::count(),
        ]);
    }
}
