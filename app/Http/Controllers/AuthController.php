<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//use Illuminate\Support\Facades\Request;


class AuthController extends Controller
{
    //
    public function register (Request $request){
        $fields=$request->validate([
            "name"=>"required|string",
            "email"=>"required|email|unique:users,email",//unique:users,email specify where to be unique the data
            "password"=>"required|string|min:8|confirmed",
//            "name"=>"required",
        ]);
        $user=User::create([
            "name"=>$fields["name"],
            "email"=>$fields["email"],
            "password"=>bcrypt($fields["password"]),//will hash the password
        ]);
        $token=$user->createToken("myapptoken")->plainTextToken;//this create a token that we will need it to use the protected routes!
        //the token will be stored in a table in database named `personal_access_tokens`
        $response=[
            "user"=>$user,
            "token"=>$token
        ];
        return response($response,201);
    }
    public function logout (){
        Auth::user()->tokens()->delete();//will delete the user's token that was generated via register method and the user will not be authenticable


        return ["message"=>"user logged out"];

    }
    public function login (Request $request){
        $fields=$request->validate([
            "email"=>"required|email",//unique:users,email specify where to be unique the data
            "password"=>"required|string|min:8",

//            "name"=>"required",
        ]);
        $user=User::where("email",$fields["email"])->first();

        if (!$user || !Hash::check($fields["password"], $user->password)){
            return response("The Password or email is not correct",408);

        }


        $token=$user->createToken("myapptoken")->plainTextToken;//this create a token that we will need it to use the protected routes!
        $response=[
            "user"=>$user,
            "token"=>$token
        ];
        return response($response,201);
    }

}
