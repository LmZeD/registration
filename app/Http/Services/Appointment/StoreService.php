<?php

namespace App\Http\Services\Appointment;

use App\Http\Repositories\AppointmentRepository;
use App\Http\Requests\Api\StoreAppointmentRequest;
use App\User;

class StoreService
{
    public function storeAction($data)
    {
        $userId     = auth()->user()->id;
        $repository = new AppointmentRepository();

        $data = $this->formatData($data);
        $data['requested_appointment_user_id'] = $userId;

        if ($data['requested_appointment_user_id'] == $data['appointment_to_user_id']) {
            return response(json_encode(['error' => 'You can not make appointment to yourself!']));
        } else {
            $response = $repository->store($data);
        }

        return response(json_encode(['success' => $response]), 200);
    }

    private function formatData($data)
    {
        $email = $data['appointment_to_user'];//user email
        $user = User::where('email', '=', $email)->first();

        $data['appointment_to_user_id'] = $user['id'];

        return $data;
    }
}
