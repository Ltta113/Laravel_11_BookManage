<?php

namespace App\Repositories\Loan;

use App\Models\Loan;
use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface LoanRepositoryInterface extends RepositoryInterface
{
    /**
     * Retrieve all loan records along with their associated user and book information.
     *
     * @return Collection
     */
    public function getAllLoanWithUserAndBook(): Collection;

    /**
     * Get all loan by ID User
     *
     * @param int $id
     *
     * @return Collection
     */
    public function getLoanByUserID(int $id): Collection;

    /**
     * Pagination of loans.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateLoans(int $perPage): LengthAwarePaginator;
}
