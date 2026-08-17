@extends('layouts.app')
@section('title','Create Category')

@section('content')

<h3 class="mb-4">Create Category</h3>

<form action="{{ route('admin.categories.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    @include('admin.categories._form')

</form>

@endsection