@extends('users.admin.app')

@section('title', 'Edit Category')


@section('content')

<h1>@yield('title')</h1>




<form action="{{ route('categories.update', $category) }} " method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" value="{{old('name', $category->name)}}">
</div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Create">
  </div>

</form>


@endsection

