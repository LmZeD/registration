<?php

namespace App\Http\Services\Appointment;

use App\Http\Repositories\AppointmentRepository;
use App\Http\Requests\Api\UpdateAppointmentRequest;

class UpdateService
{
    public function updateAction($data)
    {
        $repository = new AppointmentRepository();

        $response = $repository->update($data, auth()->user()->id);

        return response(json_encode(['success' => $response]), 200);
    }
}
