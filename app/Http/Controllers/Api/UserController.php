<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('limit', 10);
        $page = $request->input('offset', 0) / $perPage + 1;

        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'result' => UserResource::collection($users->items()),
            'metadata' => [
                'limit' => $perPage,
                'offset' => ($users->currentPage() - 1) * $perPage,
                'total' => $users->total(),
            ]
        ]);
    }

    public function toggleBlock($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return response()->json(['message' => 'You cannot block an admin.'], 403);
        }

        $user->is_blocked = !$user->is_blocked;
        $user->save();

        return response()->json([
            'message' => $user->is_blocked ? 'User has been blocked.' : 'User has been unblocked.',
            'user' => new UserResource($user),
        ]);
    }
}
