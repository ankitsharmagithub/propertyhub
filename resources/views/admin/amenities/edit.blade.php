@extends('layouts.app')

@section('title','Edit Amenity')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Edit Amenity</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.amenities.update',$amenity->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('admin.amenities._form')

        </form>

    </div>

</div>

@endsection