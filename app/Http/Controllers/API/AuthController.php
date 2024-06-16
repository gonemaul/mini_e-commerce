<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $validatedData['name'] = Str::title($request->username);
        $user = User::create($validatedData);

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Account successfully created',
            'token' => $token
        ]);
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
        ]);

        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            $user = User::findOrFail(auth()->user()->id);

            $user->tokens()->delete();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token,
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'The provided credentials do not match our records'
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function auth_user_details(){
        $user = auth()->user();

        return response()->json([
           'status' =>'success',
            'account' => [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'profile_image' => $user->profile_image,
            ]
        ]);
    }

    public function auth_user_update(Request $request){
        $user = User::findOrFail(auth()->user()->id);

        $request->validate([
            'name' => 'string',
            'username' => 'string|min:6|max:20|unique:users',
            'email' => 'email|string|unique:users',
            'new_password' => 'min:8',
            'profile_image' => 'image|file|max:1024',
        ]);

        if($request->name){
            $user->name = Str::title($request->name);
        }

        if($request->username){
            $user->username = strtolower($request->username);
        }

        if($request->new_password && (Hash::check($request->new_password, $user->password))){
            return response()->json([
                'status' =>'failed',
                'message' => 'The new password is the same as the old password'
            ]);
        }
        else{
            $user->password = Hash::make($request->new_password);
        }

        if ($request->file('profile_image')){
            if($user->profile_image){
                Storage::delete($user->profile_image);
            }
            $user->profile_image = $request->file('profile_image')->store('profile_image');
        }
        
        $user->save();
        return response()->json([
           'status' =>'success',
            'message' => 'The profile was updated successfully'
        ]);
    }
}
