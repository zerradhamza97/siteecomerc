@extends('layouts.app')

@section('title', 'Product Details')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-5" style="padding-right: 50px;">
                        <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-6">
                        <h1>{{ $product->name }}</h1>
                        <p style="margin-top: 50px; font-size: 18px;">{{ $product->description }}</p>
                        <div class="d-flex justify-content-between">
                        <span>
                            <h3 style="margin-top: 50px;" class="text-success">{{$product->price}} EURO</h3>
                        </span>
                        <span>
                            <form method="POST" action="{{ route('wishlist.add') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}" />
                            <input type="hidden" name="name" value="{{ $product->name }}" />
                            <input type="hidden" name="name" value="{{ $product->quantity }}" />
                            <input type="hidden" name="name" value="{{ $product->price }}" />
                            <button style="margin-top: 50px;" type="submit" class="btn btn-outline-danger">❤️ Add to Wishlist</button>
                            </form>
                        </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span style="margin: 25px;">Quantity:  <h4 class="badge bg-success">{{$product->quantity}}</h4></span>
                            <span style="margin: 25px;">
                                <span >Category:  <h4 class="badge bg-primary">{{$product->category?->name}}</h4></span>
                            </span>
                        </div>
                        <hr>
                        <span style="margin-top: 50px;">
                            <a href="{{ route('home_page') }}" class="btn btn-secondary mt-3">Back to Shop</a>
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@endsection
