<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->smallInteger('bedroom');
            $table->smallInteger('bathroom');
            $table->unsignedBigInteger('property_type_id');
            $table->unsignedBigInteger('status_id');
            $table->string('for_sale');
            $table->string('for_rent');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('region_id');
            $table->timestamps();

            $table->foreign('property_type_id')->references('id')->on('property_types');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
