<?php

namespace App\Http\Repositories;


use App\Http\Requests\Api\RegisterRequest;

interface UserInterface
{
    public function register(RegisterRequest $request);
}
