<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expert;
use App\Models\Specialist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;


class ExpertController extends Controller
{
    //
    public function expertregister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'address' => 'required',
            'experiences' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'start_day' => 'required',
            'end_day' => 'required',
            'open' => 'required',
            'close' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'error'
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $newuser = Expert::create($input);   //may be rong
        $token = [];
        $token['token'] = $newuser->createToken('token')->accessToken;
        $token['name'] = $newuser->name;
        return response()->json([
            'message' => 'Create New Account',
            'Data' => $input,
            'token' => $token
        ]);
    }
    public function expertlogin(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = [];
            $token['remember_token'] = $user->createToken('token')->accessToken;
            $token['name'] = $user->name;
            return response()->json([
                'message' => 'Create New Account Succsesfully',
                'token' => $token
            ]);
        } else {

            return response()->json([
                'message' => 'Plase Enter Correct Email And Password',
            ]);
        }
    }
    public function expertlogout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        return response()->json([
            "message" => "logged out successfully"
        ], 200);
    }
    public function profileExpeert($id)
    {
        if ($id == $id) {
            $expert = Expert::find($id);
            return response()->json([
                'message' => $expert
            ]);
        }
    }


    public function listexperts()
    {
        $expert = Expert::get();
        return response()->json([
            'message' => $expert
        ]);
    }

    public function experience()
    {
        return $this->hasOne('specialists');
    }
}