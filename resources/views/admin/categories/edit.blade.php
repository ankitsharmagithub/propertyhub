@extends('layouts.app')

@section('title','Edit Category')

@section('content')

<h3 class="mb-4">Edit Category</h3>

<form action="{{ route('admin.categories.update',$category->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('admin.categories._form')

</form>

@endsection