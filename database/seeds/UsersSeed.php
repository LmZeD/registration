<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
           'name' => 'Karolis',
           'email' => 'kliusas@flex.com',
           'password' => bcrypt('secret')
        ]);

        \App\User::create([
            'name' => 'Benas',
            'email' => 'ben@ten.com',
            'password' => bcrypt('secret')
        ]);

        \App\User::create([
            'name' => 'Linas M.',
            'email' => 'linas@linas.lt',
            'password' => bcrypt('secret')
        ]);

        \App\User::create([
            'name' => 'Linas L.',
            'email' => 'linas@teamlead.lt',
            'password' => bcrypt('secret')
        ]);

        \App\User::create([
            'name' => 'Tautvydas',
            'email' => 'tautvydas@000webhost.lt',
            'password' => bcrypt('secret')
        ]);
    }
}
