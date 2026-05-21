<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class AuthToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        
        $user = User::where('remember_token', $token)->first();
        
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized 😒'
            ], 401);
        }
        
        // Vincular usuario a la request
        $request->merge(['user' => $user]);
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        
        return $next($request);
    }
}