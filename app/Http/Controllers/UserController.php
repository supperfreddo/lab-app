<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginApiRequest;
use App\Models\User;
use Crypt;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function createToken(LoginApiRequest $request)
    {
        // Check if email exists & password is correct
        $user = User::where('email', $request->username)->first();
        if (!isset($user) || Crypt::decrypt($user->password) != $request->password) {
            return response()->json([
                'message' => 'Username or password incorrect',
                'data' => null
            ], 404);
        }

        // Invalidate previous tokens
        $user->tokens()->delete();

        // Create token
        $token = $user->createToken('api_token');

        // Return a response
        return response()->json([
            'message' => 'Successfully logged in',
            'data' => [
                'token' => $token->plainTextToken,
                'user' => $user,
            ]
        ], 200);
    }

    public function deleteToken(Request $request)
    {
        // Invalidate token
        PersonalAccessToken::findToken($request->headers->get('Token'))->delete();

        // Return a response
        return response()->json([
            'message' => 'Successfully logged out',
            'data' => null
        ], 200);
    }
}
