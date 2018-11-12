<?php

use Illuminate\Database\Seeder;

class AppointmentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = new \Carbon\Carbon();

        \App\Appointment::create([
            'appointment_title'             => 'Display flex',
            'appointment_description'       => 'How does it work?!?',
            'location'                      => 'Don Kliusas office',
            'related_github_issue'          => 'None',
            'requested_appointment_user_id' => 1,
            'appointment_to_user_id'        => 5,
            'starts_at'                     => $carbon->nextWeekday()->toDateTimeString(),
            'ends_at'                       => $carbon->nextWeekday()->addHour(2)->toDateTimeString()
        ]);

        \App\Appointment::create([
            'appointment_title'             => 'Foosball tutorial',
            'appointment_description'       => 'Blazing fast shots.',
            'location'                      => 'Foosball table',
            'related_github_issue'          => 'none',
            'requested_appointment_user_id' => 1,
            'appointment_to_user_id'        => 3,
            'starts_at'                     => $carbon->nextWeekday()->toDateTimeString(),
            'ends_at'                       => $carbon->nextWeekday()->addHour(1)->toDateTimeString()
        ]);

        \App\Appointment::create([
            'appointment_title'             => 'Best design practices',
            'appointment_description'       => 'Lets remake empty cart page. Again.',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => 3,
            'appointment_to_user_id'        => 2,
            'starts_at'                     => $carbon->nextWeekday()->addDay(1)->toDateTimeString(),
            'ends_at'                       => $carbon->nextWeekday()->addDay(1)->addHour(2)->toDateTimeString()
        ]);

        \App\Appointment::create([
            'appointment_title'             => 'Expired',
            'appointment_description'       => 'Expired',
            'location'                      => 'Linas M. table',
            'related_github_issue'          => ':sadpepe:',
            'requested_appointment_user_id' => 3,
            'appointment_to_user_id'        => 2,
            'starts_at'                     => $carbon->nextWeekday()->subMonth(),
            'ends_at'                       => $carbon->nextWeekday()->addDay()->subMonth()
        ]);
    }
}
