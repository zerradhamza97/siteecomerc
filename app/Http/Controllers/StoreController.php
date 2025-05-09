<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productsQuery = Product::query()->with('category');
        //$max = Product::query()->max('price');
        //$min = Product::query()->min('price');
        $categories = Category::with('products')->has('products')->get();
        $name = ($request->input('name'));
        $max = ($request->input('max'));
        $min = ($request->input('min')) ?? 0;
        $categoriesIds = ($request->input('categories'));
        if (!empty($name)) {
            $productsQuery->where('name', 'like', "%{$name}%");
        }

        if (!empty($categoriesIds)) {
            $productsQuery->whereIn('category_id', $categoriesIds);
        }
        $productsQuery->where('price', '>=', $min);

        if (!empty($max)) {
            $productsQuery->where('price', '<=', $max);
        }

        $products = $productsQuery->get();
        $prices = $products->pluck('price')->all();

        $priceOptions = new \StdClass();

        $priceOptions->minPrice = 0;
        $priceOptions->maxPrice = 0;
        if(!empty($prices)) {
            $priceOptions->minPrice = min($prices);
            $priceOptions->maxPrice = max($prices);
        }

        return view('store.index', compact(
            'products',
            'categories',
            'priceOptions',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        //$product->quantity = 1;
        $product->fill([
            'quantity' => 1,
            'price' => 100,
        ]);

        return view('product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $formFields =$request->validated();
        if($request->hasFile('image')){
            $formFields['image'] =$request->file('image')->store('product', 'public');
        }
        Product::create($formFields);
        return to_route('products.index')->with('success','Product Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //dd($product);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $formFields= $request->validated();
        $product->fill($request->validated())->save();
        return to_route('products.index')->with('success','Product Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('products.index')->with('success','Product Delete Successfully');
    }
}
