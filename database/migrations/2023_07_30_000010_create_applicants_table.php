<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->string('blood_group');
            $table->string('gender');
            $table->longText('address')->nullable();
            $table->integer('age');
            $table->date('dob')->nullable();
            $table->string('password');
            $table->string('is_active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
