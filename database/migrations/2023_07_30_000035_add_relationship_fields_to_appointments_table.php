<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->foreign('applicant_id', 'applicant_fk_8463850')->references('id')->on('applicants');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id', 'doctor_fk_8772098')->references('id')->on('doctors');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id', 'hospital_fk_8463851')->references('id')->on('hospitals');
            $table->unsignedBigInteger('guest_patient_id')->nullable();
            $table->foreign('guest_patient_id', 'guest_patient_fk_8763728')->references('id')->on('guest_patients');
            $table->unsignedBigInteger('serial_id')->nullable();
            $table->foreign('serial_id', 'serial_fk_8763730')->references('id')->on('doctor_serials');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_8464289')->references('id')->on('statuses');
        });
    }
}
