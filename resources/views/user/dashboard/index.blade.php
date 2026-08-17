@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="dash-header">
    <div>
        <h2 class="page-title">Dashboard</h2>
        <p class="page-subtitle">
            Welcome back, {{ auth()->user()->name }} 👋
        </p>
    </div>

    <span class="dash-date">
        {{ now()->format('l, d M Y') }}
    </span>
</div>

<div class="row g-4">

    {{-- My Properties --}}
    <div class="col-lg-4 col-md-6">
        <div class="stat-card stat-card--properties">

            <div class="stat-icon">
                <i class="bi bi-building"></i>
            </div>

            <p class="stat-label">
                My Properties
            </p>

            <h2 class="stat-value">
                {{ $totalProperties }}
            </h2>

        </div>
    </div>

</div>

@endsection