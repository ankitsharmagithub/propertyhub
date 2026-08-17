@extends('layouts.app')

@section('title','Add Amenity')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Add Amenity</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.amenities.store') }}" method="POST">

            @csrf

            @include('admin.amenities._form')

        </form>

    </div>

</div>

@endsection