<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Js;

class UserController extends Controller
{
    protected UserService $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = request()->query('per_page', 7);
        $users = $this->userService->paginateUsers($perPage);

        if (!$users) {
            return response()->json([
                'message' => 'Users not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Get all users',
            'data' => $users->items(),
            'meta' => [
                'total' => $users->total(),
                'perPage' => $users->perPage(),
                'currentPage' => $users->currentPage(),
                'total_pages' => $users->lastPage(),
            ],
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'message' => 'Get user',
            'data' => $user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     *
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $auth = auth()->user();
        $user = $this->userService->update($auth->id, $data);

        if (!$user) {
            return response()->json([
                'message' => 'User not updated',
            ], 400);
        }

        return response()->json([
            'message' => 'User updated',
            'data' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $auth = auth()->user();
        $this->userService->delete($auth->id);

        return response()->json([
            'message' => 'User deleted',
        ], 200);
    }
}
