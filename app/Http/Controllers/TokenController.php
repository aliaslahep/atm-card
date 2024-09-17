<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TokenController extends Controller
{
    public function createToken(Request $request)
    {

        $user = User::find(1);
        
        if (!$user) {

            return response()->json(['error' => 'User not found'], 404);
        }

        $token = $user->createToken('ATM-Card')->accessToken;

        return response()->json(['token' => $token]);
    }
}
