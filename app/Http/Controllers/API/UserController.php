<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getWard(User $user)
    {
        return response()->json([
            'data'=>$user->ward
        ]);
    }
}
