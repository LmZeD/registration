<?php

namespace Tests\Unit\Appointment;

use App\Http\Services\Appointment\ShowService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowServiceTest extends TestCase
{
    use DatabaseTransactions;
    private $showService;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->showService = new ShowService();
    }

    public function testNotBelongingAppointments()
    {
        $userId = 3;
        auth()->setUser(User::find($userId));
        $result = $this->showService->showAction(1);
        $this->assertTrue($result->getStatusCode() == 403);
    }

    public function testBelongingExpiredRequestedByAppointments()
    {
        $userId = 3;
        auth()->setUser(User::find($userId));
        $result = $this->showService->showAction(4);
        $this->assertTrue($result->getStatusCode() == 404 &&  json_decode($result->original, true)["message"] == 'Expired');
    }

    public function testBelongingNotExpiredRequestedByAppointments()
    {
        $userId = 3;
        auth()->setUser(User::find($userId));
        $result = $this->showService->showAction(3);
        $this->assertTrue($result->getStatusCode() == 200);
    }

    public function testNonExistingAppointments()
    {
        $userId = 3;
        auth()->setUser(User::find($userId));
        $result = $this->showService->showAction(300);
        $this->assertTrue($result->getStatusCode() == 404);
    }
}
