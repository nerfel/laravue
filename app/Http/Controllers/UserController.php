<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

}
