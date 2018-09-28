<?php

namespace App\Http\Services\Appointment;

use App\Http\Repositories\AppointmentRepository;
use App\Http\Resources\AppointmentResource;

class ShowService
{
    public function showAction($id)
    {
        $userId      = auth()->user()->id;
        $repository  = new AppointmentRepository();
        $appointment = $repository->show($id);
        $validation  = $this->validate($appointment, $userId);

        if ($validation !== true) {
            return $validation;
        }

        $appointment = new AppointmentResource($appointment);

        return response(json_encode(['appointment' => $appointment]), 200);
    }

    private function validate($appointment, $userId)
    {
        if ($appointment == null || $appointment->deleted == 1) {
            return response(json_encode(['success' => false, 'message' => 'Not found']), 404);
        }

        if ($appointment->requested_appointment_user_id != $userId && $appointment->appointment_to_user_id != $userId) {
            return response(json_encode(['success' => false, 'message' => 'Forbidden']), 403);
        }

        return true;
    }
}
