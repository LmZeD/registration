<?php

namespace Tests\Unit\Auth;

use App\Http\Repositories\UserInterface;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Services\Auth\RegisterService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;
    private $registerService;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->registerService = new RegisterService();
    }

    public function testRegisterValidData()
    {
        $mock = \Mockery::mock(UserInterface::class);
        $mock->shouldReceive('register')->once()->andReturn(User::find(1));

        $request = new RegisterRequest([
            'email' => 'test@test.lt',
            'name'  => 'Linas',
            'password' => 'secret'
        ]);

        $userRepo = new UserRepository();
        $result = $this->registerService->registerAction($request, $userRepo);

        $this->assertEquals(200, $result->getStatusCode());
    }
}
