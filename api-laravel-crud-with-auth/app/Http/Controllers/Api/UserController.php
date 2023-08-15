<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Validator;
class UserController extends Controller
{

    public function login(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }
    
        // Attempt to authenticate user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('fantasy')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
    }
     
    public function register(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Create new user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();

        // Generate token
        $token = $user->createToken('fantasy')->plainTextToken;

        // Return response
        return response()->json([
            'status' => true,
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function changePassword(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // Check if the current password is correct
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'The current password is incorrect'
            ], 401);
        }

        // Update the user's password
        $user->password = bcrypt($request->password);
        $user->save();

        // Generate new token
        $token = $user->createToken('fantasy')->plainTextToken;

        // Return response
        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }


    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 401);
        }
    
        $status = Password::sendResetLink($request->only('email'));
    
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'status' => true,
                'message' => 'Reset password link has been sent to your email.'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unable to send reset password link.'
            ], 500);
        }
    }
}