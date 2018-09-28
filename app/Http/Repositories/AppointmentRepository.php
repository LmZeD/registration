<?php

namespace App\Http\Repositories;

use App\Appointment;
use App\Http\Requests\Api\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentRepository implements AppointmentInterface
{
    /**
     * Display a listing of the resource.
     *
     * @param $userId
     * @return array
     */
    public function index($userId)
    {
        $now = Carbon::now();
        //3 queries? Make 1 and filter in front-end?
        $upcoming = AppointmentResource::collection(Appointment::where('starts_at', '>',
            $now->toDateTimeString())->where('deleted', '=', 0)->get());
        $ended    = AppointmentResource::collection(Appointment::where('ends_at', '<',
            $now->toDateTimeString())->where('deleted', '=', 0)->get());
        $ongoing  = AppointmentResource::collection(Appointment::where('ends_at', '>',
            $now->toDateTimeString())->where('starts_at', '<=', $now->toDateTimeString())->where('deleted', '=',
            0)->get());

        return [
            'upcoming' => $upcoming,
            'ended'    => $ended,
            'ongoing'  => $ongoing
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return bool
     */
    public function store($data)
    {
        return Appointment::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Appointment
     */
    public function show($id)
    {
        return Appointment::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $data
     * @param $userId
     * @return boolean
     */
    public function update($data, $userId)
    {
        return Appointment::where('id', '=', $data['id'])->where('requested_appointment_user_id', '=',
            $userId)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param $userId
     * @return boolean
     */
    public function destroy($id, $userId)
    {
        return Appointment::where('id', '=', $id)->where('requested_appointment_user_id', '=',
            $userId)->update(['deleted' => 1]);
    }
}
