<?php

namespace Tests\Unit\Appointment;

use App\Http\Services\Appointment\UpdateService;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateServiceTest extends TestCase
{
    use DatabaseTransactions;
    private $updateService;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->updateService = new UpdateService();
    }

    public function testUpdateValidData()
    {
        $carbon = new Carbon();
        $userId = 3;
        auth()->setUser(User::find($userId));

        $response = $this->updateService->updateAction([
            'id'                            => 5,
            'appointment_title'             => 'Deleted',
            'appointment_description'       => 'Deleted',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => $userId,
            'starts_at'                     => $carbon->nextWeekday()->subMonth(),
            'ends_at'                       => $carbon->nextWeekday()->addDay()->subMonth(),
        ]);

        $this->assertTrue($response->getStatusCode() == 200 && json_decode($response->getContent(), true)['success'] == 1);
    }

    public function testUpdateInvalidData()
    {
        $carbon = new Carbon();
        $userId = 3;
        auth()->setUser(User::find($userId));

        $response = $this->updateService->updateAction([
            'id'                            => 500,
            'appointment_title'             => 'Deleted',
            'appointment_description'       => 'Deleted',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => $userId,
            'starts_at'                     => $carbon->nextWeekday()->subMonth(),
            'ends_at'                       => $carbon->nextWeekday()->addDay()->subMonth(),
        ]);

        $this->assertTrue($response->getStatusCode() == 200 && json_decode($response->getContent(), true)['success'] == 0);
    }
}
