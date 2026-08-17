@extends('layouts.app')

@section('title','Add Property Type')

@section('content')

<div class="card">

    <div class="card-header">

        <h5>Add Property Type</h5>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.property-types.store') }}"
            method="POST">

            @csrf

            @include('admin.property-types._form')

        </form>

    </div>

</div>

@endsection