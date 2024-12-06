<?php

namespace App\Repositories\Book;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface extends RepositoryInterface
{
    /**
     * Get all books along with their associated categories.
     *
     * @return Collection
     */
    public function getAllBookWithCategory(): Collection;

    /**
     * Get all books along with their associated categories and paginate them.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateAllBookWithCategory(int $perPage): LengthAwarePaginator;
}
