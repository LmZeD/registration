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

    public function testNoAppointments()
    {
        $userId = 3;
        auth()->setUser(User::find($userId));
        $result = $this->showService->showAction($userId);
        dd($result);
        $this->assertTrue($result->getStatusCode() == 200);
    }
}
