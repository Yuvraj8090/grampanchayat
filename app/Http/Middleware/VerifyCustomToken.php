<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class VerifyCustomToken
{

    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorize Request'], 405);
        }

        // Check if the token is valid (you can implement your own validation logic here)
        
        if (!$this->isValidToken($token)) {
            return response()->json(['message' => 'Invalid bearer token'], 401);
        }

        return $next($request);
    }

    private function isValidToken($token)
    {
        // Return true if the token is valid, false otherwise
        
        $user = User::where('api_token' ,$token)->first();
        return $user ? TRUE : FALSE;
    }
}
