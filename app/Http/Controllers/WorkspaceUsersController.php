<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkspaceUsersController extends Controller
{
    public function index(Workspace $workspace)
    {
        $users = $workspace->users;

        return Inertia::render('User/Index', [
            'users' => $users->map(fn($user) => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'avatar_path' => $user->avatar_path,
                'role' => Role::find($user->workspace_role_id)->name
            ])
        ]);
    }

    public function invite(Workspace $workspace)
    {

    }
}
