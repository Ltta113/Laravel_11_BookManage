<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\Book\BookRepositoryInterface;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookService
{
    protected BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Get all book
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->bookRepository->getAll();
    }

    /**
     * Get a single record by ID.
     *
     * @param int $id
     *
     * @return Book|null
     */
    public function find(int $id): ?Book
    {
        return $this->bookRepository->find($id);
    }

    /**
     * Create new book
     *
     * @param array $attributes
     *
     * @return Book
     */
    public function create(array $attributes = []): Book
    {
        DB::beginTransaction();
        try {
            $result = $this->bookRepository->create($attributes);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Update book with ID
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
            $result = $this->bookRepository->update($id, $attributes);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Delete book with ID
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->bookRepository->delete($id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Get all books with their associated categories.
     *
     * @return Collection
     */
    public function getAllBookWithCategory(): Collection
    {
        return $this->bookRepository->getAllBookWithCategory();
    }

    /**
     * Paginate all books along with their associated categories.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateAllBookWithCategory(int $perPage): LengthAwarePaginator
    {
        return $this->bookRepository->paginateAllBookWithCategory($perPage);
    }
}
