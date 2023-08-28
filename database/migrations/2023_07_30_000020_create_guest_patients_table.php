<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestPatientsTable extends Migration
{
    public function up()
    {
        Schema::create('guest_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('dob')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
