<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Auth\AuthRepositoryInterface;
use DB;

class AuthService
{
    protected AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
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
        return $this->authRepository->login($credentials);
    }

    /**
     * Log out the user.
     *
     * @return void
     */
    public function logout(): void
    {
        $this->authRepository->logout();
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
        DB::beginTransaction();
        try {
            $this->authRepository->register($credentials);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
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
        return $this->authRepository->getUserByEmail($email);
    }
}
