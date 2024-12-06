<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookStoreRequest;
use App\Http\Requests\Book\BookUpdateRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected BookService $bookService;

    /**
     * BookController constructor.
     *
     * @param BookService $bookService
     *
     * @return void
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = request()->query('per_page', 7);
        $books = $this->bookService->paginateAllBookWithCategory($perPage);

        if (!$books) {
            return response()->json([
                'message' => 'Books not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Get all books',
            'data' => $books->items(),
            'meta' => [
                'total' => $books->total(),
                'perPage' => $books->perPage(),
                'currentPage' => $books->currentPage(),
                'total_pages' => $books->lastPage(),
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookStoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(BookStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $book = $this->bookService->create($data);

        if (!$book) {
            return response()->json([
                'message' => 'Book not created',
            ], 400);
        }

        return response()->json([
            'message' => 'Book created',
            'data' => $book,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     *
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json([
            'message' => 'Get book',
            'data' => $book,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookUpdateRequest $request
     * @param Book $book
     *
     * @return JsonResponse
     */
    public function update(BookUpdateRequest $request, Book $book): JsonResponse
    {
        $data = $request->validated();
        $book = $this->bookService->update($book->id, $data);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Book updated',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     *
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $result = $this->bookService->delete($book->id);

        if (!$result) {
            return response()->json([
                'message' => 'Book not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Book deleted',
        ], 200);
    }
}
