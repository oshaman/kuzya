<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'tariffs',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('image')->nullable();
                $table->unsignedInteger('price')->nullable();
                $table->unsignedInteger('village_price')->nullable();
                $table->boolean('in_apartment')->default(true);

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
