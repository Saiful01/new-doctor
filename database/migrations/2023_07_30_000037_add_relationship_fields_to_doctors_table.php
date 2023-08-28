<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDoctorsTable extends Migration
{
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id', 'designation_fk_8811252')->references('id')->on('designations');
        });
    }
}
