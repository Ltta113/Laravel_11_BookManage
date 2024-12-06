<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Get model
     */
    public function getModel(): string
    {
        return Category::class;
    }

    /**
     * Pagination of categories.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateCategories(int $perPage): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }
}
