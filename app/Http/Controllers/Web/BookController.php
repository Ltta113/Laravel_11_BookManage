<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of books with categories.
     *
     * @return View
     */
    public function index(): View
    {
        $perPage = request()->query('per_page', 7);
        $books = $this->bookService->paginateAllBookWithCategory($perPage);

        return view('books.index', compact('books'));

    }

    /**
     * Show the form for creating a new post.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Cache::get('categories');

        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param BookStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(BookStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($this->bookService->create($data)) {

            return redirect()->route('books.index')->with(['Log' => 'Thêm sách thành công']);
        }

        return redirect()->back()->withErrors(['error' => 'Tạo mới sách thất bại']);
    }

    /**
     * Display the specified book.
     *
     * @param Book $book
     *
     * @return View
     */
    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param Book $book
     *
     * @return View
     */
    public function edit(Book $book): View
    {
        $categories = Cache::get('categories');

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified book in storage.
     *
     * @param BookUpdateRequest $request
     * @param Book $book
     *
     * @return RedirectResponse
     */
    public function update(BookUpdateRequest $request, Book $book): RedirectResponse
    {
        $data = $request->validated();

        if ($this->bookService->update($book->id, $data)) {

            return redirect()->route('books.index')->with(['Log' => 'Chỉnh sửa sách thành công']);
        }

        return redirect()->back()->withErrors(['error' => 'Chỉnh sửa thất bại']);
    }

    /**
     * Remove the specified book from storage.
     *
     * @param Book $book
     *
     * @return RedirectResponse
     */
    public function destroy(Book $book): RedirectResponse
    {
        if ($this->bookService->delete($book->id)) {

            return redirect()->route('books.index')->with(['Log' => 'Xóa sách thành công']);
        };

        return redirect()->route('books.index')->withErrors(['error' => 'Xóa sách không thành công']);
    }
}
