<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Role;
use App\Models\User;
use App\Models\Workspace;
use Inertia\Inertia;

class WorkspaceUsersController extends Controller
{
    public function index(Workspace $workspace)
    {
        $users = $workspace->users()->orderBy('first_name')->get();

        $pendingUsers = Invitation::query()
            ->where('workspace_id', $workspace->id)
            ->whereNull('registered_at')
            ->get();

        return Inertia::render('User/Index', [
            'users' => $users->map(fn($user) => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'avatar_path' => $user->avatar_path,
                'role' => Role::query()->find($user->workspace_role_id)->name
            ]),
            'pendingUsers' => $pendingUsers->map(fn($pendingUser) => [
                'first_name' => $pendingUser->first_name,
                'last_name' => $pendingUser->last_name,
                'email' => $pendingUser->email,
                'role' => Role::query()->find($pendingUser->workspace_role_id)->name,
                'invitedByFirstName' => User::query()->find($pendingUser->user_id)->first_name,
                'invitedByLastName' => User::query()->find($pendingUser->user_id)->last_name,
                'invitedAt' => $pendingUser->created_at->diffForHumans()
            ])
        ]);
    }
}
