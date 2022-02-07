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
            $table->text('company');
            $table->text('name');
            $table->float('percent');
            $table->string('comments');
            $table->float('rating');
            $table->boolean('hasLactose');
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
        Schema::dropIfExists('sours');
    }
}
