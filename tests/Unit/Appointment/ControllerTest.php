<?php

namespace Tests\Unit\Appointment;

use App\Http\Controllers\AppointmentController;
use App\Http\Requests\Api\StoreAppointmentRequest;
use App\Http\Requests\Api\UpdateAppointmentRequest;
use App\Http\Requests\IdRequest;
use App\Http\Services\Appointment\DestroyService;
use App\Http\Services\Appointment\IndexService;
use App\Http\Services\Appointment\ShowService;
use App\Http\Services\Appointment\StoreService;
use App\Http\Services\Appointment\UpdateService;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ControllerTest extends TestCase
{
    use DatabaseTransactions;
    private $controller;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->controller = new AppointmentController();
    }

    public function testIndex()
    {
        auth()->setUser(User::find(3));
        $service            = new IndexService();
        $serviceResponse    = $service->indexAction();
        $controllerResponse = $this->controller->index($service);

        $this->assertEquals($serviceResponse, $controllerResponse);
    }

    public function testStore()
    {
        $carbon = new Carbon();
        $userId = 1;
        auth()->setUser(User::find($userId));
        $service         = new StoreService();
        $serviceResponse = $service->storeAction([
            'appointment_title'             => 'Deleted',
            'appointment_description'       => 'Deleted',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'appointment_to_user'           => 'kliusas@flex.com',
            'starts_at'                     => $carbon->nextWeekday()->toDateString(),
            'ends_at'                       => $carbon->nextWeekday()->subMonth()->toDateString(),
        ]);
        $request         = new StoreAppointmentRequest([
            [
                'appointment_to_user'     => 'kliusas@flex.com',
                'appointment_title'       => 'Deleted',
                'appointment_description' => 'Deleted',
                'location'                => 'Linas M. table',
                'related_github_issue'    => ':sadpepe:',
                'starts_at'               => $carbon->nextWeekday()->toDateString(),
                'ends_at'                 => $carbon->nextWeekday()->addDay()->toDateString(),
            ]
        ]);
        //dd($request);
        $controllerResponse = $this->controller->store($request, $service);

        $this->assertEquals($serviceResponse, $controllerResponse);
    }

    public function testShow()
    {
        $userId = 1;
        auth()->setUser(User::find($userId));
        $service            = new ShowService();
        $serviceResponse    = $service->showAction(1);
        $request            = new Request(['id' => 1]);
        $controllerResponse = $this->controller->show($request, $service);

        $this->assertEquals($serviceResponse, $controllerResponse);
    }

    public function testUpdate()
    {
        $carbon = new Carbon();
        $userId = 1;
        auth()->setUser(User::find($userId));
        $service            = new UpdateService();
        $serviceResponse    = $service->updateAction([
            'id'                            => 5,
            'appointment_title'             => 'Deleted',
            'appointment_description'       => 'Deleted',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => $userId,
            'starts_at'                     => $carbon->nextWeekday()->subMonth(),
            'ends_at'                       => $carbon->nextWeekday()->addDay()->subMonth(),
        ]);
        $request            = new UpdateAppointmentRequest([
            'id'                            => 5,
            'appointment_title'             => 'Deleted',
            'appointment_description'       => 'Deleted',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => $userId,
            'starts_at'                     => $carbon->nextWeekday()->subMonth()->toDateString(),
            'ends_at'                       => $carbon->nextWeekday()->addDay()->subMonth()->toDateString(),
        ]);
        $controllerResponse = $this->controller->update($request, $service);

        $this->assertEquals($serviceResponse, $controllerResponse);
    }

    public function testDestroy()
    {
        $userId = 1;
        auth()->setUser(User::find($userId));
        $service            = new DestroyService();
        $serviceResponse = $service->destroyAction(4);
        $request            = new IdRequest(['id' => 4]);
        $controllerResponse = $this->controller->destroy($request, $service);
        $this->assertEquals($serviceResponse, $controllerResponse);
    }
}
