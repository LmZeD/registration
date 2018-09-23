<?php

namespace App\Http\Controllers\Api;

use App\Http\Repositories\UserInterface;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\Auth\LoginService;
use App\Http\Services\Auth\RegisterService;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterService $registerService, UserInterface $userRepository)
    {
        return $token = $registerService->registerAction($request, $userRepository);
    }

    public function login(LoginRequest $request, LoginService $loginService)
    {
        return $loginService->loginAction($request->toArray());
    }
}
