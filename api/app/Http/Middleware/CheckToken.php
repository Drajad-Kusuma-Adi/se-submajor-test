<?php

namespace App\Http\Middleware;

use App\Models\Students;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->token;
        if (!$token) {
            return response()->json([
                'message' => 'no token'
            ], 401);
        } else {
            $tokenCheck = Students::where('token', $token)->first();
            if (!$tokenCheck) {
                return response()->json([
                    'message' => 'invalid token'
                ], 401);
            } else {
                $user = Students::where('id', $tokenCheck->id)->first();
                if (!$user) {
                    return response()->json([
                        'message' => 'no student with this token'
                    ], 404);
                } else {
                    return $next($request);
                }
            }
        }
    }
}
