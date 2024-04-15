<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Photo::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "img1" => "string",
            "img2" => "string",
            "img3" => "string"
        ]);

        return Photo::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // check if photo id exist
        $photo = Photo::find($id);

        // if null
        if ($photo === null) {
            return response()->json([
                "message" => "Photo id was not found!"
            ], 404);
        } else return $photo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // check if photo id exist
        $photo = Photo::find($id);

        // if null
        if ($photo === null) {
            return response()->json([
                "message" => "Photo id was not found!"
            ], 404);
        }

        // validate the update
        $request->validate([
            "img1" => "required",
            "img2" => "required",
            "img3" => "required"
        ]);

        // update
        $photo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // NOTE : this function may not be needed in the front-end application
        // check if photo id exist
        $photo = Photo::find($id);

        // if null
        if ($photo === null) {
            return response()->json([
                "message" => "Photo id was not found!"
            ], 404);
        } else {
            $photo->delete();
            return response()->json([
                "message" => "Photo id was deleted!"
            ]);
        }
    }
}
