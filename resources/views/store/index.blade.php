@extends('layouts.app')

@section('title', 'products')
@section('sidebar')
    <h1>Filters</h1>
    <hr>
    <form method="get">
        <div class="form-group">
            <label for="name">Name or description</label>
            <input type="text" name="name" id="name" value="{{Request::input('name')}}" class="form-control"
                   placeholder="Name">
        </div>
        <h3>Categories</h3>
        @php
    // Get the selected categories only once
    $categoriesIds = old('categories', Request::input('categories', []));
        @endphp

        @foreach($categories as $category)
            <div class="form-check">
                <input
                    type="checkbox"
                    name="categories[]"
                    value="{{ $category->id }}"
                    class="form-check-input"
                    {{ in_array($category->id, $categoriesIds) ? 'checked' : '' }}
                >
        <label class="form-check-label">{{ $category->name }}</label>
            </div>
        @endforeach
        <h3>Pricing</h3>
        <div class="form-group">
            <label for="min">Min</label>
            <input min="{{$priceOptions->minPrice}}" max="{{$priceOptions->maxPrice}}" type="number" name="min" id="min" value="{{Request::input('min')}}" class="form-control"
                   placeholder="Min price">
            <label for="max">Max</label>
            <input min="{{$priceOptions->minPrice}}" max="{{$priceOptions->maxPrice}}" type="number" name="max" id="max" value="{{Request::input('max')}}" class="form-control"
                   placeholder="Max price">
        </div>
    <div class="form-group my-2">
        <input type="submit" class="btn btn-primary" value="Filter">
        <a type="reset" class="btn btn-secondary" href="{{ route('home_page') }}">Reset</a>
    </div>
</form>
<hr>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Products</h1>

</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($products as $product)


    <div class="col">
      <div class="card h-100">
        <img class="card-img-top h-35" src="storage/{{$product->image}}" alt="">
        <div class="card-body">
          <h3 class="card-title">{{$product->name}}</h3>
          <p class="card-text">{{ Str::words($product->description, 20, '...see more') }}</p>
          <hr>
                        <div class="d-flex justify-content-between">
                            <span>Quantity:  <span class="badge bg-success">{{$product->quantity}}</span></span>
                            <span>

                            Price: <span class="badge bg-primary">{{$product->price}} EURO</span>
                            </span>
                        </div>
                        <div class="my 2">
                            <span>Category:  <span class="badge bg-success">{{$product->category?->name}}</span></span>

                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span><a href="{{ route('product.details',$product) }}" class="btn btn-primary">Details</a></span>
                            <span>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-outline-danger">❤️ Add to Wishlist</button>
                            </span>
                        </div>
        </div>

        <div>
            <small class="text-muted">{{$product->created_at}}</small>
        </div>

      </div>
    </div>
@endforeach
</div>
@endsection
