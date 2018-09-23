<?php

namespace App\Http\Repositories;

use App\Http\Requests\Api\RegisterRequest;
use App\User;

class UserRepository implements UserInterface
{

    public function register(RegisterRequest $request)
    {
        $user           = new User($request->toArray());
        $user->password = bcrypt($request->password);
        $user->save();

        return $user;
    }
}
