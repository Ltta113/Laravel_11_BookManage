<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Category;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Display the login page.
     *
     * @return View
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Handle user login.
     *
     * @param LoginRequest $request
     *
     * @return RedirectResponse
     */
    public function loginPost(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if ($this->authService->login($credentials)) {
            if (!Cache::has('categories')) {
                Cache::forever('categories', Category::all());
            }

            return redirect()->route('admin')->with(['success' => 'Đăng nhập thành công']);
        }

        return redirect()->back()->withErrors(['error' => 'Email hoặc mật khẩu không đúng.']);
    }

    /**
     * Handle user logout
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        return redirect()->route('admin')->with(['success' => 'Đăng xuất thành công']);
    }

    /**
     * Display the register page.
     *
     * @return View
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     *
     * @param RegisterRequest $request
     *
     * @return RedirectResponse
     */
    public function registerPost(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($this->authService->register($data)) {
            Cache::forever('categories', Category::all());

            return redirect()->route('admin')->with(['Log' => 'Đăng ký thành công']);
        }

        return redirect()->route('register')->withErrors(['error' => 'Đăng ký thành công!']);
    }
}
