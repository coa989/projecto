<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Workspace;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request)
    {
        $roleId = Role::where('name', 'member')->first()->id;
        if (!$request->workspace_id) {
            $workspace = Workspace::create();
            $roleId = Role::where('name', 'owner')->first()->id;
        }

        $path = null;

        if ($request->file('avatar')) {
            $path = $request->file('avatar')->store('avatars');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'workspace_id' => $workspace->id ?? $request->workspace_id,
            'workspace_role_id' => $roleId,
            'avatar_path' => $path
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect($user->workspace_id . '/projects');
    }
}
