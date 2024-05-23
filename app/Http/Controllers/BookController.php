<?php

namespace App\Http\Controllers;

use App\Models\Booked;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Booked::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // no validation required
        return Booked::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Booked::find($id);

        // check if any match
        if($book === null){
            return response()->json([
                'message' => "Booking was not found!"
            ], 404);
        } else return $book;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //check if booking id exists
        $book = Booked::find($id);
        //if no entries
        if($book === null){
            return response()->json([
                "message" => "Booking id was not found!"
            ],404);
        }
             
        // validate 

        $request->validate([
            "status" => "required|bool",
            "user_id" => "int"
        ]);

        // update values on set booking id
        $book->update($request->all());

        return $book;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // note: this function may not be neccessary in the front-end application
        //check if booking id exists
        $book = Booked::find($id);
        //if no entries
        if($book === null){
            return response()->json([
                "message" => "Booking id was not found!"
            ],404);
        }// found
        else{
            $book->delete();
            return response()->json([
                "message" => "Booking was deleted!"
            ]);
        }
    }
    public function searchBooking($id)
    {
        $book = Booked::where('user_id', $id )->get();
        
        if(count($book) === 0){
            return response()->json([
                "message" => "No bookings was found!"
            ],404);
        } else {
            return $book;
        }
    }
}
