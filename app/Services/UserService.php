<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all user
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->userRepository->getAll();
    }

    /**
     * Get a single record by ID.
     *
     * @param int $id
     *
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * Create new user
     *
     * @param array $attributes
     *
     * @return User
     */
    public function create(array $attributes = []): User
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->create($attributes);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Update user with ID
     *
     * @param int $id
     * @param array $attributes
     *
     * @return bool
     */
    public function update(int $id, array $attributes = []): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->update($id, $attributes);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Delete user with ID
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->userRepository->delete($id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Get all user with role User.
     *
     * @return Collection
     */
    public function getAllUserRole(): Collection
    {
        return $this->userRepository->getAllUserRole();
    }

    /**
     * Pagination of users.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateUsers(int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->paginateUsers($perPage);
    }
}
