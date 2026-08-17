@extends('layouts.app')

@section('title','Dashboard')

@section('content')



<div class="dash-header">
    <div>
        <h2 class="page-title">Dashboard</h2>
        <p class="page-subtitle">Welcome back, {{ auth()->user()->name }} 👋</p>
    </div>
    <span class="dash-date">{{ now()->format('l, d M Y') }}</span>
</div>

<div class="row g-4">

    <div class="col-lg-3 col-md-6">
        <div class="stat-card stat-card--properties">
            <div class="stat-icon"><i class="bi bi-building"></i></div>
            <p class="stat-label">Properties</p>
            <h2 class="stat-value">{{ $totalProperties }}</h2>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card stat-card--users">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <p class="stat-label">Users</p>
            <h2 class="stat-value">{{ $totalUsers }}</h2>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card stat-card--categories">
            <div class="stat-icon"><i class="bi bi-tags"></i></div>
            <p class="stat-label">Categories</p>
            <h2 class="stat-value">{{ $totalCategories }}</h2>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card stat-card--blogs">
            <div class="stat-icon"><i class="bi bi-journal-text"></i></div>
            <p class="stat-label">Blogs</p>
            <h2 class="stat-value">{{ $totalBlogs }}</h2>
        </div>
    </div>

</div>

@endsection