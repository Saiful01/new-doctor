<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentReportsTable extends Migration
{
    public function up()
    {
        Schema::table('appointment_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id', 'appointment_fk_8763846')->references('id')->on('appointments');
        });
    }
}
