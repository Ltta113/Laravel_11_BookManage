<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    /**
     * Get model
     */
    public function getModel(): string
    {
        return Book::class;
    }

    /**
     * Get all books along with categories.
     *
     * @return Collection
     */
    public function getAllBookWithCategory(): Collection
    {
        return $this->model->with('category')->get();
    }

    /**
     * Paginate all books along with categories.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateAllBookWithCategory(int $perPage): LengthAwarePaginator
    {
        return $this->model->with('category')->paginate($perPage);
    }
}
