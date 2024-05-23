<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "brand" => "required|string|between:2,64",
            "description" => "required|string",
            "price" => "required|int|gte:1"
        ]);

        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //check if product exist

        $product = Product::find($id);

        //if null
        if ($product === null) {
            return response()->json([
                "message" => "Product was not found!"
            ], 404);
        } else return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //check if product exists

        $product = Product::find($id);

        // if null
        if ($product === null) {
            return response()->json([
                "message" => "Product was not found!"
            ], 404);
        }

        // validate the new input
        $request->validate([
            "name" => "required|string",
            "brand" => "required|string|between:2,64",
            "description" => "required|string",
            "price" => "required|int|gte:1"
        ]);

        $product->update($request->all());

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //check if product exists

        $product = Product::find($id);

        // if null
        if ($product === null) {
            return response()->json([
                "message" => "Product was not found!"
            ], 404);
        } else {
            $product->delete();

            return response()->json([
                "message" => "Product was deleted!"
            ]);
        }
    }

    public function addCategory(Request $request)
    {
        //validate

        $request->validate([
            "categoryname" => "required|string|between:2,64"
        ]);

        return Category::create($request->all());
    }

    public function searchProduct($name)
    {
        return Product::where('name', 'like', '%' . $name . '%')->get();
    }
}
