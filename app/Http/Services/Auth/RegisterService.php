<?php

namespace App\Http\Services\Auth;

use App\Http\Repositories\UserInterface;
use App\Http\Requests\Api\RegisterRequest;

class RegisterService
{

    public function registerAction(RegisterRequest $request, UserInterface $userRepository)
    {
        $user = $userRepository->register($request);
        $token = $user->createToken('RegisterToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }
}
