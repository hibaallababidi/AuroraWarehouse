<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function logout(){
        JWTAuth::parseToken()->invalidate();
        return response()->json([
            'message' => 'success',
        ], 200);
    }
}
