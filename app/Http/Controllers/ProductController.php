<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with("category", "productRate")->get();

        return ProductResource::collection($product);
        // return response()->json(['status' => true, "data" => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|int',
            'price' => 'required|string',
            "image" => 'required|string',
            "delivery_price" => 'required|string',
            "make_time" => 'required|string',
        ]);
        $product =  Product::create($request->all());
        return response()->json(['status' => true, "data" => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $product = Product::where('id', $id)->with("category", "productRate")->first();
        $productData =  new ProductResource($product);
        return response()->json(["status" => true, "data" => $productData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $product = Product::where('id', $id)->first();
        $product->update($request->all());
        $product = Product::where('id', $id)->with("category", "productRate")->first();
        $productData =  new ProductResource($product);
        return response()->json(["status" => true, "data" => $productData]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return response()->json(["status" => true,]);
    }
}
