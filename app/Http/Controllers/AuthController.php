<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    // register the user

    public function register(Request $request) {
        $validatedUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]
            );

            // check if user is validated correctly
            if($validatedUser->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'error' => $validatedUser->errors()
                ], 401);
            }

            // correctly validated user, return an API token

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])
            ]);

            $token = $user->createToken('APITOKEN')->plainTextToken;

            $resp = [
                'message' => 'User created successfully',
                'user' => $user,
                'token' => $token
            ];

            return response($resp, 201);


    }

    // login an existing user 
    public function login(Request $request) {
        $validatedUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
            );

            // check if user is validated correctly
            if($validatedUser->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'error' => $validatedUser->errors()
                ], 401);
            }

            // check if incorrect credentials

            if(!auth()->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Incorrect login credentials, try again!'
                ], 401);
            }

            // correct credentials, return a token

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'message' => 'User successfully logged in!',
                'token' => $user->createToken('APITOKEN')->plainTextToken,
                'userId' => $user->id
            ], 200);
    }

    // logout the user

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'message' => 'User has logged out!'
        ];

        return response($response, 200);
    }

    // get the roleid
    public function getRole(string $id){
        $role = User::find($id);

        // check if any match
        if($role === null){
            return response()->json([
                'message' => "ID was not found!"
            ], 404);
        } else return $role;

    }

}