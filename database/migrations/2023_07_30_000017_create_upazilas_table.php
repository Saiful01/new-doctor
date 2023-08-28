<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpazilasTable extends Migration
{
    public function up()
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('bn_name')->nullable();
            $table->string('url')->nullable();
            $table->string('police_station_name')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
