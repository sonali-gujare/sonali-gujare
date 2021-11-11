<?php

namespace App\Http\Controllers;

// use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>'login']); //not going to use on login
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' =>'required|string|min:6'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 400); //400 we use for bad request
        }
        $token_validity = 1; // it will take 60min multiply by 24 i.e 1 day expiry.
        $this->gaurd()->factory()->setTTL($token_validity);
        if(!$token = $this->gaurd()->attempt($validator->validated())){
            return response()->json(['error'=>'unauthorised',401]);
        }
        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token){
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'token_validity' => $this->gaurd()->factory()->getTTL() * 60
        ]);
    }
    protected function gaurd(){
        return Auth::guard();
    }
}
