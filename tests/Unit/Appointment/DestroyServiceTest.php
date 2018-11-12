<?php

namespace Tests\Unit\Appointment;

use App\Http\Services\Appointment\DestroyService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyServiceTest extends TestCase
{
    use DatabaseTransactions;
    private $destroyService;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->destroyService = new DestroyService();
    }

    public function testValidId()
    {
        $userId = 3;
        auth()->setUser(User::find($userId));
        $response = $this->destroyService->destroyAction(3);

        $this->assertTrue($response->getStatusCode() == 200 && json_decode($response->getContent(), true)['success'] == 1);
    }

    public function testInvalidId()
    {
        $userId = 3;
        auth()->setUser(User::find($userId));
        $response = $this->destroyService->destroyAction(300);

        $this->assertTrue($response->getStatusCode() == 200 && json_decode($response->getContent(), true)['success'] == 0);
    }
}
