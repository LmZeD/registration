<?php

namespace Tests\Unit\Appointment;

use App\Http\Services\Appointment\StoreService;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreServiceTest extends TestCase
{
    use DatabaseTransactions;
    private $storeService;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->storeService = new StoreService();
    }

    public function testStoreValidData()
    {
        $carbon = new Carbon();
        $userId = 3;
        auth()->setUser(User::find($userId));
        $response = $this->storeService->storeAction([
            'appointment_title'             => 'Deleted',
            'appointment_description'       => 'Deleted',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => $userId,
            'appointment_to_user'           => 'kliusas@flex.com',
            'starts_at'                     => $carbon->nextWeekday()->subMonth(),
            'ends_at'                       => $carbon->nextWeekday()->addDay()->subMonth(),
            'deleted'                       => 1
        ]);
        $this->assertTrue($response->getStatusCode() == 200);
    }

    public function testAppointmentToSelf()
    {
        $carbon = new Carbon();
        $userId = 1;
        auth()->setUser(User::find($userId));
        $response = $this->storeService->storeAction([
            'appointment_title'             => 'Deleted',
            'appointment_description'       => 'Deleted',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => $userId,
            'appointment_to_user'           => 'kliusas@flex.com',
            'starts_at'                     => $carbon->nextWeekday()->subMonth(),
            'ends_at'                       => $carbon->nextWeekday()->addDay()->subMonth(),
            'deleted'                       => 1
        ]);
        $this->assertTrue($response->getStatusCode() == 200 && json_decode( $response->getContent(), 1)['error'] == 'You can not make appointment to yourself!');
    }
}
