<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $perPage = request()->query('per_page', 7);
        $categories = $this->categoryService->paginateCategories($perPage);

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($this->categoryService->create($data)) {
            Cache::forget('categories');
            Cache::forever('categories', Category::all());

            return redirect()->route('categories.index')->with('success', 'Tạo mới danh mục thành công');
        }

        return redirect()->route('categories.create')->with('error', 'Tạo mới danh mục thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return View
     */
    public function show(Category $category): View
    {
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param Category $category
     *
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        if ($this->categoryService->update($category->id, $data)) {
            Cache::forget('categories');
            Cache::forever('categories', Category::all());

            return redirect()->route('categories.index')->with(['success' => 'Chỉnh sửa danh mục thành công']);
        }

        return redirect()->back()->withErrors(['error' => 'Chỉnh sửa thất bại']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($this->categoryService->delete($category->id)) {
            Cache::forget('categories');
            Cache::forever('categories', Category::all());

            return redirect()->route('categories.index')->with(['Log' => 'Xóa danh mục thành công']);
        }

        return redirect()->route('categories.index')->withErrors(['error' => 'Xóa danh mục không thành công']);
    }
}
