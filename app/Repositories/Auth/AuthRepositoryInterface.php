<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\RepositoryInterface;

interface AuthRepositoryInterface extends RepositoryInterface
{
    /**
     * Log in the user.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function login(array $credentials): bool;

    /**
     * Log out the user.
     *
     * @return void
     */
    public function logout(): void;

    /**
     * Register the user.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function register(array $credentials): bool;

    /**
     * Get user by email
     *
     * @param string $email
     *
     * @return User
     */
    public function getUserByEmail(string $email): User;
}
