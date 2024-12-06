<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    /**
     * Get model
     */
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * Log in the user.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    /**
     * Log out the user.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Register the user.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function register(array $credentials): bool
    {
        return (bool)$this->model->create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);
    }

    /**
     * Get user by email
     *
     * @param string $email
     *
     * @return User
     */
    public function getUserByEmail(string $email): User
    {
        return $this->model->where('email', $email)->first();
    }
}
