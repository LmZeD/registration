<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;
    private $controller;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->controller = new UserController();
    }
    public function testGetAll()
    {
        auth()->setUser(User::find(3));
        $allUsers = User::all();//all but current user
        $controllerResult = $this->controller->all();

        $this->assertEquals($allUsers->count() - 1, count(json_decode($controllerResult, true)));
    }
}
