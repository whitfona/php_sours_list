<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sours', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->text('company');
            $table->text('name');
            $table->float('percent')->nullable();
            $table->string('comments')->nullable();
            $table->float('rating');
            $table->boolean('hasLactose')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sours');
    }
}
