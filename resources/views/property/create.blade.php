@extends('layouts.app')

@section('title','Add Property')

@section('content')

<div class="card">

    <div class="card-header">

        <h5>Add Property</h5>

    </div>

    <div class="card-body">

        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">

            @csrf

            @include('property._form')

        </form>

    </div>

</div>

@endsection