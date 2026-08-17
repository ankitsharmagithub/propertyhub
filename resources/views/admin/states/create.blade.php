@extends('layouts.app')

@section('title','Add State')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Add State</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.states.store') }}" method="POST">

            @csrf

            @include('admin.states._form')

        </form>

    </div>

</div>

@endsection