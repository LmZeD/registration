<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
            'id',
            'appointment_title',
            'appointment_description',
            'location',
            'related_github_issue',
            'requested_appointment_user_id',
            'appointment_to_user_id',
            'starts_at',
            'ends_at',
            'canceled',
            'deleted'
        ];

    public function requestedBy()
    {
        return $this->hasOne(User::class, 'id', 'requested_appointment_user_id');
    }

    public function requestedTo()
    {
        return $this->hasOne(User::class, 'id', 'appointment_to_user_id');
    }
}
