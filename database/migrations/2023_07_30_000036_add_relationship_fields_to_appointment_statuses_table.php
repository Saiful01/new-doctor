<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentStatusesTable extends Migration
{
    public function up()
    {
        Schema::table('appointment_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id', 'appointment_fk_8466510')->references('id')->on('appointments');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_8466511')->references('id')->on('statuses');
        });
    }
}
