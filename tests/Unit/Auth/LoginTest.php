<?php

namespace Tests\Unit\Auth;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Services\Auth\LoginService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    private $loginService;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->loginService = new LoginService();
    }

    public function testLoginInvalidData()
    {
        $user = User::find(1);
        $result = $this->loginService->loginAction([
            'email' => $user->email,
            'password' => microtime()
        ]);
        $this->assertEquals(401, $result->getStatusCode());
    }
}
