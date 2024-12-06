<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\LoanStoreRequest;
use App\Http\Requests\Loan\LoanUpdateRequest;
use App\Mail\LoanBookOrder;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Services\LoanService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoanController extends Controller
{
    protected LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $perPage = request()->query('per_page', 7);
        $loans = $this->loanService->paginateLoans($perPage);

        return view('loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $users = User::all();
        $books = Book::all();

        return view('loan.create', compact('users', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LoanStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(LoanStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['start_at'] = Carbon::now();

        $loan = $this->loanService->create($data);
        if ($loan instanceof Loan) {
            \Mail::to($loan->user->email)->send(new LoanBookOrder($loan));

            return redirect(route('loans.index'))->with(['Log' => 'Cho mượn thành công']);
        }

        return redirect(route('loans.create'))->withErrors(['error' => 'Cho mượn không thành công']);
    }

    /**
     * Display the specified resource.
     *
     * @param Loan $loan
     *
     * @return View
     */
    public function show(Loan $loan): View
    {
        return view('loan.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Loan $loan
     *
     * @return View
     */
    public function edit(Loan $loan): View
    {
        $users = User::all();
        $books = Book::all();

        return view('loan.edit', compact('loan', 'users', 'books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LoanUpdateRequest $request
     * @param Loan $loan
     *
     * @return RedirectResponse
     */
    public function update(LoanUpdateRequest $request, Loan $loan): RedirectResponse
    {
        $data = $request->validated();

        if ($this->loanService->update($loan->id, $data)) {

            return redirect(route('loans.index'))->with(['Log' => 'Chỉnh sửa thành công']);
        }

        return redirect(route('loans.edit'))->withErrors(['error' => 'Cho mượn không thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Loan $loan
     *
     * @return RedirectResponse
     */
    public function destroy(Loan $loan): RedirectResponse
    {
        if ($this->loanService->delete($loan->id)) {

            return redirect(route('loans.index'))->with(['Log' => 'Xóa thành công']);
        }

        return redirect(route('loans.index'))->withErrors(['error' => 'Xóa không thành công']);
    }

    /**
     * Get view user loan book
     *
     * @param Book $book
     *
     * @return View
     */
    public function loanBooksView(Book $book): View
    {
        return view('loan.loanBooks', compact('book'));
    }

    /**
     * User loan book
     *
     * @param LoanStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function userLoanBooks(LoanStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['start_at'] = Carbon::now();

        $loan = $this->loanService->create($data);
        if ($loan instanceof Loan) {
            \Mail::to(auth()->user()->email)->send(new LoanBookOrder($loan));

            return redirect(route('loans.userIndex'))->with(['Log' => 'Mượn thành công']);
        }

        return redirect(route('loans.userIndex'))->withErrors(['error' => 'Mượn thành công']);
    }

    /**
     * Display a listing of the user loan.
     *
     * @return View
     */
    public function userIndex(): View
    {
        $loans = $this->loanService->getLoanByUserID(auth()->user()->id);

        return view('loan.userIndex', compact('loans'));
    }
}
