<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * Get model
     */
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * Get all user with role User.
     *
     * @return Collection
     */
    public function getAllUserRole(): Collection
    {
        return $this->model->where('role', User::ROLE_USER)->get();
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
        return $this->model->where('role', User::ROLE_USER)->paginate($perPage);
    }
}
