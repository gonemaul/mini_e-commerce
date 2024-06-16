<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showAdminProfile(){
        return view('users.admin_profile')->with([
            'title' => 'Profile',
            'data' => Auth::user()
        ]);
    }

    public function changeAdminProfile(Request $request){
        $user = User::findOrFail($request->id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:6|max:20|',
            'email' => 'required|string|email|max:255',
            'profilePhoto' => 'image|file|max:1024',
        ]);

        if ($request->file('profilePhoto')){
            if($user->profile_image){
                Storage::delete($user->profile_image);
            }
            $validatedData['profile_image'] = $request->file('profilePhoto')->store('profile_image');
        }

        $validatedData['name'] = Str::title($request->name);
        $validatedData['username'] = strtolower($request->username);

        $user->update($validatedData);
        return redirect()->route('home')->with('success', "Your profile has been updated successfully");
    }

    public function changePasswordAdmin(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if($request->get('new_password') != $request->get('confirm_password')){
            return redirect()->back()->with("error","Your password is incorrect");
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|',
        ]);

        $user->update([
            'password' =>  Hash::make($request->get('new_password'))
        ]);;
        
        return redirect()->route('home')->with("success","Password changed successfully!");
    }

    public function user_list(){
        return view('users.index')->with([
            'title' => 'User List',
            'data' => User::orderBy('is_admin', 'desc')->get()
        ]);
    }
}
