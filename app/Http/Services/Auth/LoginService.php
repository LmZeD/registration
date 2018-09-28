<?php

namespace App\Http\Services\Auth;

class LoginService
{
    /**
     * @param $credentials - array that contains email and password
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginAction($credentials)
    {
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
