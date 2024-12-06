<?php

namespace App\Repositories\Loan;

use App\Models\Loan;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LoanRepository extends BaseRepository implements LoanRepositoryInterface
{
    /**
     * Get model
     */
    public function getModel(): string
    {
        return Loan::class;
    }

    /**
     * Retrieve all loan records along with their associated user and book information.
     *
     * @return Collection
     */
    public function getAllLoanWithUserAndBook(): Collection
    {
        return $this->model->with(['user', 'book'])->get();
    }

    /**
     * Get all loan by ID User
     *
     * @param int $id
     *
     * @return Collection
     */
    public function getLoanByUserID(int $id): Collection
    {
        return $this->model->where('user_id', $id)->get();
    }

    /**
     * Pagination of loans.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateLoans(int $perPage): LengthAwarePaginator
    {
        return $this->model->with(['user', 'book'])->paginate($perPage);
    }
}
