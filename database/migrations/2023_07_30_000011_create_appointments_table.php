<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('appoint_type')->nullable();
            $table->string('appointment_token')->unique();
            $table->string('applicant_type');
            $table->date('appoint_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
