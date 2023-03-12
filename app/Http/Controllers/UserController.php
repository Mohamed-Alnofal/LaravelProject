<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;

class UserController extends Controller
{
    public function userregister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'error'
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $newuser = User::create($input);   //may be rong
        $token = [];
        $token['token'] = $newuser->createToken('token')->accessToken;
        $token['name'] = $newuser->name;
        return response()->json([
            'message' => 'Create New Account',
            'Data' => $input,
            'token' => $token
        ]);
    }
    public function userlogin(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token['token'] = $user->createToken('token')->accessToken;
            $token['name'] = $user->name;
            return response()->json([
                'message' => 'Create New Account',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'Plase Enter Correct Email And Password',
            ]);
        }
    }
    public function userlogout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        return response()->json([
            "message" => "logged out successfully"
        ], 200);
    }
}