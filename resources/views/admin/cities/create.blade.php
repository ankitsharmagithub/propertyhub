@extends('layouts.app')

@section('title','Add City')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Add City</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.cities.store') }}" method="POST">

            @csrf

            @include('admin.cities._form')

        </form>

    </div>

</div>

@endsection