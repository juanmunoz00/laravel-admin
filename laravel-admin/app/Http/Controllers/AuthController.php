<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    function register(RegisterRequest $request) {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
        ]);

        return response($user, Response::HTTP_CREATED);

    }

    function login(Request $request){
        if ( !Auth::attempt($request->only('email', 'password')) ){
            return \response([
                'error' => 'Invalid credentials!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        //Especificar el tipo del objeto $user
        /** @var User $user */
        $user = Auth::user();
        //$token = $user->createToken('token')->plainTextToken;
        $jwt = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $jwt, 60 * 24);

        return \response([
            'jwt'=> $jwt
        ])->withCookie($cookie);


    }

    function user(Request $request){
        return $request->user();
    }

    function logout(){
        $cookie = Cookie::forget('jwt');

        return \response([
            'message' => 'Cookie forgotten successfully1'
        ])->withCookie($cookie);
    }

}
