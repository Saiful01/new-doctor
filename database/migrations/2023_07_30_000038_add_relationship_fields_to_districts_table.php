<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDistrictsTable extends Migration
{
    public function up()
    {
        Schema::table('districts', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id', 'division_fk_8759050')->references('id')->on('divisions');
        });
    }
}
