@extends('users.admin.app')

@section('title', 'Edit Products')


@section('content')

<h1>@yield('title')</h1>




<form action="{{ route('products.update', $product->id) }} " method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" value="{{old('name',$product->name)}}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea type="text" name="description" id="description" class="form-control">{{old('description', $product->description)}}</textarea>
  </div>
  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="text" name="quantity" id="quantity" class="form-control" min="1" max="100"  value="{{old('quantity', $product->quantity)}}">
  </div>
  <div class="form-group">
    <label for="image" class="form-label">Image</label>
    <input type="file" name="image" id="image" class="form-control">
    @if($product)
        <img width="100px" src="/storage/{{$product->image}}" alt="">
    @endif
</div>
  <div class="form-group">
    <label for="price">Price</label>
    <input type="text" name="price" id="price" class="form-control" value="{{old('price', $product->price)}}">
  </div>
  <div class="form-group">
    <label for="Categories">Category</label>
    <select name="category_id" id="category_id" class="form-select">
        <option> Please choose you category</option>
        @foreach ($categories as $category)
        <option @selected(old('category_id', $product->category_id === $category->id)) value="{{ $category->id }}"> {{ $category->name }}</option>

        @endforeach
    </select>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary w-100" value="Update">
  </div>

</form>


@endsection

