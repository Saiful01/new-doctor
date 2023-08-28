<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDoctorSerialsTable extends Migration
{
    public function up()
    {
        Schema::table('doctor_serials', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id', 'doctor_fk_8760062')->references('id')->on('doctors');
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id', 'hospital_fk_8760063')->references('id')->on('hospitals');
        });
    }
}
