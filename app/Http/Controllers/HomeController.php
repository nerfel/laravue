<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request) {

        $user = $request->user();

        return response()->json([
            'email' => $user->email,
            'name' => $user->name,
            'lastName' => $user->last_name ? $user->last_name : "",
        ]);
    }
}
