@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">Edit Property</h4>
        </div>

        <div class="card-body">

            <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data" id="propertyForm">

                @csrf
                @method('PUT')

                @include('property._form')

            </form>

        </div>

    </div>

@endsection
