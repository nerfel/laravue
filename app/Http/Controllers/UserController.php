<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserResourceCollection
     */
    public function index()
    {
        return new UserResourceCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $request->user();
        return $this->userService->updateUserInfo($user, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserTokens(Request $request) {

        $user = $request->user();
        $tokens = $this->userService->getUserTokens($user);

        return response()->json($tokens);

    }

    public function deleteToken(Request $request, $tokenId)
    {
        return response()->json(['success' => (bool) $request->user()->tokens()->where('id', $tokenId)->delete()]);
    }

}
