<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Models\Temperatures;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['id' => $user->id, 'message' => 'Hi '.$user->name.', welcome!','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function temperatures(Request $request)
    {
        $this->validate($request, [ 
            'user_id' => 'required'
        ]);
        $uId = strval($request->user_id);
        return Temperatures::where('user_id', $uId)->orderBy('timestamps', 'asc')->get();  
    }

    public function saveTemperature(Request $request)
    {
        $this->validate($request, [ 
            'user_id' => 'required',
            'fahrenheit' => 'required',
            'celsius' => 'required'
        ]);
  
        $temperature = new Temperatures;
        $temperature->user_id = $request->user_id; 
        $temperature->fahrenheit = $request->fahrenheit;  
        $temperature->celsius = $request->celsius;  
        
        $temperature->save(); 
        return true; 
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }


}
