<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller
{

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['userId'] = $user->id;
            return response()->json(['success' => $success]); 
        } 
        else {
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
 
    public function register(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) { 
             return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 

        $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success]); 
    }

    public function getUser(){
        return response()->json(['success'=> 'get user function call']); 
    }
    
}