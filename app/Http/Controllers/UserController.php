<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(){
        $user = new User;
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = Hash::make(request()->password);
        $user->save();
        return $user;
    }

    public function login(){
        $user = User::where('email', request()->email)->first();
        if(!$user || !Hash::check(request()->password, $user->password)){
            return ["error" => "Error or password is not matched"];
        }
        return $user;
    }
}
