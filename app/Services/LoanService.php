<?php

namespace App\Services;

use App\Models\Loan;
use App\Repositories\Loan\LoanRepositoryInterface;
use DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LoanService
{
    protected LoanRepositoryInterface $loanRepository;

    public function __construct(LoanRepositoryInterface $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * Get all model
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->loanRepository->getAll();
    }

    /**
     * Get a single record by ID.
     *
     * @param int $id
     *
     * @return Loan|null
     */
    public function find(int $id): ?Loan
    {
        return $this->loanRepository->find($id);
    }

    /**
     * Create new model
     *
     * @param array $attributes
     *
     * @return Loan
     */
    public function create(array $attributes = []): Loan
    {
        DB::beginTransaction();
        try {
            $result = $this->loanRepository->create($attributes);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Update model with ID
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
            $result = $this->loanRepository->find($id);
            if ($result) {
                $result->update($attributes);
                DB::commit();

                return true;
            }

            return false;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Delete model with ID
     *
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->loanRepository->delete($id);
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Retrieve all loan records along with their associated user and book information.
     *
     * @return Collection
     */
    public function getAllLoanWithUserAndBook(): Collection
    {
        return $this->loanRepository->getAllLoanWithUserAndBook();
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
        return $this->loanRepository->getLoanByUserID($id);
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
        return $this->loanRepository->paginateLoans($perPage);
    }
}
