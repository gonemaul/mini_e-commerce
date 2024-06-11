<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|min:6|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16',
        ]);

        if(!$validatedData){
            return response()->json([
               'status' => 'error',
               'message' => 'data not valid',
                'data' => $validatedData,
            ]);
        }
        $validatedData['name'] = $request->username;
        $user = User::create($validatedData);

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'account' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request){
        // return 'oken';
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
        ]);

        if (Auth::attempt($validatedData)) {
            // $request->session()->regenerate();
            

            return response()->json([
                'status' => 'success',
                'token' => Auth::token(),
                'account' => $validatedData 
            ]);
        }

        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     $user = Auth::user();

        //     // Cari token yang masih berlaku
        //     $existingToken = $user->tokens()->where('name', 'Personal Access Token')->first();

        //     if ($existingToken && $existingToken->isValid()) {
        //         return response()->json(['token' => $existingToken->plainTextToken]);
        //     } else {
        //         // Delete existing tokens
        //         $user->tokens()->delete();

        //         // Buat token baru
        //         $token = $user->createToken('Personal Access Token');

        //         return response()->json([
        //             'status' => 'success',
        //             'token' => $token->plainTextToken
        //         ]);
        //     }
        // }

        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
