<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'langs',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('table');
                $table->string('field');
                $table->unsignedInteger('for_id');
                $table->text('content');
                $table->string('lang');
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
        Schema::dropIfExists('langs');
    }
}
