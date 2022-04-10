<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUserTokens(User $user) {

        $data = Array();
        $currentToken = $user->currentAccessToken();
        $data['current'] = [
            'id' => $currentToken->id,
            'last_used_at' => Carbon::parse($currentToken->last_used_at)->format('Y-m-d H:i'),
            'created_at' => Carbon::parse($currentToken->created_at)->format('Y-m-d H:i'),
            'updated_at' => Carbon::parse($currentToken->updated_at)->format('Y-m-d H:i')
        ];
        $data['other'] = DB::table('personal_access_tokens')
            ->select('id', 'last_used_at', 'created_at', 'updated_at')
            ->where('id', '!=', $currentToken->id)
            ->where('tokenable_id', $user->id)
            ->get();

        return $data;
    }

    public function updateUserInfo(User $user, $data) {

        try {

            $userPasswordBeforeUserUpdate = $user->password;
            if(isset($data['password']) && !Hash::check($data['password'], $user->password)) {
                throw new Exception('Invalid user password');
            }

            $user->name = $data['name'];
            $user->last_name = $data['lastName'];
            $user->email = $data['email'];
            if(isset($data['newPassword'])) {
                $user->password = Hash::make($data['newPassword']);
            }

            $user->update();

            $response = [
                'success' => true,
                'passwordChanged' => $userPasswordBeforeUserUpdate !== $user->password,
                'user' => (new UserResource($user))->toArray(request())
            ];

            return response()->json($response);
        }
        catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
