<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('gender');
            $table->string('address')->nullable();
            $table->longText('short_details')->nullable();
            $table->longText('overview')->nullable();
            $table->decimal('fee', 15, 2);
            $table->decimal('old_fee', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
