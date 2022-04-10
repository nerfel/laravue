<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginUserRequest $request) {
        if(Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('api');

            return response()->json([
                'message' => 'success',
                'user' => (new UserResource($user))->toArray(request()),
                'token' => $token->plainTextToken
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request) {

        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json(['success' => true, 'message' => 'User logged out successfully']);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
