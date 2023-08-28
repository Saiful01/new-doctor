<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToApplicantsTable extends Migration
{
    public function up()
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id', 'division_fk_8763715')->references('id')->on('divisions');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_8763716')->references('id')->on('districts');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->foreign('upazila_id', 'upazila_fk_8763717')->references('id')->on('upazilas');
        });
    }
}
