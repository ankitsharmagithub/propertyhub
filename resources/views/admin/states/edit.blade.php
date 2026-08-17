@extends('layouts.app')

@section('title','Edit State')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Edit State</h5>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.states.update',$state->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('admin.states._form')

        </form>

    </div>

</div>

@endsection