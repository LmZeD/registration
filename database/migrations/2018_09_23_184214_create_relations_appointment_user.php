<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationsAppointmentUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('requested_appointment_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('appointment_to_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
