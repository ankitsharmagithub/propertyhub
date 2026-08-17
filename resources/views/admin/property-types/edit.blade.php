@extends('layouts.app')

@section('title','Edit Property Type')

@section('content')

<div class="card">

    <div class="card-header">

        <h5>Edit Property Type</h5>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.property-types.update',$propertyType->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            @include('admin.property-types._form')

        </form>

    </div>

</div>

@endsection