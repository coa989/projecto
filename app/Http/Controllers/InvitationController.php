<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use App\Models\Role;
use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class InvitationController extends Controller
{
    public function create()
    {
        return Inertia::render('Invitation/Create');
    }

    public function store(Workspace $workspace, StoreInvitationRequest $request)
    {
        $role = Role::query()
            ->where('name', $request->role)->first()->id;

        $invitation = Invitation::query()
            ->create([
                'user_id' => Auth::id(),
                'workspace_id' => $workspace->id,
                'workspace_role_id' => $role,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'invitation_token' => substr(md5(rand(0, 9) . $request->email . time()), 0, 32)
            ]);

        Mail::to($request->email)->send(new \App\Mail\Invitation($invitation));

        return redirect()->route('members', [
            'workspace' => $workspace
        ]);
    }
}
