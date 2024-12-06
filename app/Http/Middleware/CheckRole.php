<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role == User::ROLE_ADMIN) {

            return $next($request);
        }

        if ($user && $user->role == User::ROLE_USER) {

            return response()->json([
                'message' => 'You don\'t have permission to access this page.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'message' => 'You don\'t have permission to access this page.',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
