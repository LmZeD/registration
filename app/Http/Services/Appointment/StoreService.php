<?php

namespace App\Http\Services\Appointment;

use App\Http\Repositories\AppointmentRepository;
use App\Http\Requests\Api\StoreAppointmentRequest;
use App\User;

class StoreService
{
    public function storeAction(StoreAppointmentRequest $request)
    {
        $userId     = auth()->user()->id;
        $repository = new AppointmentRepository();

        $data = $this->formatData($request);
        $data['requested_appointment_user_id'] = $userId;

        $response = $repository->store($data);

        return response(json_encode(['success' => $response]), 200);
    }

    private function formatData(StoreAppointmentRequest $request)
    {
        $data  = $request->toArray();
        $email = $request->get('appointment_to_user');//user email

        $user = User::where('email', '=', $email)->first();

        $data['appointment_to_user_id'] = $user['id'];

        return $data;
    }
}
