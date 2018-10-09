<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function all()
    {
        return json_encode(User::where('email', '!=', auth()->user()->email)->select('name', 'email')->get());
    }
}
