<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workspace_id',
        'workspace_role_id',
        'email',
        'invitation_token',
        'registered_at',
        'first_name',
        'last_name'
    ];
}
