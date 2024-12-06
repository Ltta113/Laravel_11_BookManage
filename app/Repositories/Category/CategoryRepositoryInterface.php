<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Pagination of categories.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateCategories(int $perPage): LengthAwarePaginator;
}
