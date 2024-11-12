<?php

namespace App\Http\Middleware;


use Closure;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $guard
     * @return Response|RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null){
            auth()->shouldUse($guard); //sets the guard to either keeper or manager from route input
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (TokenExpiredException $e) {
                return response()->json(['message' => $e->getMessage()],401);
            } catch (JWTException $e) {
                return response()->json(['message' => $e->getMessage()],401);
            }
        }

        return $next($request);
    }
}
