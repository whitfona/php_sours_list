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

    //  'company' => 'Fixed Gear Brewing',
    //            'name' => 'Cherry Training Wheels',
    //            'percent' => 4.0,
    //            'comments' => 'Cherry Training Wheels is soured with our lactobacillus blend to generate a tart lactic acidity, then hopped generously with North American hops to bring out notes of lemon peel. Blended with fresh cherry juice and pours a beautiful pink.',
    //            'rating' => 9

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
