<?php

namespace App\Http\Services\Appointment;

use App\Http\Repositories\AppointmentRepository;
use App\Http\Requests\IdRequest;
use App\Http\Resources\AppointmentResource;

class DestroyService
{
    public function destroyAction($id)
    {
        $repository = new AppointmentRepository();

        $data = $repository->destroy($id, auth()->user()->id);

        return response(json_encode(['success' => $data]), 200);
    }
}
