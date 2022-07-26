<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * @param Request $request
     * @return User
     */

     public function register(Request $request){
      try {
        //code...
          $validateUser= Validator::make(
            $request->all(),
            [
                'name'=>'required|string|max:255',
                'email'=>'required|string|email|max:255|unique:users',
                'password'=>'required|string|min:6',
            ]
        );
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validate error',
                'error'=>$validateUser->errors()
            ],400);
        }

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'register success',
            'token'=>$user->createToken("API TOKEN")->plainTextToken,
        ],200);

      } catch (\Throwable $th) {
        //throw $th;
        return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
            
        ],400);
      }
     }

     public function login(Request $request){
        try {
            //code...
            $validateUser= Validator::make(
                $request->all(),
                [
                    'email'=>'required|string|email|max:255',
                    'password'=>'required|string|min:6',
                ]
            );
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validate error',
                    'error'=>$validateUser->errors()
                ],400);
            }
            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status' => false,
                    'message' =>'Email Password  does not match with our records',
                ],400);
            }
            $user=User::where('email',$request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'login success',
                'token'=>$user->createToken("API TOKEN")->plainTextToken,
            ],200);
           

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                
            ],400);
        }
     }
    
}
