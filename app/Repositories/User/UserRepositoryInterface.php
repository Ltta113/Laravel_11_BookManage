<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Get all user with role User.
     *
     * @return Collection
     */
    public function getAllUserRole(): Collection;

    /**
     * Pagination of users.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateUsers(int $perPage): LengthAwarePaginator;
}
