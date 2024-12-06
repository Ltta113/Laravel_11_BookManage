<?php

namespace App\Http\Middleware\Web;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
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
        if (Auth::check()) {
            $user = Auth::user();

            if ($user && $user->role === User::ROLE_ADMIN) {

                return $next($request);
            }

            return redirect()->route('admin')->withErrors(['error' => 'Không đủ quyền để vào trang admin']);
        }

        return redirect()->route('loginWeb')->withErrors(['error' => 'Vui lòng đăng nhập để tiếp tục.']);
    }
}
