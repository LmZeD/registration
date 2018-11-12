<?php

namespace Tests\Unit\Appointment;

use App\Appointment;
use App\Http\Services\Appointment\IndexService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;


class IndexServiceTest extends TestCase
{
    use DatabaseTransactions;
    private $indexService;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->indexService = new IndexService();
    }

    public function testValidDataWithAppointments()
    {
        auth()->setUser(User::find(3));
        $response = $this->indexService->indexAction();
        $this->assertTrue($response->getStatusCode() == 200);
    }

    public function testValidDataWithoutAppointments()
    {
        auth()->setUser(User::find(4));
        $response = $this->indexService->indexAction();
        $this->assertTrue($response->getStatusCode() == 200 && empty(json_decode($response->original, true)['upcoming']) && empty(json_decode($response->original, true)['ended']) && empty(json_decode($response->original, true)['ongoing']));
    }
}
