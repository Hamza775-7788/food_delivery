<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use PDOException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();

        return response()->json(['status' => true, "data" => $categorys]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                "image" => 'required|string',
            ]);
            $category = Category::create($request->all());
            return response()->json(['status' => true, "data" => $category]);
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return response()->json(['status' => false, "message" => "Duplicate"]);
            } else {
                return response()->json(['status' => false, "data" => $e->errorInfo]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = Category::where("id", $id)->first();
        return response()->json(['status' => true, "data" => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $category = Category::where("id", $id)->first();
        $category->update($request->all());

        return response()->json(['status' => true, "data" => $category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where("id", $id)->first();
        $category->delete();

        return response()->json(['status' => true]);
    }

    public function getProduct(int $id)
    {
        $category = Category::with(['products.productRate', 'products.category'])->findOrFail($id);

        return ProductResource::collection($category['products']);
        // return response()->json(['status' => true, "data" => $category['products']]);
    }
}
