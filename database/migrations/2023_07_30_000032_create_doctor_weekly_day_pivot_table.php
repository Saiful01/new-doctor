<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorWeeklyDayPivotTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_weekly_day', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id', 'doctor_id_fk_8760050')->references('id')->on('doctors')->onDelete('cascade');
            $table->unsignedBigInteger('weekly_day_id');
            $table->foreign('weekly_day_id', 'weekly_day_id_fk_8760050')->references('id')->on('weekly_days')->onDelete('cascade');
        });
    }
}
