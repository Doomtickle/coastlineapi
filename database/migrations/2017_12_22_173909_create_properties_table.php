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
            $table->increments('id');
            $table->integer('kigo_id');
            $table->integer('beds');
            $table->integer('baths');
            $table->integer('sleeps');
            $table->boolean('is_active');
            $table->string('name');
            $table->string('city');
            $table->string('category');
            $table->string('kigo_last_modified'); //Atom String (YYYY-MM-DDTHH:MM:SSZ)
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->text('public_name');
            $table->timestamps();
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
