<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{

    public function registration(RegisterUserRequest $request) {

        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['success' => true], Response::HTTP_OK);
        }
        catch(Exception $e) {
            Log::error($e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
