@extends('users.admin.app')

@section('title', 'Create Category')


@section('content')

<h1>@yield('title')</h1>




<form action="{{ route('categories.store') }} " method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
</div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Create">
  </div>

</form>


@endsection

