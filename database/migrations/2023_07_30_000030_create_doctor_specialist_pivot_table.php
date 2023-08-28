<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecialistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_specialist', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_id_fk_8758979')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('specialist_id');
            $table->foreign('specialist_id', 'specialist_id_fk_8758979')->references('id')->on('specialists')->onDelete('cascade');
        });
    }
}
