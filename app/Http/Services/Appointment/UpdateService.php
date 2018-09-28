<?php

namespace App\Http\Services\Appointment;

use App\Http\Repositories\AppointmentRepository;
use App\Http\Requests\Api\UpdateAppointmentRequest;

class UpdateService
{
    public function updateAction(UpdateAppointmentRequest $request)
    {
        $repository = new AppointmentRepository();

        $response = $repository->update($request->toArray(), auth()->user()->id);

        return response(json_encode(['success' => $response]), 200);
    }
}
