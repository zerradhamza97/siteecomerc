<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->with('category')->paginate(10);
        return view('users.admin.product.index', compact('products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        //$product->quantity = 1;
        $product->fill([
            'quantity' => 1,
            'price' => 100,
        ]);

        return view('users.admin.product.create', compact('product','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $formFields = $request->validated();

        $formFields['image']=$this->uploadFile($request);

        Product::create($formFields);

        return to_route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //dd($request->id);
        $id= $request->id;
        $product = Product::find($id);
        //$products = Product::find($request->id);
        //dd($product);
        return view('users.admin.product.details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //dd($product);
        $categories = Category::all();
        return view('users.admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $formFields = $request->validated();

        $formFields['image']=$this->uploadFile($request);

        $product->fill($formFields)->save();

        return to_route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return to_route('products.index')->with('success','Product Delete Successfully');
    }


    public function uploadFile($request){
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product', 'public');
        }

        return $formFields['image'];
    }
    /*public function product_details($request){
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('product', 'public');
        }

        return $formFields['image'];
    }*/

    /*public function products_details($product_slug)
    {
        $product = Product::where('slug', $product_slug)->first();
        return view('users.admin.product.details', compact('product'));
    }*/

}
