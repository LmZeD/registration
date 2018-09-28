<?php

namespace App\Http\Services\Appointment;

use App\Http\Repositories\AppointmentRepository;
use App\Http\Resources\AppointmentResource;

class IndexService
{
    public function indexAction()
    {
        $userId     = auth()->user()->id;
        $repository = new AppointmentRepository();

        $data = $repository->index($userId);

        return response(json_encode($data), 200);
    }
}
