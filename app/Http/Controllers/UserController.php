<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function updateUserInfo(Request $request) {

        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "password" => "nullable|min:6",
                "newPassword" => "nullable|min:6"
            ]);
            if($validator->fails()) {
                throw new Exception($validator->errors(), 400);
            }
            $user = $request->user();
            $userPasswordBeforeUserUpdate = $user->password;
            if(isset($request->password) && !Hash::check($request->password, $user->password)) {
                throw new Exception('Invalid user password');
            }

            $user->name = $request->name;
            $user->last_name = $request->lastName;
            $user->email = $request->email;
            if(isset($request->newPassword)) {
                $user->password = Hash::make($request->newPassword);
            }

            $user->update();
            $response = ['success' => true, 'user' => [
                'email' => $user->email,
                'name' => $user->name,
                'lastName' => $user->last_name
            ]];

            $response['passwordChanged'] = $userPasswordBeforeUserUpdate !== $user->password;
        return response()->json($response);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }

    }

    public function getUserTokens(Request $request) {

        $user = $request->user();
        $response = Array();
        $currentToken = $user->currentAccessToken();
        $response['current'] = [
            'id' => $currentToken->id,
            'last_used_at' => Carbon::parse($currentToken->last_used_at)->format('Y-m-d H:i'),
            'created_at' => Carbon::parse($currentToken->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($currentToken->updated_at)->format('Y-m-d H:i')
        ];
        $response['other'] = DB::table('personal_access_tokens')
            ->select('id', 'last_used_at', 'created_at', 'updated_at')
            ->where('id', '!=', $currentToken->id)
            ->where('tokenable_id', $user->id)
            ->get();

        return response()->json($response);

    }

    public function deleteToken(Request $request, $tokenId) {
        return response()->json(['success' => (bool) $request->user()->tokens()->where('id', $tokenId)->delete()]);
    }

}
