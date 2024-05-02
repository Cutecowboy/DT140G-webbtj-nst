<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function show(string $id){
        $user = User::find($id);

        //if null 
        if($user === null){
            return response()->json([
                "message" => "User was not found!"
            ], 404);
        } else {
            return $user;
        }
    }

    // mainly for adminstrators to update roleid
    public function update(Request $request, string $id){
        // check if exist
        $user = User::find($id);
        if($user === null){
            return response()->json([
                "message" => "User was not found!"
            ], 404);
        } 
        

        // validate the new inp
        $request->validate([
            "role_id" => "required"
        ]);


        $user->update($request->all());
        return $user;

    }
    public function destroy(string $id){
        //check if exist
        $user = User::find($id);
        if($user === null){
            return response()->json([
                "message" => "User was not found!"
            ], 404);
        } else {
            $user->delete();

            return response()->json([
                "message" => "User was deleted!"
            ]);
        }
    }
}
