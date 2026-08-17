@extends('layouts.app')

@section('title','Edit City')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Edit City</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.cities.update',$city->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('admin.cities._form')

        </form>

    </div>

</div>

@endsection