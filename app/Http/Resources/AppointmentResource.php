<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                       => $this->id,
            'appointment_title'        => $this->appointment_title,
            'appointment_description'  => $this->appointment_description,
            'location'                 => $this->location,
            'related_github_issue'     => $this->related_github_issue,
            'requested_appointment_to' => User::where('id', '=', $this->appointment_to_user_id)->select('name',
                'email')->first(),
            'starts_at'                => $this->starts_at,
            'ends_at'                  => $this->ends_at,
            'canceled'                 => $this->canceled,
            'requested_by'             => User::where('id', '=', $this->requested_appointment_user_id)->select('name',
                'email')->first(),
        ];
    }
}
