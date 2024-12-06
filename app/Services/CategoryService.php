<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all category
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get a single record by ID.
     *
     * @param int $id
     *
     * @return Category|null
     */
    public function find(int $id): ?Category
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * Create new category
     *
     * @param array $attributes
     *
     * @return Category
     */
    public function create(array $attributes = []): Category
    {
        DB::beginTransaction();
        try {
            $result = $this->categoryRepository->create($attributes);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Update category with ID
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
            $result = $this->categoryRepository->update($id, $attributes);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Delete category with ID
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->categoryRepository->delete($id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Paginate all category
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateCategories(int $perPage): LengthAwarePaginator
    {
        return $this->categoryRepository->paginateCategories($perPage);
    }
}
