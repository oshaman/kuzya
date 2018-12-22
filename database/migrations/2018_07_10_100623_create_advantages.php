<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvantages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'advantages',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('image')->nullable();
                $table->string('image_dark')->nullable();
                $table->boolean('in_main')->default(false);
                $table->boolean('in_internet')->default(false);
                $table->boolean('in_about')->default(false);

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
        Schema::dropIfExists('advantages');
    }
}
