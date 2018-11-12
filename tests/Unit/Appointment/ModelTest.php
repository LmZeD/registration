<?php

namespace Tests\Unit\Appointment;

use App\Appointment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelTest extends TestCase
{
    use DatabaseTransactions;
    private $indexService;

    public function testGetRequestedBy()
    {
        $appointment = Appointment::find(1);
        $requestedBy = $appointment->requestedBy()->get();
        $this->assertEquals($requestedBy[0], User::find(1));
    }

    public function testGetRequestedTo()
    {
        $appointment = Appointment::find(1);
        $requestedBy = $appointment->requestedTo()->get();
        $this->assertEquals($requestedBy[0], User::find(5));
    }
}
