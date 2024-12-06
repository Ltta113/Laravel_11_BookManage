<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\LoanStoreRequest;
use App\Http\Requests\Loan\LoanUpdateRequest;
use App\Models\Loan;
use App\Services\LoanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    protected LoanService $loanService;
    /**
     * LoanController constructor.
     *
     * @param LoanService $loanService
     *
     * @return void
     */
    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = request()->query('per_page', 7);
        $loans = $this->loanService->paginateLoans($perPage);

        if (!$loans) {
            return response()->json([
                'message' => 'Loans not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Get all loans',
            'data' => $loans->items(),
            'meta' => [
                'total' => $loans->total(),
                'perPage' => $loans->perPage(),
                'currentPage' => $loans->currentPage(),
                'total_pages' => $loans->lastPage(),
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LoanStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(LoanStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $loan = $this->loanService->create($data);

        if (!$loan) {
            return response()->json([
                'message' => 'Loan not created',
            ], 400);
        }

        return response()->json([
            'message' => 'Loan created',
            'data' => $loan,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Loan $loan
     *
     * @return JsonResponse
     */
    public function show(Loan $loan): JsonResponse
    {
        return response()->json([
            'message' => 'Get loan',
            'data' => $loan,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LoanUpdateRequest $request
     * @param Loan $loan
     *
     * @return JsonResponse
     */
    public function update(LoanUpdateRequest $request, Loan $loan): JsonResponse
    {
        $data = $request->validated();
        $loan = $this->loanService->update($loan->id, $data);

        if (!$loan) {
            return response()->json([
                'message' => 'Loan not updated',
            ], 400);
        }

        return response()->json([
            'message' => 'Loan updated',
            'data' => $loan,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Loan $loan
     *
     * @return JsonResponse
     */
    public function destroy(Loan $loan): JsonResponse
    {
        $this->loanService->delete($loan->id);

        return response()->json([
            'message' => 'Loan deleted',
        ], 200);
    }
}
