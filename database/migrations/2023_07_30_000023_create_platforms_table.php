<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformsTable extends Migration
{
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('phone');
            $table->string('extra_phone')->nullable();
            $table->string('email');
            $table->longText('address');
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('twiter_url')->nullable();
            $table->string('linked_in_url')->nullable();
            $table->longText('about_us')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('professional_experience')->nullable();
            $table->longText('academic_qualification')->nullable();
            $table->longText('training')->nullable();
            $table->longText('services')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
