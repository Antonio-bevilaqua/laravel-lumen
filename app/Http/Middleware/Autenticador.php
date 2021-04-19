<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class Autenticador
{

    public function handle(Request $request, Closure $next)
    {   
        try {
            if (!$request->hasHeader('Authorization')) throw new Exception();

            $token = str_replace("Bearer ", "", $request->header('Authorization'));

            $authData = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            $user = User::where('email', $authData->email)->first();

            if (!$user) throw new Exception();

            return $next($request);
        } catch (Exception $e){
            return response()->json('Não autorizado');
        }
    }
}
