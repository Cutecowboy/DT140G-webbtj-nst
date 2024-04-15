<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the new category
        $request->validate([
            "categoryname" => "required|string|between:2,64"
        ]);

        // create the new category
        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //check if category exists
        $category = Category::find($id);

        //if no category was found
        if ($category === null) {
            return response()->json([
                "message" => "Category was not found!"
            ], 404);
        } else return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //check if category exists
        $category = Category::find($id);
        // if empty
        if ($category === null) {
            return response()->json([
                "message" => "Category was not found!"
            ], 404);
        }

        // validate if cat exist
        $request->validate([
            "categoryname" => "required|string|between:2,64"
        ]);

        // update the category value based on id
        $category->update($request->all());

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //check if category exists
        $category = Category::find($id);
        // if empty
        if ($category === null) {
            return response()->json([
                "message" => "Category was not found!"
            ], 404);
        } else {
            $category->delete();
            return response()->json([
                "message" => "Game was deleted!"
            ]);
        }

    }
}
