<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSerialsTable extends Migration
{
    public function up()
    {
        Schema::create('doctor_serials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('title')->unique();
            $table->string('is_book')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
