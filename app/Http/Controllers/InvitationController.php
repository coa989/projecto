<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvitationRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class InvitationController extends Controller
{
    public function create()
    {
        return Inertia::render('Invitation/Create');
    }

    public function store(StoreInvitationRequest $request)
    {
        dd($request);
    }
}
